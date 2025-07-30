<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
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
}
