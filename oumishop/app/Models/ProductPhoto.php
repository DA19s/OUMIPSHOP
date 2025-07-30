<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    protected $fillable = ['products_id', 'photo'];

    public function product()
    {
        return $this->belongsTo(products::class, 'products_id');
    }
}