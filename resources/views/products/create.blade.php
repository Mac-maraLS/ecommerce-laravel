@extends('layouts.app')

@section('content')

<div style="max-width:600px; margin:3rem auto; padding:0 1.5rem;">
    <div class="card">
        <div style="text-align:center; margin-bottom:2rem;">
            <div style="width:60px; height:60px; background:linear-gradient(135deg,var(--accent),var(--accent-light)); border-radius:16px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; margin:0 auto 1rem; box-shadow:0 6px 15px var(--accent-glow);">
                📦
            </div>
            <h1 class="title" style="margin-bottom:0.25rem;">Nuevo Producto</h1>
            <p style="font-size:0.85rem; color:var(--text-muted);">Añade un nuevo elemento al menú de ToMaBra</p>
        </div>

        <form method="POST" action="/products" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:1.25rem;">
                <label class="label">Nombre del Producto</label>
                <input name="name" placeholder="Ej. Latte Vainilla" class="input" required>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label class="label">Descripción</label>
                <textarea name="description" placeholder="Describe el sabor y origen..." class="textarea" rows="3" required></textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.25rem;">
                <div>
                    <label class="label">Precio ($)</label>
                    <input name="price" type="number" step="0.01" placeholder="0.00" class="input" required>
                </div>
                <div>
                    <label class="label">Stock inicial</label>
                    <input name="stock" type="number" placeholder="0" class="input" required>
                </div>
            </div>

            <div style="margin-bottom:2rem;">
                <label class="label">Imagen del producto</label>
                <div style="border:2px dashed var(--border); border-radius:12px; padding:1.5rem; text-align:center; background:var(--cream);">
                    <input type="file" name="image" style="font-size:0.8rem; color:var(--text-muted);" required>
                </div>
            </div>

            <div style="display:flex; gap:1rem;">
                <a href="/products" class="btn" style="flex:1; text-align:center; border:1.5px solid var(--border); color:var(--text-muted); text-decoration:none;">Cancelar</a>
                <button type="submit" class="btn-primary" style="flex:2; border:none; border-radius:12px; cursor:pointer;">Guardar Producto →</button>
            </div>
        </form>
    </div>
</div>

@endsection