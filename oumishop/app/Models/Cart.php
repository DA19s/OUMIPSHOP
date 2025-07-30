<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'items',
        'total',
        'status',
    ];

    protected $casts = [
        'items' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthode pour calculer le total
    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['total'];
        }
        return $total;
    }

    // Méthode pour ajouter un article
    public function addItem($productId, $name, $price, $quantity = 1)
    {
        $items = $this->items ?? [];
        
        // Vérifier si l'article existe déjà
        $existingIndex = null;
        foreach ($items as $index => $item) {
            if ($item['product_id'] == $productId) {
                $existingIndex = $index;
                break;
            }
        }

        if ($existingIndex !== null) {
            // Mettre à jour la quantité
            $items[$existingIndex]['quantity'] += $quantity;
            $items[$existingIndex]['total'] = $items[$existingIndex]['quantity'] * $items[$existingIndex]['price'];
        } else {
            // Ajouter un nouvel article
            $items[] = [
                'product_id' => $productId,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'total' => $price * $quantity
            ];
        }

        $this->items = $items;
        $this->total = $this->calculateTotal();
        $this->save();
    }

    // Méthode pour supprimer un article
    public function removeItem($productId)
    {
        $items = $this->items ?? [];
        $items = array_filter($items, function($item) use ($productId) {
            return $item['product_id'] != $productId;
        });
        
        $this->items = array_values($items);
        $this->total = $this->calculateTotal();
        $this->save();
    }

    // Méthode pour vider le panier
    public function clear()
    {
        $this->items = [];
        $this->total = 0;
        $this->save();
    }
}