@extends('layouts.app')

@section('content')

<style>
    .catalog-header {
        text-align: center;
        padding: 3.5rem 2rem 2.5rem;
        animation: fadeInUp 0.5s var(--transition) both;
    }

    .catalog-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        background: rgba(200,149,108,0.08);
        border: 1px solid rgba(200,149,108,0.2);
        border-radius: 100px;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 1rem;
    }

    .catalog-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--cafe-800);
        letter-spacing: -0.03em;
    }

    .catalog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 0 8% 4rem;
    }

    .product-card {
        background: #fff;
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--card-shadow);
        transition: all 0.4s var(--transition);
        animation: fadeInUp 0.5s var(--transition) both;
    }

    .product-card:nth-child(2) { animation-delay: 0.1s; }
    .product-card:nth-child(3) { animation-delay: 0.15s; }
    .product-card:nth-child(4) { animation-delay: 0.2s; }
    .product-card:nth-child(5) { animation-delay: 0.25s; }
    .product-card:nth-child(6) { animation-delay: 0.3s; }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(61,26,14,0.14);
    }

    .product-img-wrap {
        height: 230px;
        overflow: hidden;
        position: relative;
    }

    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s var(--transition);
    }

    .product-card:hover .product-img-wrap img {
        transform: scale(1.08);
    }

    .product-img-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 60px;
        background: linear-gradient(transparent, rgba(0,0,0,0.03));
        pointer-events: none;
    }

    .product-body {
        padding: 1.5rem;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--cafe-800);
        margin-bottom: 0.4rem;
        letter-spacing: -0.01em;
    }

    .product-desc {
        font-size: 0.8rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 1.25rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .product-price {
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--cafe-500);
        letter-spacing: -0.02em;
    }

    .product-action {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1.25rem;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s var(--transition);
    }

    .product-action-buy {
        background: linear-gradient(135deg, var(--cafe-700), var(--cafe-500));
        color: #fff;
        box-shadow: 0 3px 12px rgba(61,26,14,0.2);
    }

    .product-action-buy:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(61,26,14,0.3);
    }

    .product-action-login {
        border: 1.5px solid var(--border);
        color: var(--cafe-700);
    }

    .product-action-login:hover {
        border-color: var(--accent);
        background: rgba(200,149,108,0.05);
    }

    .empty-catalog {
        grid-column: 1/-1;
        text-align: center;
        padding: 6rem 2rem;
        animation: fadeIn 0.6s ease;
    }

    .empty-catalog-icon {
        font-size: 3.5rem;
        margin-bottom: 1.25rem;
        opacity: 0.5;
    }
</style>

<div class="catalog-header">
    <span class="catalog-badge">☕ Nuestra selección</span>
    <h1 class="catalog-title">Catálogo</h1>
    <div class="accent-bar" style="margin:1rem auto 0;"></div>
</div>

<div class="catalog-grid">
    @forelse($products as $product)
        <div class="product-card">
            <div class="product-img-wrap">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&auto=format' }}"
                     alt="{{ $product->name }}" loading="lazy">
                <div class="product-img-overlay"></div>
            </div>
            <div class="product-body">
                <h2 class="product-name">{{ $product->name }}</h2>
                <p class="product-desc">{{ $product->description }}</p>
                <div class="product-footer">
                    <span class="product-price">$ {{ number_format($product->price, 2) }}</span>
                    @auth
                        <a href="/comprar/{{ $product->id }}" class="product-action product-action-buy">Comprar →</a>
                    @else
                        <a href="/login" class="product-action product-action-login">Inicia sesión</a>
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="empty-catalog">
            <div class="empty-catalog-icon">📦</div>
            <p style="font-size:1.1rem; font-weight:600; color:var(--cafe-800); margin-bottom:0.5rem;">No hay productos disponibles</p>
            <p style="font-size:0.85rem; color:var(--text-muted);">Pronto agregaremos nuevos productos al catálogo.</p>
        </div>
    @endforelse
</div>

@endsection