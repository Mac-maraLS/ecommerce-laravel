@extends('layouts.app')

@section('content')

<h1 class="title">Panel de Productos</h1>

<a href="/products/create" class="btn btn-primary mb-4">+ Crear producto</a>

<div class="grid-products">
    @foreach($products as $product)
        <div class="card">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p class="card-price">$ {{ $product->price }}</p>

            <form method="POST" action="/products/{{ $product->id }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-secondary mt-2">Eliminar</button>
            </form>
        </div>
    @endforeach
</div>

@endsection