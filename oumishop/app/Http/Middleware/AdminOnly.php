<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }

        // Vérifier si l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            \Log::warning('Tentative d\'accès non autorisé:', [
                'user_id' => auth()->id(),
                'user_role' => auth()->user()->role,
                'url' => $request->url(),
                'method' => $request->method()
            ]);
            
            // Rediriger selon le type de requête
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Accès non autorisé. Seuls les administrateurs peuvent effectuer cette action.'
                ], 403);
            }
            
            return redirect()->route('dashboardClient')->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent accéder à cette page.');
        }

        return $next($request);
    }
}
