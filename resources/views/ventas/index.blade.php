@extends('layouts.app')

@section('content')

<div style="max-width:900px; margin:3rem auto; padding:0 1.5rem;">
    
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; padding-bottom:1.25rem; border-bottom:1px solid var(--border);">
        <div>
            <h1 class="title" style="margin-bottom:0.25rem;">Panel de Ventas</h1>
            <p style="font-size:0.85rem; color:var(--text-muted);">Seguimiento y validación de transacciones</p>
        </div>
        <div style="display:flex; gap:1.5rem; text-align:right;">
            <div>
                <p style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:700;">Total</p>
                <p style="font-size:1.2rem; font-weight:800; color:var(--cafe-800);">{{ $ventas->count() }}</p>
            </div>
            <div>
                <p style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:700;">Pendientes</p>
                <p style="font-size:1.2rem; font-weight:800; color:#e53e3e;">{{ $ventas->where('validada', false)->count() }}</p>
            </div>
        </div>
    </div>

    @forelse($ventas as $venta)
        <div class="card" style="display:flex; align-items:center; gap:1.5rem; margin-bottom:1.25rem; border-left:4px solid {{ $venta->validada ? '#10b981' : '#f59e0b' }};">
            
            <div style="width:50px; height:50px; background:var(--cream); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem;">
                💰
            </div>

            <div style="flex:1;">
                <h3 style="font-size:1rem; font-weight:700; color:var(--cafe-800); margin-bottom:0.25rem;">{{ $venta->producto->name }}</h3>
                <p style="font-size:0.8rem; color:var(--text-muted);">Comprado por: <span style="color:var(--cafe-600); font-weight:600;">{{ $venta->usuario->nombre }}</span></p>
            </div>

            <div style="text-align:center; padding:0 1.5rem;">
                <p style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:700; margin-bottom:0.25rem;">Estado</p>
                @if($venta->validada)
                    <span style="background:#ecfdf5; color:#065f46; font-size:0.7rem; font-weight:700; padding:0.25rem 0.75rem; border-radius:20px; text-transform:uppercase;">Validada</span>
                @else
                    <span style="background:#fff7ed; color:#9a3412; font-size:0.7rem; font-weight:700; padding:0.25rem 0.75rem; border-radius:20px; text-transform:uppercase;">Pendiente</span>
                @endif
            </div>

            <div style="display:flex; gap:0.5rem; align-items:center;">
                <a href="/ticket/{{ $venta->id }}" class="btn" style="background:var(--cream); border:1px solid var(--border); color:var(--cafe-700); font-size:0.75rem; text-decoration:none;">Ver Ticket</a>
                
                @if(!$venta->validada)
                    <form method="POST" action="/ventas/validar/{{ $venta->id }}" style="margin:0;">
                        @csrf
                        <button class="btn-primary" style="font-size:0.75rem; border:none; padding:0.5rem 1rem; border-radius:8px; cursor:pointer;">Validar</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div style="text-align:center; padding:5rem 2rem; color:var(--text-muted);">
            <p style="font-size:1rem;">No hay registros de ventas.</p>
        </div>
    @endforelse

</div>

@endsection