<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'usuario_id',
        'product_id',
        'ticket',
        'validada'
    ];

    // Relación con usuario
    public function producto()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class);
    }
}