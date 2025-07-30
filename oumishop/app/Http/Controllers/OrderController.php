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
        $vart = Vart::all();

        return view('order.index', compact('vart'));
    }

    public function updateStatus(Request $request, $vartId)
    {
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
