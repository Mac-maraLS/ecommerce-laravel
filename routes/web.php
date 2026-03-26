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
});

Route::middleware(['auth', 'verified', 'role:empleado'])->group(function () {
    Route::get('/empleado', [DashboardController::class, 'empleado'])->name('empleado.dashboard');
});

Route::middleware(['auth', 'verified', 'role:cliente'])->group(function () {
    Route::get('/cliente', [DashboardController::class, 'cliente'])->name('cliente.dashboard');
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
