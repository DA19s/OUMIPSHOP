<?php

namespace App\Http\Controllers;
use App\Models\Historique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function index()
    {
        // 🛡️ SÉCURITÉ: Vérifier que l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboardClient')->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent consulter l\'historique complet.');
        }
        
        $vart = Historique::all();

        return view('historique.index', compact('vart'));
    }
}
