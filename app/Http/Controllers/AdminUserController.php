<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function store(StoreUsuarioRequest $request)
    {
        $this->authorize('create', Usuario::class);

        $data = $request->validated();
        $data['clave'] = Hash::make($data['clave']);

        $usuario = Usuario::create($data);

        return back()->with('success', '¡Usuario "' . $usuario->nombre . '" creado exitosamente!');
    }

    public function destroy(Usuario $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
