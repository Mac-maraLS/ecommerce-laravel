@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Crear categoria</h1>
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf
            @include('categorias.partials.form', ['categoria' => null])
        </form>
    </section>
@endsection
