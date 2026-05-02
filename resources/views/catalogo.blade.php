@extends('layouts.app')

@section('content')

<div class="px-16 py-10">

<h1 class="text-3xl font-serif mb-10">Catálogo</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-10">

@foreach($products as $product)

<div>

    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1509042239860-f550ce710b93' }}"
         class="w-full h-72 object-cover mb-4">

    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>

    <p class="text-gray-500 text-sm mb-2">
        {{ $product->description }}
    </p>

    <p class="font-bold mb-3">$ {{ $product->price }}</p>

    @auth
        <a href="/comprar/{{ $product->id }}"
           class="border px-4 py-2 text-sm">
            Comprar
        </a>
    @else
        <a href="/login"
           class="border px-4 py-2 text-sm">
            Inicia sesión
        </a>
    @endauth

</div>

@endforeach

</div>

</div>

@endsection