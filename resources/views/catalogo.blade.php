@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Menu de la cafeteria</h1>
        <p>Explora las bebidas y antojos disponibles hoy. Cada producto muestra su vendedor y sus categorias para evidenciar las relaciones del sistema.</p>
    </section>

    <section class="grid cols-3">
        @foreach($productos as $producto)
            <article class="card">
                <h3>{{ $producto->nombre }}</h3>
                <p>{{ $producto->descripcion }}</p>
                <p><strong>${{ number_format($producto->precio, 2) }}</strong> | Existencia: {{ $producto->existencia }}</p>
                <p>Vendedor: {{ $producto->vendedor->nombre_completo }}</p>
                <div>
                    @foreach($producto->categorias as $categoria)
                        <span class="badge">{{ $categoria->nombre }}</span>
                    @endforeach
                </div>
            </article>
        @endforeach
    </section>
@endsection
