@extends('layouts.app')

@section('content')
    <section class="grid cols-3">
        <article class="card"><h2>{{ $totalUsuarios }}</h2><p>Usuarios totales</p></article>
        <article class="card"><h2>{{ $totalVendedores }}</h2><p>Vendedores</p></article>
        <article class="card"><h2>{{ $totalCompradores }}</h2><p>Compradores</p></article>
        <article class="card"><h2>{{ $totalProductos }}</h2><p>Productos del menu</p></article>
        <article class="card"><h2>{{ $totalCategorias }}</h2><p>Categorias del cafe</p></article>
        <article class="card"><h2>{{ $totalVentas }}</h2><p>Ventas registradas</p></article>
    </section>

    <section class="grid cols-2">
        <article class="card">
            <h2>Productos por categoria</h2>
            <table>
                <thead><tr><th>Categoria</th><th>Productos</th></tr></thead>
                <tbody>
                    @foreach($productosPorCategoria as $categoria)
                        <tr>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->productos_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>

        <article class="card">
            <h2>Producto mas vendido</h2>
            @if($productoMasVendido)
                <p>{{ $productoMasVendido->nombre }}</p>
                <p>Ventas: {{ $productoMasVendido->ventas_count }}</p>
            @else
                <p>No hay ventas registradas.</p>
            @endif
        </article>
    </section>

    <section class="grid cols-2">
        <article class="card">
            <h2>Comprador frecuente por categoria</h2>
            <table>
                <thead><tr><th>Categoria</th><th>Comprador</th></tr></thead>
                <tbody>
                    @foreach($compradorFrecuentePorCategoria as $fila)
                        <tr>
                            <td>{{ $fila['categoria']->nombre }}</td>
                            <td>{{ $fila['comprador']?->nombre_completo ?? 'Sin ventas' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>

        <article class="card">
            <h2>hasManyThrough</h2>
            <table>
                <thead><tr><th>Vendedor</th><th>Categorias producto</th></tr></thead>
                <tbody>
                    @foreach($vendedoresConCategorias as $vendedor)
                        <tr>
                            <td>{{ $vendedor->nombre_completo }}</td>
                            <td>{{ $vendedor->categoria_productos_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </article>
    </section>

    <section class="card">
        <h2>Ultimas ventas en caja</h2>
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
