@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Editar producto</h1>
        <form method="POST" action="{{ route('productos.update', $producto) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('productos.partials.form', ['producto' => $producto])
        </form>
    </section>
@endsection
