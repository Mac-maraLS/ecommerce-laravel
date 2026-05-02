@extends('layouts.app')

@section('content')

<h1 class="title">Iniciar Sesión</h1>

@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="/login">
    @csrf

    <div class="form-group">
        <label class="label">Correo</label>
        <input type="text" name="correo" class="input">
    </div>

    <div class="form-group">
        <label class="label">Contraseña</label>
        <input type="password" name="clave" class="input">
    </div>

    <button class="btn-full">Entrar</button>
</form>

@endsection