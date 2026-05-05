<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'existencia',
        'fotos',
        'usuario_id',
    ];

    protected function casts(): array
    {
        return [
            'fotos' => 'array',
            'precio' => 'decimal:2',
        ];
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto', 'producto_id', 'categoria_id')
            ->withTimestamps();
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class, 'producto_id');
    }

    public function primeraFoto(): ?string
    {
        return $this->fotos[0] ?? null;
    }
}
