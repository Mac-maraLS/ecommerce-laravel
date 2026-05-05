<h1>Venta validada</h1>

<p>Producto vendido: <strong>{{ $venta->producto->nombre }}</strong></p>
<p>Comprador: {{ $venta->cliente->nombre_completo }}</p>
<p>Correo del comprador: {{ $venta->cliente->correo }}</p>
<p>Total: ${{ number_format($venta->total, 2) }}</p>
