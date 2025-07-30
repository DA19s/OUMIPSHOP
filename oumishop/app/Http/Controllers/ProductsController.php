<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\Storage; 
use App\Http\Requests\CreateProductRequest;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }
    
public function store(CreateProductRequest $request)
{
    $validated = $request->validated();

    // Créer le produit sans les photos (enlève 'photo' de $validated)
    $product = products::create([
        'nom' => $validated['nom'],
        'prix' => $validated['prix'],
        'stock' => $validated['stock'],
    ]);

    // Gérer l'upload de plusieurs photos
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('products', 'public');
            $product->photos()->create(['photo' => $path]);
        }
    }

    return redirect(route('dashboard', absolute: false));
}

  public function update(Request $request)
    {
        try {
            // Debug: Afficher les données reçues
            \Log::info('Données reçues dans update:', $request->all());
            
            // Validation des données
            $request->validate([
                'id' => 'required|exists:products,id',
                'nom' => 'required|string|max:255',
                'prix' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'photos' => 'nullable|array',
                'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Trouver le produit
            $product = products::findOrFail($request->id);
            
            // Mettre à jour les informations du produit
            $product->update([
                'nom' => $request->nom,
                'prix' => $request->prix,
                'stock' => $request->stock
            ]);
            
            // Supprimer les photos sélectionnées
            if ($request->has('photos_to_delete')) {
                $photosToDelete = json_decode($request->photos_to_delete, true);
                if (is_array($photosToDelete)) {
                    foreach ($photosToDelete as $photoName) {
                        $photo = ProductPhoto::where('photo', $photoName)
                                    ->where('products_id', $product->id)
                                    ->first();
                        if ($photo) {
                            // Supprimer le fichier physique
                            if (Storage::exists('public/' . $photoName)) {
                                Storage::delete('public/' . $photoName);
                            }
                            // Supprimer l'enregistrement de la base de données
                            $photo->delete();
                        }
                    }
                }
            }
            
            // Ajouter de nouvelles photos
            if ($request->hasFile('photos')) {
                \Log::info('Nouvelles photos détectées:', ['count' => count($request->file('photos'))]);
                foreach ($request->file('photos') as $photo) {
                    // Utiliser la même logique que dans store()
                    $path = $photo->store('products', 'public');
                    
                    ProductPhoto::create([
                        'products_id' => $product->id,
                        'photo' => $path
                    ]);
                }
            } else {
                \Log::info('Aucune nouvelle photo détectée');
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Produit modifié avec succès !'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erreur dans update:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur : ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = products::findOrFail($id);
            
            // Supprimer les photos associées
            foreach ($product->photos as $photo) {
                if (Storage::exists('public/' . $photo->photo)) {
                    Storage::delete('public/' . $photo->photo);
                }
                $photo->delete();
            }
            
            // Supprimer le produit
            $product->delete();
            
            return redirect()->route('dashboard')->with('success', 'Produit supprimé avec succès !');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}

