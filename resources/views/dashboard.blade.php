@extends('layouts.admin')

@section('content')

<div style="max-width:1100px; margin:0 auto;">
    <div style="margin-bottom:3rem;">
        <p style="font-size:0.75rem; letter-spacing:2px; text-transform:uppercase; color:var(--text-muted); font-weight:700; margin-bottom:0.5rem;">Resumen General</p>
        <h1 class="title" style="font-size:2.2rem; margin:0;">Dashboard de Control</h1>
    </div>

    {{-- Stats Grid --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:1.5rem; margin-bottom:3rem;">
        
        <div class="card" style="display:flex; align-items:center; gap:1.5rem;">
            <div style="width:56px; height:56px; background:#f0f9ff; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.5rem;">👥</div>
            <div>
                <p style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:700; margin-bottom:2px;">Usuarios Totales</p>
                <p style="font-size:1.5rem; font-weight:900; color:var(--cafe-800);">{{ \App\Models\Usuario::count() }}</p>
            </div>
        </div>

        <div class="card" style="display:flex; align-items:center; gap:1.5rem;">
            <div style="width:56px; height:56px; background:#fefce8; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.5rem;">👔</div>
            <div>
                <p style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:700; margin-bottom:2px;">Vendedores</p>
                <p style="font-size:1.5rem; font-weight:900; color:var(--cafe-800);">{{ \App\Models\Usuario::where('rol','vendedor')->count() }}</p>
            </div>
        </div>

        <div class="card" style="display:flex; align-items:center; gap:1.5rem;">
            <div style="width:56px; height:56px; background:#f0fdf4; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.5rem;">☕</div>
            <div>
                <p style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; font-weight:700; margin-bottom:2px;">Clientes</p>
                <p style="font-size:1.5rem; font-weight:900; color:var(--cafe-800);">{{ \App\Models\Usuario::where('rol','cliente')->count() }}</p>
            </div>
        </div>

    </div>

    {{-- Highlight Section --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem;">
        
        <div class="card" style="background:linear-gradient(135deg, var(--cafe-800), var(--cafe-700)); color:#fff; border:none; position:relative; overflow:hidden; display:flex; flex-direction:column; justify-content:center; padding:3rem;">
            <div style="position:absolute; top:-10%; right:-10%; width:200px; height:200px; background:radial-gradient(circle, var(--accent-glow), transparent 70%); border-radius:50%;"></div>
            <div style="position:relative; z-index:2;">
                <p style="font-size:0.7rem; color:var(--accent-light); text-transform:uppercase; font-weight:700; letter-spacing:1px; margin-bottom:1rem;">Top de Ventas</p>
                <h2 style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:700; margin-bottom:1rem;">Producto Estrella</h2>
                <div style="width:40px; height:3px; background:var(--accent); border-radius:2px; margin-bottom:1.5rem;"></div>
                <p style="font-size:1.4rem; font-weight:600;">
                    {{ \App\Models\Product::withCount('ventas')
                        ->orderByDesc('ventas_count')
                        ->first()->name ?? 'N/A' }}
                </p>
            </div>
        </div>

        <div class="card" style="display:flex; flex-direction:column; justify-content:center; padding:2rem;">
            <h3 style="font-family:'Playfair Display',serif; font-size:1.2rem; font-weight:700; color:var(--cafe-800); margin-bottom:1.5rem;">Acciones Rápidas</h3>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                <a href="/products/create" style="padding:1rem; border:1.5px solid var(--border); border-radius:12px; text-decoration:none; color:var(--cafe-700); font-size:0.85rem; font-weight:600; text-align:center; transition:all 0.2s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">+ Nuevo Producto</a>
                <a href="/categorias/create" style="padding:1rem; border:1.5px solid var(--border); border-radius:12px; text-decoration:none; color:var(--cafe-700); font-size:0.85rem; font-weight:600; text-align:center; transition:all 0.2s;" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">+ Nueva Categoría</a>
            </div>
        </div>

    </div>
</div>

@endsection