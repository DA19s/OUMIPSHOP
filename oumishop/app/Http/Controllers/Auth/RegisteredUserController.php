<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\WelcomeEmail;
use App\Mail\Code;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function VerifyCode(Request $request) : View
    {
        return view('auth.VerifyCode');
    }

    public function ValidateCode(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        // Récupérer l'ID de l'utilisateur en attente
        $userId = session('pending_user_id');
        if (!$userId) {
            return redirect()->route('register')->withErrors(['email' => 'Session expirée. Veuillez vous réinscrire.']);
        }

        // Récupérer l'utilisateur depuis la base de données
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('register')->withErrors(['email' => 'Utilisateur non trouvé.']);
        }

        // Vérifier si le code a expiré (15 minutes)
        if ($user->code_expires_at && Carbon::now()->isAfter($user->code_expires_at)) {
            // Code expiré, supprimer le compte et rediriger
            $user->delete();
            session()->forget('pending_user_id');
            return redirect()->route('register')->withErrors(['email' => 'Le code de vérification a expiré. Votre compte a été supprimé. Veuillez vous réinscrire.']);
        }

        // Vérifier le code en base de données
        if ($user->code !== $request->code) {
            return back()->withErrors(['code' => 'Le code de vérification est incorrect.']);
        }
        
        // Code correct ! Connecter l'utilisateur
        Auth::login($user);

        // Supprimer le code et la date d'expiration, nettoyer la session
        $user->update(['code' => null, 'code_expires_at' => null]);
        session()->forget('pending_user_id');

        // Envoyer l'email de bienvenue
        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email bienvenue: ' . $e->getMessage());
        }

        // Code is valid, proceed with the next steps
        if ($user->role === 'admin') {
            return redirect()->intended(route('dashboard', absolute: false));
        }
        elseif ($user->role === 'client') {
            return redirect()->intended(route('dashboardClient', absolute: false));
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'numero' => ['required', 'string', 'max:15'],
            'code' => ['required', 'string', 'size:6'],
        ]);

        \Log::info('Début création utilisateur: ' . $request->email);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'numero' => $request->numero,
            'code' => $request->code,
            'code_expires_at' => Carbon::now()->addMinutes(15) // Code expire dans 15 minutes
        ]);

        \Log::info('Utilisateur créé avec ID: ' . $user->id);

        // Stocker l'ID de l'utilisateur en session pour la vérification
        session(['pending_user_id' => $user->id]);

        \Log::info('Session stockée, envoi email...');

        // Envoyer le code de verification par e-mail
        try {
            Mail::to($user->email)->send(new Code($user));
            \Log::info('Email envoyé avec succès');
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email code: ' . $e->getMessage());
            // En cas d'erreur d'envoi, supprimer l'utilisateur et rediriger
            $user->delete();
            return redirect()->route('register')->withErrors(['email' => 'Erreur lors de l\'envoi du code. Veuillez réessayer.']);
        }

        \Log::info('Redirection vers verify-code');
        return redirect()->route('verify-code');
    }

    /**
     * Renvoyer le code de vérification
     */
    public function resendCode(Request $request): RedirectResponse
    {
        // Récupérer l'ID de l'utilisateur en attente
        $userId = session('pending_user_id');
        if (!$userId) {
            return redirect()->route('register')->withErrors(['email' => 'Session expirée. Veuillez vous réinscrire.']);
        }

        // Récupérer l'utilisateur depuis la base de données
        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('register')->withErrors(['email' => 'Utilisateur non trouvé.']);
        }

        // Générer un nouveau code
        $newCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Mettre à jour le code et prolonger l'expiration
        $user->update([
            'code' => $newCode,
            'code_expires_at' => Carbon::now()->addMinutes(15)
        ]);

        // Envoyer le nouveau code par email
        try {
            Mail::to($user->email)->send(new Code($user));
            return back()->with('success', 'Un nouveau code de vérification a été envoyé à votre adresse email.');
        } catch (\Exception $e) {
            \Log::error('Erreur envoi nouveau code: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Erreur lors de l\'envoi du nouveau code. Veuillez réessayer.']);
        }
    }
}
