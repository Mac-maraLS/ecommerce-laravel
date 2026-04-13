<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        $user = auth()->user();

        return match ($user->rol) {
            'administrador' => redirect()->route('admin.dashboard'),
            'gerente'       => redirect()->route('empleado.dashboard'),
            default         => redirect()->route('cliente.dashboard'),
        };
    }

    public function admin(): View
    {
        $users        = Usuario::all();
        $productsCount = Producto::count();
        return view('dashboards.admin', compact('users', 'productsCount'));
    }

    public function empleado(): View
    {
        $productos = Producto::with('usuario')->get();
        return view('dashboards.empleado', compact('productos'));
    }

    public function cliente(): View
    {
        $productos = Producto::with('usuario', 'categorias')->get();
        $categorias = \App\Models\Categoria::all();
        return view('dashboards.cliente', compact('productos', 'categorias'));
    }
}
