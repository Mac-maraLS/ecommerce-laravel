@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Editar usuario</h1>
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
            @csrf
            @method('PUT')
            @include('usuarios.partials.form', ['usuario' => $usuario])
        </form>
    </section>
@endsection
