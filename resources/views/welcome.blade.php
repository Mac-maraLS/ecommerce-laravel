@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1>Cafe Aroma</h1>
        <p>Una cafeteria de barrio con cafe de especialidad, bebidas frias, panaderia del dia y postres artesanales. Esta portada muestra el sistema funcionando como una pagina real antes de entrar al panel administrativo.</p>
        <div class="actions">
            <a class="button" href="{{ route('catalogo') }}">Ver menu</a>
            @guest
                <a class="button secondary" href="{{ route('login') }}">Entrar al sistema</a>
            @else
                <a class="button secondary" href="{{ auth()->user()->esAdministrador() ? route('dashboard') : route('ventas.index') }}">Ir al sistema</a>
            @endguest
        </div>
    </section>

    <section class="grid cols-3">
        @foreach($productos as $producto)
            <article class="card">
                @if($producto->primeraFoto())
                    <img class="product-image" src="{{ asset('storage/'.$producto->primeraFoto()) }}" alt="{{ $producto->nombre }}">
                @endif
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
