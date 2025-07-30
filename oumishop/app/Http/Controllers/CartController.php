<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vart;
use Illuminate\Support\Facades\Mail;
use App\Mail\ValidationPanier;
use App\Models\User;
use App\Mail\FactureEmail;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'items' => [],
                'total' => 0
            ]);
        }

        return view('cart.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = products::findOrFail($request->product_id);
        
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'items' => [],
                'total' => 0
            ]);
        }

        $cart->addItem(
            $product->id,
            $product->nom,
            $product->prix,
            $request->quantity
        );

        return redirect()->back()->with('success', 'Article ajouté au panier !');
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        
        if ($cart) {
            $cart->removeItem($request->product_id);
        }

        return redirect()->back()->with('success', 'Article supprimé du panier !');
    }

    public function clearCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if ($cart) {
            $cart->clear();
        }

        return redirect()->back()->with('success', 'Panier vidé !');
    }

    public function validateCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart || empty($cart->items)) {
            return redirect()->back()->with('error', 'Votre panier est vide !');
        }

        // VÉRIFICATION NOUVELLE : Vérifier si l'utilisateur a déjà une commande
    $existingVart = Vart::where('user_id', Auth::id())->first();
    if ($existingVart) {
        return redirect()->back()->with('error', 'Vous avez déjà une commande en cours. Veuillez finaliser votre commande actuelle avant d\'en créer une nouvelle.');
    }


        foreach ($cart->items as $item) {
            // Vérifier la disponibilité du produit
            $product = products::find($item['product_id']);
            if (!$product || $product->stock < $item['quantity']) {
        return redirect()->route('cart.index')->with('error', 'Le produit ' . $item['name'] . ' n\'est pas disponible en quantité suffisante.');
            }
            // Mettre à jour le stock du produit
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Créer une nouvelle commande (Vart)
        $vart = new Vart();
        $vart->user_id = Auth::id();
        $vart->items = $cart->items;
        $vart->total = $cart->total;    
        $vart->status = 'EN COURS';
        $vart->save();

        // Générer la facture PDF
        $pdfPath = $this->generateInvoicePDF($vart);

        // Envoyer l'email avec la facture au client
        $user = Auth::user();
        \Log::info('Tentative d\'envoi email facture à: ' . $user->email);
        try {
            Mail::to($user->email)->send(new FactureEmail($user, $vart, $pdfPath));
            \Log::info('Email facture envoyé avec succès');
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email facture: ' . $e->getMessage());
        }

        // Envoyer le code de verification par e-mail à l'admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            \Log::info('Tentative d\'envoi email admin à: ' . $admin->email);
            try {
                Mail::to($admin->email)->send(new ValidationPanier($user, $admin, $vart));
                \Log::info('Email admin envoyé avec succès');
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email validation: ' . $e->getMessage());
            }
        } else {
            \Log::warning('Aucun admin trouvé pour l\'envoi d\'email');
        }

        // Vider le panier après validation
        $cart->delete();

        // Rediriger vers une page de confirmation ou de détails de la commande
        return redirect()->route('dashboardClient')->with('success', 'Panier validé avec succès ! Vous recevrez bientôt un email avec la facture.
        ⚠️ Veuillez effectuer le paiement et envoyer la preuve par email ou sur le compte instagram by_ammaja');
    }

    private function generateInvoicePDF($vart)
    {
        try {
            // Générer le PDF
            $pdf = PDF::loadView('emails.facture', [
                'user' => Auth::user(),
                'vart' => $vart
            ]);

            // Créer le nom du fichier
            $filename = 'facture-oumishop-' . $vart->id . '-' . date('Y-m-d-H-i-s') . '.pdf';
            
            // Chemin de stockage
            $path = storage_path('app/public/factures/' . $filename);
            
            // Créer le dossier si nécessaire
            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0755, true);
            }

            // Sauvegarder le PDF
            $pdf->save($path);

            return $path;
        } catch (\Exception $e) {
            \Log::error('Erreur génération PDF: ' . $e->getMessage());
            return null;
        }
    }
}
