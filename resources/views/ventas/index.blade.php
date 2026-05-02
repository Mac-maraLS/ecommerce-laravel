@extends('layouts.app')

@section('content')

<h1 class="title">Panel de Ventas</h1>

@foreach($ventas as $venta)

<div class="card mb-4">
    <p><strong>Producto:</strong> {{ $venta->producto->name }}</p>
    <p><strong>Cliente:</strong> {{ $venta->usuario->nombre }}</p>

    <p>
        <strong>Estado:</strong>
        @if($venta->validada)
            <span class="text-green-600">Validada</span>
        @else
            <span class="text-red-600">Pendiente</span>
        @endif
    </p>

    <!-- VER TICKET -->
    <a href="/ticket/{{ $venta->id }}" class="btn btn-secondary">Ver Ticket</a>

    <!-- VALIDAR -->
    @if(!$venta->validada)
        <form method="POST" action="/ventas/validar/{{ $venta->id }}">
            @csrf
            <button class="btn btn-primary mt-2">Validar</button>
        </form>
    @endif

</div>

@endforeach

@endsection