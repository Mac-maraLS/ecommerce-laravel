@extends('layouts.admin')

@section('content')

<form method="POST" action="/categorias">
@csrf

<input name="nombre">

<button>Guardar</button>

</form>

@endsection