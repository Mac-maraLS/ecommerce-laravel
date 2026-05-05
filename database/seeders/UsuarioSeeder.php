<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $clave = Hash::make('123');

        Usuario::updateOrCreate(
            ['correo' => 'admin@tuxtla.tecnm.mx'],
            [
                'nombre' => 'Ana',
                'apellidos' => 'Morales',
                'clave' => $clave,
                'rol' => Usuario::ROL_ADMINISTRADOR,
            ]
        );

        Usuario::updateOrCreate(
            ['correo' => 'gerente@tuxtla.tecnm.mx'],
            [
                'nombre' => 'Mario',
                'apellidos' => 'Lopez',
                'clave' => $clave,
                'rol' => Usuario::ROL_GERENTE,
            ]
        );

        for ($i = 1; $i <= 70; $i++) {
            Usuario::updateOrCreate(
                ['correo' => "comprador{$i}@tuxtla.tecnm.mx"],
                [
                    'nombre' => "Comprador {$i}",
                    'apellidos' => 'Demo',
                    'clave' => $clave,
                    'rol' => Usuario::ROL_CLIENTE,
                ]
            );
        }

        for ($i = 1; $i <= 30; $i++) {
            Usuario::updateOrCreate(
                ['correo' => "vendedor{$i}@tuxtla.tecnm.mx"],
                [
                    'nombre' => "Vendedor {$i}",
                    'apellidos' => 'Demo',
                    'clave' => $clave,
                    'rol' => Usuario::ROL_VENDEDOR,
                ]
            );
        }
    }
}
