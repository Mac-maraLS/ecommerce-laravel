@extends('layouts.app')

@section('content')
<style>
    :root {
        --cafe-dark: #3D1A0E;
        --cafe-brown: #6B3A2A;
        --cafe-light: #F5F0EB;
        --cafe-border: #E8DDD5;
        --text-dark: #2C1810;
        --text-muted: #8B7355;
    }
    * { box-sizing: border-box; }
    .page-bg { background: #f9f5f1; min-height: 100vh; padding: 40px 0; font-family: Arial, sans-serif; }
    .inner { max-width: 960px; margin: 0 auto; padding: 0 24px; }
    .page-header { margin-bottom: 28px; padding-bottom: 18px; border-bottom: 1px solid var(--cafe-border); }
    .page-header h1 { font-size: 24px; font-weight: 700; color: var(--text-dark); margin: 0; }
    .page-header p  { font-size: 13px; color: var(--text-muted); margin: 4px 0 0; }

    .layout { display: grid; grid-template-columns: 1fr 320px; gap: 24px; align-items: start; }
    @media(max-width:800px){ .layout { grid-template-columns: 1fr; } }

    /* Items card */
    .card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(61,26,14,.05); }
    .card-head { padding: 16px 20px; border-bottom: 1px solid var(--cafe-border); font-size: 14px; font-weight: 700; color: var(--text-dark); background: #faf7f4; }

    /* Cart item row */
    .cart-item { display: flex; align-items: center; gap: 16px; padding: 16px 20px; border-bottom: 1px solid #f5f0eb; }
    .cart-item:last-child { border-bottom: none; }
    .cart-item img { width: 72px; height: 72px; border-radius: 10px; object-fit: cover; flex-shrink: 0; border: 1px solid var(--cafe-border); }
    .item-info { flex: 1; }
    .item-name { font-size: 15px; font-weight: 700; color: var(--text-dark); margin: 0 0 4px; }
    .item-cat  { font-size: 12px; color: var(--text-muted); }
    .item-price { font-size: 15px; font-weight: 700; color: var(--cafe-brown); margin-top: 4px; }
    .qty-ctrl { display: flex; align-items: center; gap: 8px; }
    .qty-btn { width: 28px; height: 28px; border-radius: 50%; border: 1px solid var(--cafe-border); background: #fff; font-size: 16px; color: var(--text-dark); cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all .15s; }
    .qty-btn:hover { background: var(--cafe-light); }
    .qty-val { font-size: 15px; font-weight: 700; color: var(--text-dark); min-width: 24px; text-align: center; }
    .remove-btn { background: none; border: none; color: #b91c1c; cursor: pointer; font-size: 18px; padding: 4px; border-radius: 6px; transition: background .12s; }
    .remove-btn:hover { background: #fee2e2; }

    /* Empty state */
    .empty-state { padding: 60px 20px; text-align: center; }
    .empty-icon { font-size: 56px; margin-bottom: 16px; }
    .empty-state h2 { font-size: 18px; font-weight: 700; color: var(--text-dark); margin: 0 0 8px; }
    .empty-state p  { font-size: 14px; color: var(--text-muted); }

    /* Summary card */
    .summary-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(61,26,14,.05); }
    .summary-head { padding: 16px 20px; border-bottom: 1px solid var(--cafe-border); font-size: 14px; font-weight: 700; color: var(--text-dark); background: #faf7f4; }
    .summary-body { padding: 20px; }
    .sum-row { display: flex; justify-content: space-between; font-size: 14px; color: var(--text-muted); margin-bottom: 10px; }
    .sum-row.total { font-size: 17px; font-weight: 800; color: var(--text-dark); border-top: 1px solid var(--cafe-border); padding-top: 14px; margin-top: 4px; }
    .btn-checkout { width: 100%; background: var(--cafe-dark); color: #fff; border: none; border-radius: 10px; padding: 13px; font-size: 15px; font-weight: 700; cursor: pointer; transition: background .15s; margin-top: 16px; }
    .btn-checkout:hover { background: var(--cafe-brown); }
    .btn-back { display: block; text-align: center; margin-top: 12px; font-size: 13px; color: var(--text-muted); text-decoration: none; transition: color .12s; }
    .btn-back:hover { color: var(--cafe-dark); }
    .alert-success { background: #d1fae5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 16px; font-size: 14px; color: #065f46; margin-bottom: 20px; }
</style>

<div class="page-bg">
    <div class="inner">
        <div class="page-header">
            <h1>🛒 Mi Carrito</h1>
            <p>Revisa tus productos antes de confirmar el pedido</p>
        </div>

        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        @php
            // En el futuro esto vendrá de Session::get('carrito') o del modelo Carrito
            $carrito = session('carrito', []);
            $subtotal = 0;
            foreach($carrito as $item) { $subtotal += $item['precio'] * $item['cantidad']; }
            $envio = count($carrito) > 0 ? 25.00 : 0;
            $total = $subtotal + $envio;
        @endphp

        @if(count($carrito) > 0)
        <div class="layout">
            {{-- Items --}}
            <div class="card">
                <div class="card-head">{{ count($carrito) }} producto(s) en tu carrito</div>
                @foreach($carrito as $key => $item)
                <div class="cart-item">
                    <img src="{{ $item['img'] ?? 'https://images.unsplash.com/photo-1534685302058-75644251eb1f?q=80&w=200&auto=format&fit=crop' }}"
                         alt="{{ $item['nombre'] }}">
                    <div class="item-info">
                        <p class="item-name">{{ $item['nombre'] }}</p>
                        <p class="item-cat">{{ $item['categoria'] ?? 'Cafetería' }}</p>
                        <p class="item-price">${{ number_format($item['precio'], 2) }}</p>
                    </div>
                    <div class="qty-ctrl">
                        <form action="{{ route('carrito.cantidad') }}" method="POST" style="display:contents;">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $key }}">
                            <input type="hidden" name="accion" value="restar">
                            <button type="submit" class="qty-btn">−</button>
                        </form>
                        <span class="qty-val">{{ $item['cantidad'] }}</span>
                        <form action="{{ route('carrito.cantidad') }}" method="POST" style="display:contents;">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $key }}">
                            <input type="hidden" name="accion" value="sumar">
                            <button type="submit" class="qty-btn">+</button>
                        </form>
                    </div>
                    <form action="{{ route('carrito.quitar') }}" method="POST">
                        @csrf @method('DELETE')
                        <input type="hidden" name="producto_id" value="{{ $key }}">
                        <button type="submit" class="remove-btn" title="Eliminar">✕</button>
                    </form>
                </div>
                @endforeach
            </div>

            {{-- Summary --}}
            <div class="summary-card">
                <div class="summary-head">Resumen del pedido</div>
                <div class="summary-body">
                    <div class="sum-row"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                    <div class="sum-row"><span>Envío</span><span>${{ number_format($envio, 2) }}</span></div>
                    <div class="sum-row total"><span>Total</span><span>${{ number_format($total, 2) }}</span></div>
                    <button class="btn-checkout">Confirmar Pedido →</button>
                    <a href="{{ route('cliente.dashboard') }}" class="btn-back">← Seguir comprando</a>
                </div>
            </div>
        </div>

        @else
        {{-- Empty cart --}}
        <div class="card">
            <div class="empty-state">
                <div class="empty-icon">☕</div>
                <h2>Tu carrito está vacío</h2>
                <p>Agrega productos desde el menú para comenzar tu pedido</p>
                <a href="{{ route('cliente.dashboard') }}"
                   style="display:inline-block; margin-top:20px; background:#3D1A0E; color:#fff; border-radius:8px; padding:10px 24px; text-decoration:none; font-weight:600; font-size:14px;">
                    Ver el Menú
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
