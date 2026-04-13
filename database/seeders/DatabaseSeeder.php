<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── Usuarios base ────────────────────────────────────────────────────
        $admin = Usuario::updateOrCreate(
            ['correo' => 'admin@tienda.test'],
            [
                'nombre'    => 'Administrador',
                'apellidos' => 'Sistema',
                'clave'     => Hash::make('password'),
                'rol'       => 'administrador',
            ]
        );

        $gerente = Usuario::updateOrCreate(
            ['correo' => 'gerente@tienda.test'],
            [
                'nombre'    => 'Gerente',
                'apellidos' => 'Tienda',
                'clave'     => Hash::make('password'),
                'rol'       => 'gerente',
            ]
        );

        $cliente = Usuario::updateOrCreate(
            ['correo' => 'cliente@tienda.test'],
            [
                'nombre'    => 'Cliente',
                'apellidos' => 'Demo',
                'clave'     => Hash::make('password'),
                'rol'       => 'cliente',
            ]
        );

        // ── Usuarios generados con factory ───────────────────────────────────
        // (evitar duplicados de correo usando try/catch)
        for ($i = 0; $i < 5; $i++) {
            try {
                Usuario::factory()->create();
            } catch (\Exception $e) {
                // ignorar duplicados de correo
            }
        }

        // ── Categorías (Punto 5) ─────────────────────────────────────────────
        $catBebidas = \App\Models\Categoria::create(['nombre' => 'Bebidas Calientes', 'descripcion' => 'Cafés, tés y más']);
        $catFrappes = \App\Models\Categoria::create(['nombre' => 'Frappés', 'descripcion' => 'Bebidas frías y mezcladas']);
        $catPostres = \App\Models\Categoria::create(['nombre' => 'Postres', 'descripcion' => 'Delicias dulces']);

        // ── Productos (vendedor = gerente) ───────────────────────────────────
        $productosData = [
            [
                'data' => [
                    'nombre'      => 'Cappuccino Clásico',
                    'descripcion' => 'Espresso con leche vaporizada y espuma cremosa.',
                    'precio'      => 45.00,
                    'existencia'  => 50,
                    'imagen'      => null,
                    'usuario_id'  => $gerente->id,
                ],
                'categorias' => [$catBebidas->id]
            ],
            [
                'data' => [
                    'nombre'      => 'Frappé de Moka',
                    'descripcion' => 'Mezcla helada de espresso, chocolate y crema.',
                    'precio'      => 65.00,
                    'existencia'  => 30,
                    'imagen'      => null,
                    'usuario_id'  => $gerente->id,
                ],
                'categorias' => [$catFrappes->id]
            ],
            [
                'data' => [
                    'nombre'      => 'Cheesecake',
                    'descripcion' => 'Base de galleta, relleno cremoso y frambuesa.',
                    'precio'      => 55.00,
                    'existencia'  => 15,
                    'imagen'      => null,
                    'usuario_id'  => $admin->id,
                ],
                'categorias' => [$catPostres->id]
            ],
            [
                'data' => [
                    'nombre'      => 'Latte Macchiato',
                    'descripcion' => 'Leche caliente con un toque de espresso intenso.',
                    'precio'      => 50.00,
                    'existencia'  => 40,
                    'imagen'      => null,
                    'usuario_id'  => $gerente->id,
                ],
                'categorias' => [$catBebidas->id]
            ],
            [
                'data' => [
                    'nombre'      => 'Croissant de Almendra',
                    'descripcion' => 'Pan del día cubierto de almendras tostadas.',
                    'precio'      => 35.00,
                    'existencia'  => 20,
                    'imagen'      => null,
                    'usuario_id'  => $gerente->id,
                ],
                'categorias' => [$catPostres->id]
            ],
            [
                'data' => [
                    'nombre'      => 'Americano',
                    'descripcion' => 'Espresso diluido en agua caliente, puro y limpio.',
                    'precio'      => 38.00,
                    'existencia'  => 100,
                    'imagen'      => null,
                    'usuario_id'  => $admin->id,
                ],
                'categorias' => [$catBebidas->id]
            ],
        ];

        foreach ($productosData as $prod) {
            $producto = Producto::updateOrCreate(
                ['nombre' => $prod['data']['nombre']],
                $prod['data']
            );
            $producto->categorias()->sync($prod['categorias']);
        }
    }
}
