@extends('layouts.app')

@section('content')
    <section class="grid cols-3">
        <article class="card"><h2>{{ $totalProductos }}</h2><p>Productos registrados</p></article>
        <article class="card"><h2>{{ $totalCategorias }}</h2><p>Categorias registradas</p></article>
        <article class="card"><h2>{{ $totalVentas }}</h2><p>Ventas registradas</p></article>
    </section>

    <section class="card">
        <h2>Ultimas ventas</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                    <tr>
                        <td>{{ $venta->producto->nombre }}</td>
                        <td>{{ $venta->cliente->nombre_completo }}</td>
                        <td>{{ $venta->vendedor->nombre_completo }}</td>
                        <td>{{ $venta->fecha->format('Y-m-d') }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">No hay ventas registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
