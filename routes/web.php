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
| Catálogo (público)
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
| Dashboard (redirección según rol)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::post('/admin/users', [\App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'role:gerente'])->group(function () {
    Route::get('/empleado', [DashboardController::class, 'empleado'])->name('empleado.dashboard');
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cliente', [DashboardController::class, 'cliente'])->name('cliente.dashboard');

    // ── Carrito (basado en sesión) ──────────────────────────────────────────
    Route::get('/carrito', function () {
        return view('dashboards.carrito');
    })->name('carrito.ver');

    Route::post('/carrito/agregar', function (\Illuminate\Http\Request $request) {
        $request->validate(['producto_id' => 'required|integer']);

        $id = $request->producto_id;
        $producto = \App\Models\Producto::find($id);

        if (!$producto) return back()->with('error', 'Producto no encontrado.');

        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'nombre'   => $producto->nombre,
                'precio'   => $producto->precio,
                'cantidad' => 1,
            ];
        }
        session()->put('carrito', $carrito);

        return back()->with('success', "¡{$producto->nombre} agregado al carrito!");
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
| Perfil
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
