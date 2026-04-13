@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Mini Proyecto 2</h1>
        <p>Sistema e-commerce con relaciones Eloquent, roles, Policies, Gates, FormRequest, seeders y bitacoras.</p>
    </section>

    <section class="grid cols-3">
        @foreach($productos as $producto)
            <article class="card">
                <h3>{{ $producto->nombre }}</h3>
                <p>{{ $producto->descripcion }}</p>
                <p><strong>${{ number_format($producto->precio, 2) }}</strong></p>
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
