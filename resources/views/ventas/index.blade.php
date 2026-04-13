@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Ventas</h1>
        @can('create', App\Models\Venta::class)
            <a class="button" href="{{ route('ventas.create') }}">Registrar venta</a>
        @endcan
    </section>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ $venta->producto->nombre }}</td>
                    <td>{{ $venta->cliente->nombre_completo }}</td>
                    <td>{{ $venta->vendedor->nombre_completo }}</td>
                    <td>{{ $venta->fecha->format('Y-m-d') }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td class="actions">
                        <a class="button secondary" href="{{ route('ventas.show', $venta) }}">Ver</a>
                        @can('update', $venta)
                            <a class="button secondary" href="{{ route('ventas.edit', $venta) }}">Editar</a>
                        @endcan
                        @can('delete', $venta)
                            <form class="inline" method="POST" action="{{ route('ventas.destroy', $venta) }}">
                                @csrf
                                @method('DELETE')
                                <button>Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No hay ventas.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
