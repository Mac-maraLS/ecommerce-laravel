<?php

namespace App\Providers;

use App\Models\Producto;
use App\Models\Usuario;
use App\Policies\ProductoPolicy;
use App\Policies\UsuarioPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar Policies
        Gate::policy(Usuario::class, UsuarioPolicy::class);
        Gate::policy(Producto::class, ProductoPolicy::class);
    }
}
