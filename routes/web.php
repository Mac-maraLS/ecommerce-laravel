<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'welcome'])->name('inicio');
Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('productos', ProductoController::class)->except('show');
    Route::resource('categorias', CategoriaController::class)->except('show');
    Route::resource('ventas', VentaController::class);
    Route::resource('usuarios', UsuarioController::class)->except('show');
});
