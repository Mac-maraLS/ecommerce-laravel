@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Productos</h1>
        @can('create', App\Models\Producto::class)
            <a class="button" href="{{ route('productos.create') }}">Nuevo producto</a>
        @endcan
    </section>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fotos</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Existencia</th>
                <th>Vendedor</th>
                <th>Categorias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>
                        @foreach($producto->fotos ?? [] as $foto)
                            <img class="thumb" src="{{ asset('storage/'.$foto) }}" alt="{{ $producto->nombre }}">
                        @endforeach
                    </td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->existencia }}</td>
                    <td>{{ $producto->vendedor->nombre_completo }}</td>
                    <td>
                        @foreach($producto->categorias as $categoria)
                            <span class="badge">{{ $categoria->nombre }}</span>
                        @endforeach
                    </td>
                    <td class="actions">
                        @can('update', $producto)
                            <a class="button secondary" href="{{ route('productos.edit', $producto) }}">Editar</a>
                        @endcan
                        @can('delete', $producto)
                            <form class="inline" method="POST" action="{{ route('productos.destroy', $producto) }}">
                                @csrf
                                @method('DELETE')
                                <button>Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay productos.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
