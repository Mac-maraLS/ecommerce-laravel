<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function welcome(): View
    {
        return view('welcome', [
            'productos' => Producto::query()->with(['vendedor', 'categorias'])->latest()->take(6)->get(),
        ]);
    }

    public function index(): View
    {
        return view('dashboard', [
            'totalProductos' => Producto::count(),
            'totalCategorias' => Categoria::count(),
            'totalVentas' => Venta::count(),
            'ventas' => Venta::query()->with(['producto', 'cliente', 'vendedor'])->latest()->take(5)->get(),
        ]);
    }
}
