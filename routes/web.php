<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN MANUAL
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| PÁGINA PRINCIPAL
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| PÁGINAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::view('/nosotros', 'nosotros');
Route::view('/contacto', 'contacto');

/*
|--------------------------------------------------------------------------
| CATÁLOGO (PÚBLICO)
|--------------------------------------------------------------------------
*/

Route::get('/catalogo', [ProductController::class, 'catalogo']);

/*
|--------------------------------------------------------------------------
| PRODUCTOS (PROTEGIDO)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (OPCIONAL)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return "Bienvenido al sistema";
    });
});

Route::get('/register', [AuthController::class, 'showRegister']);

Route::post('/register', [AuthController::class, 'register']);