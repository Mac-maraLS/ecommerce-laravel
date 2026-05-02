@extends('layouts.app')

@section('content')

<h1 class="title">Nuevo Producto</h1>

@if ($errors->any())
    <div class="alert-error">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="/products">
    @csrf

    <input type="text" name="name" placeholder="Nombre" class="input mb-3">
    <textarea name="description" placeholder="Descripción" class="textarea mb-3"></textarea>
    <input type="number" name="price" placeholder="Precio" class="input mb-3">
    <input type="number" name="stock" placeholder="Stock" class="input mb-3">

    <button class="btn-full">Guardar</button>
</form>

@endsection