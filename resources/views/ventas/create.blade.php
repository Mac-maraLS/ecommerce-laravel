@extends('layouts.app')

@section('content')

<div style="max-width:500px; margin:3rem auto; padding:0 1.5rem;">
    <div class="card">
        <div style="text-align:center; margin-bottom:2.5rem;">
            <div style="width:64px; height:64px; background:linear-gradient(135deg,var(--accent),var(--accent-light)); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.8rem; margin:0 auto 1rem; box-shadow:0 8px 20px var(--accent-glow);">
                💳
            </div>
            <h1 class="title" style="margin-bottom:0.25rem;">Confirmar Pedido</h1>
            <p style="font-size:0.85rem; color:var(--text-muted);">Estás a un paso de disfrutar tu café</p>
        </div>

        <div style="background:var(--cream); border-radius:16px; padding:1.5rem; margin-bottom:2rem; border:1px solid var(--border);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <div>
                    <p style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:700;">Producto</p>
                    <h3 style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:var(--cafe-800);">{{ $product->name }}</h3>
                </div>
                <div style="text-align:right;">
                    <p style="font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; font-weight:700;">Precio</p>
                    <p style="font-size:1.2rem; font-weight:800; color:var(--cafe-500);">$ {{ number_format($product->price, 2) }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="/comprar" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div style="margin-bottom:2rem;">
                <label class="label">Comprobante de pago</label>
                <p style="font-size:0.75rem; color:var(--text-muted); margin-bottom:1rem;">Por favor, sube una foto de tu ticket o transferencia para validar tu pedido.</p>
                
                <div style="border:2px dashed var(--border); border-radius:16px; padding:2rem; text-align:center; background:var(--cream); transition:all 0.3s ease;">
                    <input type="file" name="ticket" style="font-size:0.85rem; color:var(--text-muted);" required>
                </div>
            </div>

            <button class="btn-full" style="display:flex; align-items:center; justify-content:center; gap:0.5rem; border:none; cursor:pointer;">
                <span>Finalizar Compra</span>
                <span style="font-size:1.2rem;">→</span>
            </button>
        </form>

        <a href="/catalogo" style="display:block; text-align:center; margin-top:1.5rem; font-size:0.8rem; color:var(--text-muted); text-decoration:none;">← Volver al catálogo</a>
    </div>
</div>

@endsection