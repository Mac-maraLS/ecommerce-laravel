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
    .inner { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .page-header { display: flex; align-items: center; gap: 16px; margin-bottom: 32px; padding-bottom: 20px; border-bottom: 1px solid var(--cafe-border); }
    .page-header h1 { font-size: 26px; font-weight: 700; color: var(--text-dark); margin: 0; }
    .page-header p { font-size: 14px; color: var(--text-muted); margin: 4px 0 0; }

    .layout { display: grid; grid-template-columns: 230px 1fr; gap: 28px; }
    .sidebar-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; padding: 20px; height: fit-content; box-shadow: 0 2px 8px rgba(61,26,14,.06); position: sticky; top: 20px; }
    .sidebar-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--text-muted); margin-bottom: 12px; }
    .cat-btn { display: flex; align-items: center; justify-content: space-between; width: 100%; padding: 10px 12px; border: none; border-radius: 8px; font-size: 14px; text-align: left; cursor: pointer; transition: all .15s; margin-bottom: 4px; }
    .cat-btn.active { background: var(--cafe-dark); color: #fff; font-weight: 600; }
    .cat-btn:not(.active) { background: transparent; color: var(--text-dark); }
    .cat-btn:not(.active):hover { background: var(--cafe-light); }
    .cat-count { font-size: 11px; padding: 2px 7px; border-radius: 20px; font-weight: 600; }
    .cat-btn.active .cat-count { background: rgba(255,255,255,.25); color: #fff; }
    .cat-btn:not(.active) .cat-count { background: var(--cafe-light); color: var(--text-muted); }

    .products-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    @media(max-width:900px) { .layout { grid-template-columns: 1fr; } .products-grid { grid-template-columns: repeat(2,1fr); } }
    @media(max-width:600px) { .products-grid { grid-template-columns: 1fr; } }
    .product-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s, opacity .25s; display: flex; flex-direction: column; }
    .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(61,26,14,.12); }
    .product-card.hidden-card { display: none; }
    .product-card img { width: 100%; height: 185px; object-fit: cover; }
    .card-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
    .card-cat { font-size: 11px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }
    .card-name { font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; }
    .card-desc { font-size: 13px; color: var(--text-muted); flex: 1; margin-bottom: 14px; line-height: 1.5; }
    .card-footer { display: flex; justify-content: space-between; align-items: center; }
    .card-price { font-size: 17px; font-weight: 700; color: var(--cafe-brown); }
    .btn-add { background: var(--cafe-dark); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background .15s; }
    .btn-add:hover { background: var(--cafe-brown); }

    .no-results { display: none; grid-column: 1/-1; text-align: center; padding: 60px 0; color: var(--text-muted); font-size: 15px; }
    .no-results.visible { display: block; }
    .alert-success { background: #d1fae5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 16px; font-size: 14px; color: #065f46; margin-bottom: 20px; }
</style>

<div class="page-bg">
    <div class="inner">
        <div class="page-header">
            <div>
                <h1>☕ Nuestro Menú</h1>
                <p>Descubre el sabor auténtico del café chiapaneco</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        <div class="layout">
            {{-- Sidebar --}}
            <aside>
                <div class="sidebar-card">
                    <p class="sidebar-label">Categorías</p>
                    <button class="cat-btn active" data-cat="todos">Todos <span class="cat-count">{{ $productos->count() }}</span></button>
                    <button class="cat-btn" data-cat="bebidas_calientes">Bebidas Calientes <span class="cat-count">{{ $productos->where('category', 'bebidas_calientes')->count() }}</span></button>
                    <button class="cat-btn" data-cat="frappes">Frappés <span class="cat-count">{{ $productos->where('category', 'frappes')->count() }}</span></button>
                    <button class="cat-btn" data-cat="postres">Postres <span class="cat-count">{{ $productos->where('category', 'postres')->count() }}</span></button>
                </div>
            </aside>

            {{-- Catalog --}}
            <section>
                <div class="products-grid" id="productsGrid">
                    @if(count($productos) > 0)
                        @foreach($productos as $producto)
                        <div class="product-card" data-categoria="{{ $producto->category }}">
                            <img src="{{ $producto->image ? asset('storage/' . $producto->image) : 'https://images.unsplash.com/photo-1534685302058-75644251eb1f?q=80&w=600&auto=format&fit=crop' }}" alt="{{ $producto->name }}" loading="lazy">
                            <div class="card-body">
                                <p class="card-cat">{{ ucwords(str_replace('_', ' ', $producto->category)) }}</p>
                                <h3 class="card-name">{{ $producto->name }}</h3>
                                <p class="card-desc">{{ $producto->description }}</p>
                                <div class="card-footer">
                                    <span class="card-price">${{ number_format($producto->price, 2) }}</span>
                                    <form action="{{ route('carrito.agregar') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                        <button type="submit" class="btn-add">Agregar al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="no-results visible" style="grid-column:1/-1;">
                            😕 Aún no hay productos registrados en el menú.
                        </div>
                    @endif

                    <div class="no-results" id="noResults">
                        😕 No hay productos en esta categoría.
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    const catButtons = document.querySelectorAll('.cat-btn');
    const cards      = document.querySelectorAll('.product-card');
    const noResults  = document.getElementById('noResults');

    catButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            // Actualizar botón activo
            catButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const selected = this.dataset.cat;
            let visible = 0;

            cards.forEach(card => {
                const cardCat = card.dataset.categoria;
                if (selected === 'todos' || cardCat === selected) {
                    card.classList.remove('hidden-card');
                    visible++;
                } else {
                    card.classList.add('hidden-card');
                }
            });

            // Mostrar mensaje si no hay resultados
            noResults.classList.toggle('visible', visible === 0);
        });
    });
</script>
@endsection
