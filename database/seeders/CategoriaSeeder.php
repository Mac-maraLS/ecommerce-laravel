<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Electronica', 'descripcion' => 'Productos tecnologicos y accesorios.'],
            ['nombre' => 'Hogar', 'descripcion' => 'Articulos de uso diario para casa.'],
            ['nombre' => 'Moda', 'descripcion' => 'Ropa, calzado y complementos.'],
            ['nombre' => 'Oficina', 'descripcion' => 'Productos para estudio y trabajo.'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(['nombre' => $categoria['nombre']], $categoria);
        }
    }
}
