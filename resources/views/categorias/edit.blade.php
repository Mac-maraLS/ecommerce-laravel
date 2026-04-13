@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Editar categoria</h1>
        <form method="POST" action="{{ route('categorias.update', $categoria) }}">
            @csrf
            @method('PUT')
            @include('categorias.partials.form', ['categoria' => $categoria])
        </form>
    </section>
@endsection
