<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use App\Policies\CategoriaPolicy;
use App\Policies\ProductoPolicy;
use App\Policies\UsuarioPolicy;
use App\Policies\VentaPolicy;
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
        Gate::policy(Producto::class, ProductoPolicy::class);
        Gate::policy(Categoria::class, CategoriaPolicy::class);
        Gate::policy(Venta::class, VentaPolicy::class);
        Gate::policy(Usuario::class, UsuarioPolicy::class);

        Gate::define('editar-cliente', function (Usuario $usuario, Usuario $objetivo): bool {
            return $usuario->esAdministrador()
                || ($usuario->esGerente() && $objetivo->esCliente());
        });
    }
}
