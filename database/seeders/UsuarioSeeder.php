<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        Usuario::factory()->count(10)->create();

        // Crear un admin fijo
        Usuario::create([
            'nombre' => 'Admin',
            'apellidos' => 'Principal',
            'correo' => 'admin@tuxtla.tecnm.mx',
            'clave' => bcrypt('123'),
            'rol' => 'admin'
        ]);
    }
}