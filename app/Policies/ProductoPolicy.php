<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\Usuario;

class ProductoPolicy
{
    /**
     * Solo Administrador y Gerente pueden crear productos.
     */
    public function create(Usuario $auth): bool
    {
        return in_array($auth->rol, ['administrador', 'gerente']);
    }

    /**
     * Solo Administrador y Gerente pueden editar productos.
     */
    public function update(Usuario $auth, Producto $producto): bool
    {
        return in_array($auth->rol, ['administrador', 'gerente']);
    }

    /**
     * Solo Administrador y Gerente pueden eliminar productos.
     */
    public function delete(Usuario $auth, Producto $producto): bool
    {
        return in_array($auth->rol, ['administrador', 'gerente']);
    }

    /**
     * Todos los usuarios autenticados pueden ver productos.
     */
    public function view(Usuario $auth, Producto $producto): bool
    {
        return true;
    }

    /**
     * Todos los usuarios autenticados pueden listar productos.
     */
    public function viewAny(Usuario $auth): bool
    {
        return true;
    }
}
