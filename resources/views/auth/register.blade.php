@extends('layouts.app')

@section('content')

<h1 class="title">Registro</h1>

@if ($errors->any())
    <div class="alert-error">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="/register">
    @csrf

    <div class="form-group">
        <input type="text" name="nombre" placeholder="Nombre" class="input">
    </div>

    <div class="form-group">
        <input type="text" name="apellidos" placeholder="Apellidos" class="input">
    </div>

    <div class="form-group">
        <input type="text" name="correo" placeholder="Correo" class="input">
    </div>

    <div class="form-group">
        <input type="password" name="clave" placeholder="Contraseña" class="input">
    </div>

    <button class="btn-full">Registrarse</button>
</form>

@endsection