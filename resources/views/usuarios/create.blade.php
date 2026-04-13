@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Crear usuario</h1>
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf
            @include('usuarios.partials.form', ['usuario' => null])
        </form>
    </section>
@endsection
