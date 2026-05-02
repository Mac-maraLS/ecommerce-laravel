<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;

class VentaPolicy
{
    public function view(Usuario $user, Venta $venta)
    {
        return $user->id === $venta->usuario_id
            || $user->rol === 'gerente';
    }

    public function validar(Usuario $user)
    {
        return $user->rol === 'gerente';
    }
}