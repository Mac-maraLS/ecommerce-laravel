<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Usuario::query()->where('rol', Usuario::ROL_CLIENTE)->get();
        $productos = Producto::query()->get();

        if ($clientes->isEmpty() || $productos->isEmpty()) {
            return;
        }

        Storage::disk('private')->put(
            'tickets/demo.png',
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=')
        );

        foreach ($productos->take(90) as $indice => $producto) {
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
                    'ticket' => 'tickets/demo.png',
                    'validada_at' => $indice % 2 === 0 ? now()->subDays($indice) : null,
                ]
            );
        }
    }
}
