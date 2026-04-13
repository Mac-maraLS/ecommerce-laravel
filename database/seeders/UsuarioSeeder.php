<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::updateOrCreate(
            ['correo' => 'admin@tuxtla.tecnm.mx'],
            [
                'nombre' => 'Admin',
                'apellidos' => 'Principal',
                'clave' => Hash::make('123'),
                'rol' => Usuario::ROL_ADMINISTRADOR,
            ]
        );

        Usuario::updateOrCreate(
            ['correo' => 'gerente@tuxtla.tecnm.mx'],
            [
                'nombre' => 'Mario',
                'apellidos' => 'Lopez',
                'clave' => Hash::make('123'),
                'rol' => Usuario::ROL_GERENTE,
            ]
        );

        $clientes = [
            ['nombre' => 'Juan', 'apellidos' => 'Sanchez', 'correo' => 'jsanchez@tuxtla.tecnm.mx'],
            ['nombre' => 'Maria', 'apellidos' => 'Hernandez', 'correo' => 'mhernandez@tuxtla.tecnm.mx'],
            ['nombre' => 'Pedro', 'apellidos' => 'Martinez', 'correo' => 'pmartinez@tuxtla.tecnm.mx'],
        ];

        foreach ($clientes as $cliente) {
            Usuario::updateOrCreate(
                ['correo' => $cliente['correo']],
                [
                    'nombre' => $cliente['nombre'],
                    'apellidos' => $cliente['apellidos'],
                    'clave' => Hash::make('123'),
                    'rol' => Usuario::ROL_CLIENTE,
                ]
            );
        }

        Usuario::factory()->count(1)->create([
            'rol' => Usuario::ROL_GERENTE,
        ]);
    }
}
