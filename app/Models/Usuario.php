<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UsuarioFactory> */
    use HasFactory, Notifiable;

    /**
     * La tabla asociada al modelo.
     */
    protected $table = 'usuarios';

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'clave',
        'rol',
    ];

    /**
     * Campos ocultos en serialización.
     */
    protected $hidden = [
        'clave',
        'remember_token',
    ];



    /**
     * Override: Laravel usará 'clave' como nombre de la columna de contraseña.
     */
    public function getAuthPasswordName(): string
    {
        return 'clave';
    }

    /**
     * Override: Laravel usará 'clave' como campo de contraseña.
     */
    public function getAuthPassword(): string
    {
        return $this->clave;
    }

    // ===========================================================
    // Helpers de rol
    // ===========================================================

    public function isAdmin(): bool
    {
        return $this->rol === 'administrador';
    }

    public function isGerente(): bool
    {
        return $this->rol === 'gerente';
    }

    public function isCliente(): bool
    {
        return $this->rol === 'cliente';
    }

    // ===========================================================
    // Relaciones
    // ===========================================================

    /**
     * Un usuario puede vender muchos productos.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }
}
