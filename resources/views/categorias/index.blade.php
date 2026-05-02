@extends('layouts.admin')

@section('content')

<div style="max-width:800px; margin:0 auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; padding-bottom:1.25rem; border-bottom:1px solid var(--border);">
        <div>
            <h1 class="title" style="margin-bottom:0.25rem;">Gestión de Categorías</h1>
            <p style="font-size:0.85rem; color:var(--text-muted);">Organiza tu menú por secciones</p>
        </div>
        <a href="/categorias/create" class="btn btn-primary" style="text-decoration:none;">+ Nueva Categoría</a>
    </div>

    <div style="display:grid; grid-template-columns:1fr; gap:1rem;">
        @forelse($categorias as $cat)
            <div class="card" style="display:flex; justify-content:space-between; align-items:center; padding:1.25rem 1.75rem;">
                <div style="display:flex; align-items:center; gap:1rem;">
                    <div style="width:40px; height:40px; background:var(--cream); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1rem;">
                        📁
                    </div>
                    <span style="font-size:1rem; font-weight:700; color:var(--cafe-800);">{{ $cat->nombre }}</span>
                </div>

                <div style="display:flex; gap:0.75rem; align-items:center;">
                    <a href="/categorias/{{ $cat->id }}/edit" class="btn" style="background:var(--cream); border:1px solid var(--border); color:var(--cafe-700); font-size:0.75rem; text-decoration:none; padding:0.4rem 1rem;">Editar</a>
                    
                    <form method="POST" action="/categorias/{{ $cat->id }}" style="margin:0;" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn" style="background:#fff1f2; border:1px solid #fecaca; color:#b91c1c; font-size:0.75rem; padding:0.4rem 1rem; cursor:pointer;">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <div style="text-align:center; padding:4rem; background:#fff; border-radius:20px; border:1px dashed var(--border);">
                <p style="color:var(--text-muted);">No hay categorías creadas aún.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection