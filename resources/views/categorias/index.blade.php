@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Categorias</h1>
        @can('create', App\Models\Categoria::class)
            <a class="button" href="{{ route('categorias.create') }}">Nueva categoria</a>
        @endcan
    </section>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>
                        @foreach($categoria->productos as $producto)
                            <span class="badge">{{ $producto->nombre }}</span>
                        @endforeach
                    </td>
                    <td class="actions">
                        @can('update', $categoria)
                            <a class="button secondary" href="{{ route('categorias.edit', $categoria) }}">Editar</a>
                        @endcan
                        @can('delete', $categoria)
                            <form class="inline" method="POST" action="{{ route('categorias.destroy', $categoria) }}">
                                @csrf
                                @method('DELETE')
                                <button>Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No hay categorias.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
