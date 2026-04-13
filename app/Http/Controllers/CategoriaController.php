<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Categoria::class);

        return view('categorias.index', [
            'categorias' => Categoria::query()->with('productos')->orderBy('nombre')->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Categoria::class);

        return view('categorias.create');
    }

    public function store(StoreCategoriaRequest $request): RedirectResponse
    {
        $this->authorize('create', Categoria::class);

        Categoria::create($request->validated());

        return redirect()->route('categorias.index')->with('status', 'Categoria creada correctamente.');
    }

    public function edit(Categoria $categoria): View
    {
        $this->authorize('update', $categoria);

        return view('categorias.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $this->authorize('update', $categoria);

        $categoria->update($request->validated());

        return redirect()->route('categorias.index')->with('status', 'Categoria actualizada correctamente.');
    }

    public function destroy(Categoria $categoria): RedirectResponse
    {
        $this->authorize('delete', $categoria);

        $categoria->delete();

        return redirect()->route('categorias.index')->with('status', 'Categoria eliminada correctamente.');
    }
}
