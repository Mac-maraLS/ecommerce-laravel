@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-6">Comprar producto</h1>

<p class="mb-2"><strong>{{ $product->name }}</strong></p>
<p class="mb-4">$ {{ $product->price }}</p>

<form method="POST" action="/comprar" enctype="multipart/form-data">
@csrf

<input type="hidden" name="product_id" value="{{ $product->id }}">

<label>Subir comprobante</label>
<input type="file" name="ticket" class="block mb-4">

<button class="bg-amber-600 text-white px-4 py-2">
Comprar
</button>

</form>

@endsection