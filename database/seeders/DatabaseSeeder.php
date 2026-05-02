<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
        ]);
        
        User::updateOrCreate(
            ['email' => 'admin@tienda.test'],
            [
                'name' => 'Administrador',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'empleado@tienda.test'],
            [
                'name' => 'Empleado',
                'role' => User::ROLE_EMPLEADO,
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'cliente@tienda.test'],
            [
                'name' => 'Cliente',
                'role' => User::ROLE_CLIENTE,
                'password' => Hash::make('password'),
            ]
        );

        $productos = [
            [
                'name' => 'Cappuccino Clásico',
                'category' => 'bebidas_calientes',
                'description' => 'Espresso con leche vaporizada y espuma cremosa.',
                'price' => 45.00,
                'stock' => 50,
                'image' => null,
            ],
            [
                'name' => 'Frappé de Moka',
                'category' => 'frappes',
                'description' => 'Mezcla helada de espresso, chocolate y crema.',
                'price' => 65.00,
                'stock' => 30,
                'image' => null,
            ],
            [
                'name' => 'Cheesecake',
                'category' => 'postres',
                'description' => 'Base de galleta, relleno cremoso y frambuesa.',
                'price' => 55.00,
                'stock' => 15,
                'image' => null,
            ],
            [
                'name' => 'Latte Macchiato',
                'category' => 'bebidas_calientes',
                'description' => 'Leche caliente con un toque de espresso intenso.',
                'price' => 50.00,
                'stock' => 40,
                'image' => null,
            ],
            [
                'name' => 'Croissant de Almendra',
                'category' => 'postres',
                'description' => 'Pan del día cubierto de almendras tostadas.',
                'price' => 35.00,
                'stock' => 20,
                'image' => null,
            ],
            [
                'name' => 'Americano',
                'category' => 'bebidas_calientes',
                'description' => 'Espresso diluido en agua caliente, puro y limpio.',
                'price' => 38.00,
                'stock' => 100,
                'image' => null,
            ],
        ];

        foreach ($productos as $producto) {
            \App\Models\Product::updateOrCreate(
                ['name' => $producto['name']],
                $producto
            );
        }
    }
}
