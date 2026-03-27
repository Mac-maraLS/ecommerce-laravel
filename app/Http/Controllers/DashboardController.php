<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): RedirectResponse
    {
        $user = auth()->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'empleado' => redirect()->route('empleado.dashboard'),
            default => redirect()->route('cliente.dashboard'),
        };
    }

    public function admin(): View
    {
        $users = \App\Models\User::all();
        $productsCount = \App\Models\Product::count();
        return view('dashboards.admin', compact('users', 'productsCount'));
    }

    public function empleado(): View
    {
        $productos = \App\Models\Product::all();
        return view('dashboards.empleado', compact('productos'));
    }

    public function cliente(): View
    {
        $productos = \App\Models\Product::all();
        return view('dashboards.cliente', compact('productos'));
    }
}
