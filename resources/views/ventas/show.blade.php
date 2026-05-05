@extends('layouts.app')

@section('content')
    <section class="card">
        <h1>Detalle de venta #{{ $venta->id }}</h1>
        <p><strong>Producto:</strong> {{ $venta->producto->nombre }}</p>
        <p><strong>Cliente:</strong> {{ $venta->cliente->nombre_completo }}</p>
        <p><strong>Vendedor:</strong> {{ $venta->vendedor->nombre_completo }}</p>
        <p><strong>Fecha:</strong> {{ $venta->fecha->format('Y-m-d') }}</p>
        <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
        <p><strong>Estado:</strong> {{ $venta->estaValidada() ? 'Validada' : 'Pendiente' }}</p>
        @can('viewTicket', $venta)
            <p><a class="button secondary" href="{{ route('ventas.ticket', $venta) }}">Ver ticket protegido</a></p>
        @endcan
    </section>
@endsection
