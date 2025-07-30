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

        // Vérifier le code en base de données
        if ($user->code !== $request->code) {
            return back()->withErrors(['code' => 'Le code de vérification est incorrect.']);
        }
        
        // Code correct ! Connecter l'utilisateur
        Auth::login($user);

        // Supprimer le code et nettoyer la session
        $user->update(['code' => null]);
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
            'code' => $request->code
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
}
