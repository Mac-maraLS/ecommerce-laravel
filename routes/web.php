<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CategoriaController;

/*
|--------------------------------------------------------------------------
| PÁGINAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::view('/nosotros', 'nosotros');
Route::view('/contacto', 'contacto');

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| 2FA
|--------------------------------------------------------------------------
*/

Route::get('/verificar-codigo', [AuthController::class, 'formCodigo']);
Route::post('/verificar-codigo', [AuthController::class, 'validarCodigo']);

/*
|--------------------------------------------------------------------------
| CATÁLOGO
|--------------------------------------------------------------------------
*/

Route::get('/catalogo', [ProductController::class, 'catalogo']);

/*
|--------------------------------------------------------------------------
| PROTEGIDO
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // PRODUCTOS
    Route::resource('products', ProductController::class);

    // CATEGORÍAS
    Route::resource('categorias', CategoriaController::class);

    // COMPRAS
    Route::get('/comprar/{id}', [VentaController::class, 'create']);
    Route::post('/comprar', [VentaController::class, 'store']);

    // VENTAS
    Route::get('/ventas', [VentaController::class, 'index']);
    Route::post('/ventas/validar/{id}', [VentaController::class, 'validar']);

    // TICKET
    Route::get('/ticket/{id}', [VentaController::class, 'verTicket']);
});