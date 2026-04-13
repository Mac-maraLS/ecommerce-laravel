<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $vendedores = Usuario::query()
            ->whereIn('correo', ['admin@tuxtla.tecnm.mx', 'gerente@tuxtla.tecnm.mx'])
            ->get();

        $productos = [
            [
                'nombre' => 'Cappuccino Clasico',
                'descripcion' => 'Espresso con leche vaporizada y espuma cremosa, servido al momento.',
                'precio' => 52,
                'existencia' => 30,
                'categorias' => ['Bebidas Calientes'],
            ],
            [
                'nombre' => 'Latte Vainilla',
                'descripcion' => 'Cafe suave con notas de vainilla y leche texturizada.',
                'precio' => 58,
                'existencia' => 24,
                'categorias' => ['Bebidas Calientes'],
            ],
            [
                'nombre' => 'Frappe Mocha',
                'descripcion' => 'Bebida helada con espresso, chocolate y crema batida.',
                'precio' => 69,
                'existencia' => 18,
                'categorias' => ['Bebidas Frias'],
            ],
            [
                'nombre' => 'Croissant de Almendra',
                'descripcion' => 'Pan hojaldrado relleno con crema de almendra, ideal para desayuno.',
                'precio' => 46,
                'existencia' => 16,
                'categorias' => ['Panaderia', 'Postres'],
            ],
        ];

        foreach ($productos as $indice => $data) {
            $producto = Producto::updateOrCreate(
                ['nombre' => $data['nombre']],
                [
                    'descripcion' => $data['descripcion'],
                    'precio' => $data['precio'],
                    'existencia' => $data['existencia'],
                    'usuario_id' => $vendedores[$indice % $vendedores->count()]->id,
                ]
            );

            $categoriaIds = Categoria::query()
                ->whereIn('nombre', $data['categorias'])
                ->pluck('id');

            $producto->categorias()->sync($categoriaIds);
        }
    }
}
