@extends('layouts.app')

@section('content')

<h1 class="text-2xl mb-4">Login</h1>

<form method="POST" action="/login">
@csrf

<input name="correo" placeholder="Correo" class="border p-2 mb-2 block">

<input type="password" name="clave" placeholder="Contraseña" class="border p-2 mb-2 block">

<button class="bg-amber-600 text-white px-4 py-2">
Entrar
</button>

</form>

@endsection