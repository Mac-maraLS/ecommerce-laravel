<?php

namespace App\Policies;

use App\Models\Usuario;

class UsuarioPolicy
{
    /**
     * Solo el Administrador puede crear usuarios.
     */
    public function create(Usuario $auth): bool
    {
        return $auth->rol === 'administrador';
    }

    /**
     * Reglas de edición:
     * - Administrador: puede editar cualquier usuario.
     * - Gerente: solo puede editar Clientes (no Gerentes ni Administradores).
     * - Cliente: no puede editar a nadie.
     */
    public function update(Usuario $auth, Usuario $target): bool
    {
        if ($auth->rol === 'administrador') {
            return true;
        }

        if ($auth->rol === 'gerente') {
            return $target->rol === 'cliente';
        }

        return false;
    }

    /**
     * Solo el Administrador puede eliminar usuarios.
     */
    public function delete(Usuario $auth, Usuario $target): bool
    {
        // No puede eliminarse a sí mismo
        if ($auth->id === $target->id) {
            return false;
        }

        return $auth->rol === 'administrador';
    }
}
