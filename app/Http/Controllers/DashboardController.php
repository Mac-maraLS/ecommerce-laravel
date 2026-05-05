<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
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
        abort_unless(auth()->user()->esAdministrador(), 403);

        $compradorFrecuentePorCategoria = Categoria::query()
            ->with(['productos.ventas.cliente'])
            ->orderBy('nombre')
            ->get()
            ->map(function (Categoria $categoria) {
                $comprador = $categoria->productos
                    ->flatMap->ventas
                    ->groupBy('cliente_id')
                    ->sortByDesc(fn ($ventas) => $ventas->count())
                    ->first()
                    ?->first()
                    ?->cliente;

                return [
                    'categoria' => $categoria,
                    'comprador' => $comprador,
                ];
            });

        return view('dashboard', [
            'totalUsuarios' => Usuario::count(),
            'totalVendedores' => Usuario::query()->where('rol', Usuario::ROL_VENDEDOR)->count(),
            'totalCompradores' => Usuario::query()->where('rol', Usuario::ROL_CLIENTE)->count(),
            'totalProductos' => Producto::count(),
            'totalCategorias' => Categoria::count(),
            'totalVentas' => Venta::count(),
            'productosPorCategoria' => Categoria::query()->withCount('productos')->orderBy('nombre')->get(),
            'productoMasVendido' => Producto::query()->withCount('ventas')->orderByDesc('ventas_count')->first(),
            'compradorFrecuentePorCategoria' => $compradorFrecuentePorCategoria,
            'vendedoresConCategorias' => Usuario::query()
                ->where('rol', Usuario::ROL_VENDEDOR)
                ->withCount('categoriaProductos')
                ->orderBy('nombre')
                ->take(10)
                ->get(),
            'ventas' => Venta::query()->with(['producto', 'cliente', 'vendedor'])->latest()->take(5)->get(),
        ]);
    }
}
