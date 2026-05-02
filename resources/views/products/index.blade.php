@extends('layouts.app')

@section('content')

<div style="max-width:1100px; margin:0 auto; padding:2.5rem 2rem;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; padding-bottom:1.25rem; border-bottom:1px solid var(--border);">
        <div>
            <h1 class="title" style="margin-bottom:0.25rem;">Panel de Productos</h1>
            <p style="font-size:0.85rem; color:var(--text-muted);">Gestiona tu inventario de productos</p>
        </div>
        <a href="/products/create" class="btn btn-primary">+ Crear producto</a>
    </div>

    <div class="grid-products">
        @foreach($products as $product)
            <div class="card" style="position:relative; overflow:hidden;">
                <div style="position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--accent),var(--accent-light)); transform:scaleX(0); transform-origin:left; transition:transform 0.3s;" onmouseover="this.style.transform='scaleX(1)'" onmouseout="this.style.transform='scaleX(0)'"></div>

                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" style="width:100%; height:160px; object-fit:cover; border-radius:12px; margin-bottom:1rem;">
                @endif

                <h2 class="card-title">{{ $product->name }}</h2>
                <p style="font-size:0.8rem; color:var(--text-muted); margin:0.5rem 0 1rem; line-height:1.5;">{{ $product->description }}</p>
                <p class="card-price" style="margin-bottom:1rem;">$ {{ number_format($product->price, 2) }}</p>

                <form method="POST" action="/products/{{ $product->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" style="font-size:0.75rem; padding:0.4rem 1rem;">Eliminar</button>
                </form>
            </div>
        @endforeach
    </div>

</div>

@endsection