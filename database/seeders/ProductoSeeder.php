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
            ->whereIn('rol', [Usuario::ROL_ADMINISTRADOR, Usuario::ROL_GERENTE])
            ->get();

        $productos = [
            [
                'nombre' => 'Laptop Empresarial',
                'descripcion' => 'Equipo de 14 pulgadas orientado a productividad.',
                'precio' => 18500,
                'existencia' => 8,
                'categorias' => ['Electronica', 'Oficina'],
            ],
            [
                'nombre' => 'Silla Ergonomica',
                'descripcion' => 'Silla ajustable para jornadas largas de trabajo.',
                'precio' => 3200,
                'existencia' => 12,
                'categorias' => ['Hogar', 'Oficina'],
            ],
            [
                'nombre' => 'Tenis Urbanos',
                'descripcion' => 'Calzado casual para uso diario.',
                'precio' => 1299,
                'existencia' => 20,
                'categorias' => ['Moda'],
            ],
            [
                'nombre' => 'Lampara LED',
                'descripcion' => 'Lampara recargable con tres niveles de intensidad.',
                'precio' => 499,
                'existencia' => 25,
                'categorias' => ['Hogar', 'Electronica'],
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
