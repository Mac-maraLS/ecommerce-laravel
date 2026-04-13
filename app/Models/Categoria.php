<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /**
     * La tabla asociada al modelo.
     */
    protected $table = 'categorias';

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // ===========================================================
    // Relaciones
    // ===========================================================

    /**
     * Una categoría puede tener muchos productos.
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'categoria_producto');
    }
}
