@extends('layouts.app')

@section('content')

<h1 class="title">Catálogo</h1>

<div class="grid-products">
    @foreach($products as $product)
        <div class="card">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p class="card-price">$ {{ $product->price }}</p>
        </div>
    @endforeach
</div>

@endsection