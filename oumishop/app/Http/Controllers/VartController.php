<?php

namespace App\Http\Controllers;
use App\Models\Vart;
use App\Models\Historique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Http\Request;

class VartController extends Controller
{
    public function index()
    {
        $varts = Vart::where('user_id', Auth::id())->get();
        return view('vart.index', compact('varts'));
    }

    public function cancel($id)
    {
        $vart = Vart::findOrFail($id);
        
        // Vérifier que la commande appartient à l'utilisateur connecté
        if ($vart->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à annuler cette commande.');
        }
        
        // Créer un nouvel enregistrement dans l'historique avec le statut "annulé"
        Historique::create([
            'user_id' => $vart->user_id,
            'items' => $vart->items,
            'total' => $vart->total,
            'status' => 'annulé'
        ]);
        
        // Supprimer la commande de la table vart
        $vart->delete();
        
        return redirect()->back()->with('success', 'Commande annulée avec succès.');
    }

}
