@extends('layouts.admin')

@section('content')

<h1>Categorías</h1>

<a href="/categorias/create">Nueva</a>

@foreach($categorias as $cat)
    <p>
        {{ $cat->nombre }}

        <a href="/categorias/{{ $cat->id }}/edit">Editar</a>

        <form method="POST" action="/categorias/{{ $cat->id }}">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </p>
@endforeach

@endsection