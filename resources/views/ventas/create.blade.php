@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Registrar venta</h1>
        <form method="POST" action="{{ route('ventas.store') }}" enctype="multipart/form-data">
            @csrf
            @include('ventas.partials.form', ['venta' => null])
        </form>
    </section>
@endsection
