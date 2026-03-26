<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Páginas públicas
|--------------------------------------------------------------------------
*/

Route::view('/nosotros', 'nosotros');
Route::view('/contacto', 'contacto');

/*
|--------------------------------------------------------------------------
| Catálogo (público o protegido, tú decides)
|--------------------------------------------------------------------------
*/

Route::get('/catalogo', [ProductController::class, 'catalogo']);

/*
|--------------------------------------------------------------------------
| Productos (solo usuarios logueados)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/toggle-stock', [ProductController::class, 'toggleStock'])->name('products.toggleStock');
});

/*
|--------------------------------------------------------------------------
| Dashboard (opcional)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::post('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'verified', 'role:empleado'])->group(function () {
    Route::get('/empleado', [DashboardController::class, 'empleado'])->name('empleado.dashboard');
});

Route::middleware(['auth', 'verified', 'role:cliente'])->group(function () {
    Route::get('/cliente', [DashboardController::class, 'cliente'])->name('cliente.dashboard');

    // ── Carrito (basado en sesión) ──────────────────────────────────────────
    Route::get('/carrito', function () {
        return view('dashboards.carrito');
    })->name('carrito.ver');

    Route::post('/carrito/agregar', function (\Illuminate\Http\Request $request) {
        $request->validate(['producto_id' => 'required|integer']);

        // Catálogo estático de muestra (reemplazar con DB cuando esté listo)
        $catalogo = [
            1 => ['nombre' => 'Cappuccino Clásico',    'precio' => 45.00, 'categoria' => 'Bebidas Calientes', 'img' => 'https://images.unsplash.com/photo-1534685302058-75644251eb1f?q=80&w=200&auto=format&fit=crop'],
            2 => ['nombre' => 'Frappé de Moka',        'precio' => 65.00, 'categoria' => 'Frappés',           'img' => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?q=80&w=200&auto=format&fit=crop'],
            3 => ['nombre' => 'Cheesecake',            'precio' => 55.00, 'categoria' => 'Postres',            'img' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?q=80&w=200&auto=format&fit=crop'],
            4 => ['nombre' => 'Latte Macchiato',       'precio' => 50.00, 'categoria' => 'Bebidas Calientes', 'img' => 'https://images.unsplash.com/photo-1557006021-b85faa2bc5e2?q=80&w=200&auto=format&fit=crop'],
            5 => ['nombre' => 'Croissant de Almendra', 'precio' => 35.00, 'categoria' => 'Postres',            'img' => 'https://images.unsplash.com/photo-1549903072-7e6e0bedb7fb?q=80&w=200&auto=format&fit=crop'],
            6 => ['nombre' => 'Americano',             'precio' => 38.00, 'categoria' => 'Bebidas Calientes', 'img' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?q=80&w=200&auto=format&fit=crop'],
        ];

        $id = $request->producto_id;
        if (!isset($catalogo[$id])) return back()->with('error', 'Producto no encontrado.');

        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = array_merge($catalogo[$id], ['cantidad' => 1]);
        }
        session()->put('carrito', $carrito);

        return back()->with('success', "¡{$catalogo[$id]['nombre']} agregado al carrito!");
    })->name('carrito.agregar');

    Route::post('/carrito/cantidad', function (\Illuminate\Http\Request $request) {
        $request->validate(['producto_id' => 'required', 'accion' => 'required|in:sumar,restar']);
        $carrito = session()->get('carrito', []);
        $id = $request->producto_id;
        if (isset($carrito[$id])) {
            if ($request->accion === 'sumar') {
                $carrito[$id]['cantidad']++;
            } else {
                $carrito[$id]['cantidad']--;
                if ($carrito[$id]['cantidad'] <= 0) unset($carrito[$id]);
            }
        }
        session()->put('carrito', $carrito);
        return back();
    })->name('carrito.cantidad');

    Route::delete('/carrito/quitar', function (\Illuminate\Http\Request $request) {
        $request->validate(['producto_id' => 'required']);
        $carrito = session()->get('carrito', []);
        unset($carrito[$request->producto_id]);
        session()->put('carrito', $carrito);
        return back()->with('success', 'Producto eliminado del carrito.');
    })->name('carrito.quitar');
});

/*
|--------------------------------------------------------------------------
| Perfil (Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth (MUY IMPORTANTE)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
