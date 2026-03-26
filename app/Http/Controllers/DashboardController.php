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
        return view('dashboards.admin');
    }

    public function empleado(): View
    {
        return view('dashboards.empleado');
    }

    public function cliente(): View
    {
        return view('dashboards.cliente');
    }
}
