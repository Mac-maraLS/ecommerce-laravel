<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Storage::disk('public')->put(
            'productos/demo.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=')
        );

        $vendedores = Usuario::query()->where('rol', Usuario::ROL_VENDEDOR)->orderBy('id')->get();
        $categorias = Categoria::query()->orderBy('id')->get();

        foreach ($vendedores as $indiceVendedor => $vendedor) {
            for ($i = 1; $i <= 3; $i++) {
                $indice = ($indiceVendedor * 3) + $i;

                $producto = Producto::updateOrCreate(
                    ['nombre' => "Producto {$indice}"],
                    [
                        'descripcion' => "Producto de cafeteria generado para el vendedor {$vendedor->nombre_completo}.",
                        'precio' => 35 + $indice,
                        'existencia' => 20 + $i,
                        'fotos' => ['productos/demo.png'],
                        'usuario_id' => $vendedor->id,
                    ]
                );

                $producto->categorias()->sync([
                    $categorias[($indice - 1) % $categorias->count()]->id,
                ]);
            }
        }
    }
}
