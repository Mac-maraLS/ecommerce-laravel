@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Nuevo Producto</h1>

<form method="POST" action="/products" enctype="multipart/form-data"
class="bg-white p-6 rounded-xl shadow max-w-lg">

@csrf

<input name="name" placeholder="Nombre" class="input mb-3">

<textarea name="description" placeholder="Descripción"
class="input mb-3"></textarea>

<input name="price" type="number" placeholder="Precio" class="input mb-3">

<input name="stock" type="number" placeholder="Stock" class="input mb-3">

<input type="file" name="image" class="mb-4">

<button class="btn-full">Guardar</button>

</form>

@endsection