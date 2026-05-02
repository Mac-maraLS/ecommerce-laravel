@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-6 text-center">Crear cuenta</h2>

<form method="POST" action="/register">
@csrf

<input name="nombre" placeholder="Nombre" class="input mb-3">
<input name="apellidos" placeholder="Apellidos" class="input mb-3">
<input name="correo" placeholder="Correo" class="input mb-3">
<input type="password" name="clave" placeholder="Contraseña" class="input mb-4">

<button class="btn-full">Registrarse</button>

</form>

</div>

@endsection