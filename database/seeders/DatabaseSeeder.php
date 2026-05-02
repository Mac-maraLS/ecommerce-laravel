<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
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

        // Usuarios de prueba en tabla 'usuarios' (usada por AuthController/login)
        Usuario::updateOrCreate(
            ['correo' => 'admin@tienda.test'],
            [
                'nombre' => 'Administrador',
                'apellidos' => 'ToMaBra',
                'clave' => Hash::make('password'),
                'rol' => 'vendedor',
            ]
        );

        Usuario::updateOrCreate(
            ['correo' => 'empleado@tienda.test'],
            [
                'nombre' => 'Empleado',
                'apellidos' => 'ToMaBra',
                'clave' => Hash::make('password'),
                'rol' => 'vendedor',
            ]
        );

        Usuario::updateOrCreate(
            ['correo' => 'cliente@tienda.test'],
            [
                'nombre' => 'Cliente',
                'apellidos' => 'ToMaBra',
                'clave' => Hash::make('password'),
                'rol' => 'cliente',
            ]
        );

        $firstUsuario = \App\Models\Usuario::first();
        $uid = $firstUsuario ? $firstUsuario->id : 1;

        $productos = [
            [
                'name' => 'Cappuccino Clásico',
                'description' => 'Espresso con leche vaporizada y espuma cremosa.',
                'price' => 45.00,
                'stock' => 50,
                'image' => null,
                'usuario_id' => $uid,
            ],
            [
                'name' => 'Frappé de Moka',
                'description' => 'Mezcla helada de espresso, chocolate y crema.',
                'price' => 65.00,
                'stock' => 30,
                'image' => null,
                'usuario_id' => $uid,
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'Base de galleta, relleno cremoso y frambuesa.',
                'price' => 55.00,
                'stock' => 15,
                'image' => null,
                'usuario_id' => $uid,
            ],
            [
                'name' => 'Latte Macchiato',
                'description' => 'Leche caliente con un toque de espresso intenso.',
                'price' => 50.00,
                'stock' => 40,
                'image' => null,
                'usuario_id' => $uid,
            ],
            [
                'name' => 'Croissant de Almendra',
                'description' => 'Pan del día cubierto de almendras tostadas.',
                'price' => 35.00,
                'stock' => 20,
                'image' => null,
                'usuario_id' => $uid,
            ],
            [
                'name' => 'Americano',
                'description' => 'Espresso diluido en agua caliente, puro y limpio.',
                'price' => 38.00,
                'stock' => 100,
                'image' => null,
                'usuario_id' => $uid,
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
