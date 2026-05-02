@extends('layouts.app')

@section('content')

<h1 class="title">Verificar Código 2FA</h1>

@if(session('error'))
    <div class="alert-error">{{ session('error') }}</div>
@endif

<form method="POST" action="/verificar-codigo">
    @csrf

    <input type="text" name="codigo" placeholder="Código" class="input">

    <button class="btn-full mt-4">Verificar</button>
</form>

@endsection