<?php

namespace App\Models;

use Database\Factories\UsuarioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class Usuario extends Authenticatable
{
    /** @use HasFactory<UsuarioFactory> */
    use HasFactory, Notifiable;

    public const ROL_ADMINISTRADOR = 'administrador';
    public const ROL_GERENTE = 'gerente';
    public const ROL_CLIENTE = 'cliente';

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'clave',
        'rol',
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'clave' => 'hashed',
        ];
    }

    public function getAuthPassword(): string
    {
        return $this->clave;
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }

    public function ventasComoCliente(): HasMany
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function ventasComoVendedor(): HasMany
    {
        return $this->hasMany(Venta::class, 'vendedor_id');
    }

    public function categoriaProductos(): HasManyThrough
    {
        return $this->hasManyThrough(
            CategoriaProducto::class,
            Producto::class,
            'usuario_id',
            'producto_id'
        );
    }

    public function categorias(): Collection
    {
        return Categoria::query()
            ->whereHas('productos', fn ($query) => $query->where('usuario_id', $this->id))
            ->orderBy('nombre')
            ->get();
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim("{$this->nombre} {$this->apellidos}");
    }

    public function esAdministrador(): bool
    {
        return $this->rol === self::ROL_ADMINISTRADOR;
    }

    public function esGerente(): bool
    {
        return $this->rol === self::ROL_GERENTE;
    }

    public function esCliente(): bool
    {
        return $this->rol === self::ROL_CLIENTE;
    }
}
