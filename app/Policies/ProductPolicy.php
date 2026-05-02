<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Usuario;

class ProductPolicy
{
    // VER PRODUCTOS
    public function viewAny(Usuario $user)
    {
        return true;
    }

    // CREAR PRODUCTO
    public function create(Usuario $user)
    {
        return $user->rol === 'admin' || $user->rol === 'gerente';
    }

    // EDITAR PRODUCTO
    public function update(Usuario $user, Product $product)
    {
        return $user->rol === 'admin' || $product->usuario_id === $user->id;
    }

    // ELIMINAR PRODUCTO
    public function delete(Usuario $user, Product $product)
    {
        return $user->rol === 'admin';
    }

    protected $policies = [
        Product::class => ProductPolicy::class,
    ];
}