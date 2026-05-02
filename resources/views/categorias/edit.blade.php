@extends('layouts.admin')

@section('content')

<form method="POST" action="/categorias/{{ $categoria->id }}">
@csrf
@method('PUT')

<input name="nombre" value="{{ $categoria->nombre }}">

<button>Actualizar</button>

</form>

@endsection