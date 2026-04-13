@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Crear producto</h1>
        <form method="POST" action="{{ route('productos.store') }}">
            @csrf
            @include('productos.partials.form', ['producto' => null])
        </form>
    </section>
@endsection
