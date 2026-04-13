@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Editar venta</h1>
        <form method="POST" action="{{ route('ventas.update', $venta) }}">
            @csrf
            @method('PUT')
            @include('ventas.partials.form', ['venta' => $venta])
        </form>
    </section>
@endsection
