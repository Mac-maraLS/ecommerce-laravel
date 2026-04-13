<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Usuario::query()->where('rol', Usuario::ROL_CLIENTE)->get();
        $productos = Producto::query()->get();

        if ($clientes->isEmpty() || $productos->isEmpty()) {
            return;
        }

        foreach ($productos->take(3) as $indice => $producto) {
            $cliente = $clientes[$indice % $clientes->count()];

            Venta::updateOrCreate(
                [
                    'producto_id' => $producto->id,
                    'cliente_id' => $cliente->id,
                ],
                [
                    'vendedor_id' => $producto->usuario_id,
                    'fecha' => now()->subDays($indice)->toDateString(),
                    'total' => $producto->precio,
                ]
            );
        }
    }
}
