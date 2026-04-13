@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Registrar venta</h1>
        <form method="POST" action="{{ route('ventas.store') }}">
            @csrf
            @include('ventas.partials.form', ['venta' => null])
        </form>
    </section>
@endsection
