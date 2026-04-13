<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Usuario::class);

        return view('usuarios.index', [
            'usuarios' => Usuario::orderBy('nombre')->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Usuario::class);

        return view('usuarios.create');
    }

    public function store(StoreUsuarioRequest $request): RedirectResponse
    {
        $this->authorize('create', Usuario::class);

        Usuario::create([
            ...$request->safe()->except('clave'),
            'clave' => Hash::make($request->validated('clave')),
        ]);

        return redirect()->route('usuarios.index')->with('status', 'Usuario creado correctamente.');
    }

    public function edit(Usuario $usuario): View
    {
        Gate::authorize('editar-cliente', $usuario);

        return view('usuarios.edit', compact('usuario'));
    }

    public function update(UpdateUsuarioRequest $request, Usuario $usuario): RedirectResponse
    {
        Gate::authorize('editar-cliente', $usuario);

        $data = $request->safe()->except('clave');

        if ($request->filled('clave')) {
            $data['clave'] = Hash::make($request->validated('clave'));
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('status', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario): RedirectResponse
    {
        $this->authorize('delete', $usuario);

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('status', 'Usuario eliminado correctamente.');
    }
}
