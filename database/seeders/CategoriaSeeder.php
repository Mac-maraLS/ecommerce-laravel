<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Bebidas Calientes', 'descripcion' => 'Cafe de especialidad, lattes y bebidas recien preparadas.'],
            ['nombre' => 'Bebidas Frias', 'descripcion' => 'Frappes, tes frios y bebidas heladas de cafeteria.'],
            ['nombre' => 'Postres', 'descripcion' => 'Cheesecakes, brownies y reposteria para acompanar el cafe.'],
            ['nombre' => 'Panaderia', 'descripcion' => 'Croissants, pan dulce y opciones para desayuno.'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(['nombre' => $categoria['nombre']], $categoria);
        }
    }
}
