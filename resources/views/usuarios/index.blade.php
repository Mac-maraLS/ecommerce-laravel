@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Usuarios</h1>
        @can('create', App\Models\Usuario::class)
            <a class="button" href="{{ route('usuarios.create') }}">Nuevo usuario</a>
        @endcan
    </section>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Categorias por productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nombre_completo }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>
                        @forelse($usuario->categorias() as $categoria)
                            <span class="badge">{{ $categoria->nombre }}</span>
                        @empty
                            Sin categorias
                        @endforelse
                    </td>
                    <td class="actions">
                        @can('update', $usuario)
                            <a class="button secondary" href="{{ route('usuarios.edit', $usuario) }}">Editar</a>
                        @endcan
                        @can('delete', $usuario)
                            <form class="inline" method="POST" action="{{ route('usuarios.destroy', $usuario) }}">
                                @csrf
                                @method('DELETE')
                                <button>Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
