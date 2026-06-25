<?php

namespace App\Http\Controllers;
use App\Models\Vart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Historique;

class OrderController extends Controller
{
    public function index()
    {
        // 🛡️ SÉCURITÉ: Vérifier que l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboardClient')->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent gérer les commandes.');
        }
        
        $vart = Vart::all();

        return view('order.index', compact('vart'));
    }

    public function updateStatus(Request $request, $vartId)
    {
        // 🛡️ SÉCURITÉ: Vérifier que l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            \Log::warning('Tentative non autorisée de modification de statut de commande:', [
                'user_id' => auth()->id(),
                'user_role' => auth()->user()->role,
                'vart_id' => $vartId,
                'new_status' => $request->status
            ]);
            return redirect()->route('dashboardClient')->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent modifier le statut des commandes.');
        }
        
        $request->validate([
            'status' => 'required|in:EN COURS,PAYÉ,LIVRÉ'
        ]);

        $vart = Vart::findOrFail($vartId);
        $vart->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès !');
    }

        public function validateOrder(Request $request, $vartid)
    {
        // 🛡️ SÉCURITÉ: Vérifier que l'utilisateur est admin
        if (auth()->user()->role !== 'admin') {
            \Log::warning('Tentative non autorisée de validation de commande:', [
                'user_id' => auth()->id(),
                'user_role' => auth()->user()->role,
                'vart_id' => $vartid
            ]);
            return redirect()->route('dashboardClient')->with('error', 'Accès non autorisé. Seuls les administrateurs peuvent valider les commandes.');
        }
        
        $vart = Vart::where('id', $vartid)->first();

        if (!$vart || empty($vart->items)) {
            return redirect()->back()->with('error', 'Il y\'a un probleme.');
        }

        $historique = new Historique();
        $historique->user_id = $vart->user_id;
        $historique->items = $vart->items;
        $historique->total = $vart->total;
        $historique->status = $vart->status;
        $historique->save();

        $vart->delete();

        return redirect()->route('order.index')->with('success', 'Commande validée avec succès !');
    }
}
