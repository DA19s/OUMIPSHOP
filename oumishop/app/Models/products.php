<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'stock',
    ];

    public function photos()
{
    return $this->hasMany(ProductPhoto::class, 'products_id');
}  

}
