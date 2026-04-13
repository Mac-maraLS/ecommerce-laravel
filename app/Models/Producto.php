<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * La tabla asociada al modelo.
     */
    protected $table = 'productos';

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'existencia',
        'imagen',
        'usuario_id',
    ];

    // ===========================================================
    // Relaciones
    // ===========================================================

    /**
     * El producto pertenece a un vendedor (usuario).
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * Un producto puede tener muchas categorías.
     */
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }
}
