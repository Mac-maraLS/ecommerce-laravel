<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function productos()
    {
        return $this->belongsToMany(Product::class, 'categoria_producto', 'categoria_id', 'producto_id');
    }
}