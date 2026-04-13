@extends('layouts.app')

@section('content')
<style>
    :root {
        --cafe-dark: #3D1A0E;
        --cafe-brown: #6B3A2A;
        --cafe-accent: #8B4513;
        --cafe-light: #F5F0EB;
        --cafe-border: #E8DDD5;
        --text-dark: #2C1810;
        --text-muted: #8B7355;
    }
    * { box-sizing: border-box; }
    .page-bg { background: #f9f5f1; min-height: 100vh; padding: 40px 0; font-family: Arial, sans-serif; }
    .inner { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
    .page-header { margin-bottom: 28px; padding-bottom: 18px; border-bottom: 1px solid var(--cafe-border); display: flex; justify-content: space-between; align-items: center; }
    .page-header h1 { font-size: 24px; font-weight: 700; color: var(--text-dark); margin: 0; }
    .page-header p { font-size: 13px; color: var(--text-muted); margin: 3px 0 0; }
    .badge-turn { background: var(--cafe-dark); color: #fff; font-size: 12px; padding: 6px 14px; border-radius: 20px; font-weight: 600; }

    /* Stat cards */
    .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 28px; }
    @media(max-width:700px){ .stats-grid { grid-template-columns: 1fr; } }
    .stat-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; padding: 20px 24px; box-shadow: 0 2px 8px rgba(61,26,14,.05); border-left: 4px solid var(--cafe-dark); }
    .stat-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--text-muted); margin-bottom: 6px; }
    .stat-value { font-size: 32px; font-weight: 800; color: var(--text-dark); line-height: 1; }

    /* Two-column layout */
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    @media(max-width:800px){ .two-col { grid-template-columns: 1fr; } }
    .section-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(61,26,14,.05); }
    .section-head { display: flex; justify-content: space-between; align-items: center; padding: 18px 20px; border-bottom: 1px solid var(--cafe-border); }
    .section-head h2 { font-size: 15px; font-weight: 700; color: var(--text-dark); margin: 0; }

    /* Buttons */
    .btn-primary { background: var(--cafe-dark); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background .15s; }
    .btn-primary:hover { background: var(--cafe-brown); }
    .btn-sm { padding: 5px 12px; font-size: 12px; border-radius: 6px; }
    .btn-outline { background: #fff; color: var(--text-dark); border: 1px solid var(--cafe-border); border-radius: 6px; padding: 5px 12px; font-size: 12px; cursor: pointer; transition: all .15s; }
    .btn-outline:hover { background: var(--cafe-light); }
    .btn-danger { background: #fff; color: #b91c1c; border: 1px solid #fecaca; border-radius: 6px; padding: 5px 12px; font-size: 12px; cursor: pointer; }
    .btn-danger:hover { background: #fee2e2; }

    /* Order list */
    .order-item { padding: 16px 20px; border-bottom: 1px solid #f5f0eb; }
    .order-item:last-child { border-bottom: none; }
    .order-top { display: flex; justify-content: space-between; align-items: flex-start; }
    .order-name { font-size: 14px; font-weight: 700; color: var(--text-dark); margin: 0; }
    .order-items { font-size: 13px; color: var(--text-muted); margin: 4px 0 0; }
    .order-bottom { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
    .order-time-urgent { font-size: 12px; color: #b91c1c; font-weight: 600; }
    .order-time-ok { font-size: 12px; color: var(--text-muted); }

    /* Badges */
    .badge { border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 700; }
    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-done { background: #d1fae5; color: #065f46; }
    .badge-out { background: #fee2e2; color: #991b1b; }

    /* Table */
    table { width: 100%; border-collapse: collapse; }
    th { background: #faf7f4; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); padding: 10px 16px; border-bottom: 1px solid var(--cafe-border); text-align: left; }
    td { padding: 12px 16px; font-size: 14px; color: var(--text-dark); border-bottom: 1px solid #f5f0eb; vertical-align: middle; }
    tr:last-child td { border-bottom: none; }

    /* Modal */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 999; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal-box { background: #fff; border-radius: 14px; width: 100%; max-width: 480px; box-shadow: 0 20px 60px rgba(61,26,14,.2); overflow: hidden; }
    .modal-head { padding: 20px 24px; border-bottom: 1px solid var(--cafe-border); display: flex; justify-content: space-between; align-items: center; background: var(--cafe-dark); }
    .modal-head h3 { font-size: 16px; font-weight: 700; color: #fff; margin: 0; }
    .modal-body-inner { padding: 24px; display: flex; flex-direction: column; gap: 14px; }
    .modal-foot { padding: 16px 24px; border-top: 1px solid var(--cafe-border); display: flex; justify-content: flex-end; gap: 10px; background: var(--cafe-light); }
    .form-field label { display: block; font-size: 11px; font-weight: 700; color: var(--text-muted); margin-bottom: 5px; text-transform: uppercase; letter-spacing: .05em; }
    .form-field input, .form-field select, .form-field textarea { width: 100%; border: 1px solid var(--cafe-border); border-radius: 8px; padding: 9px 12px; font-size: 14px; color: var(--text-dark); outline: none; background: #fff; font-family: inherit; transition: border .15s; }
    .form-field input:focus, .form-field select:focus, .form-field textarea:focus { border-color: var(--cafe-dark); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .close-btn { background: rgba(255,255,255,.2); border: none; color: #fff; font-size: 18px; cursor: pointer; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; line-height: 1; }

    /* Alert */
    .alert-success { background: #d1fae5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 16px; font-size: 14px; color: #065f46; margin-bottom: 20px; }
</style>

<div class="page-bg">
    <div class="inner">
        <div class="page-header">
            <div>
                <h1>Panel Operativo</h1>
                <p>Gestión de turnos y productos del día</p>
            </div>
            <span class="badge-turn">● Turno Activo</span>
        </div>

        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card" style="border-left-color:#b45309;">
                <p class="stat-label">Pedidos Pendientes</p>
                <p class="stat-value" style="color:#b45309;">8</p>
            </div>
            <div class="stat-card" style="border-left-color:#059669;">
                <p class="stat-label">Completados Hoy</p>
                <p class="stat-value" style="color:#059669;">45</p>
            </div>
            <div class="stat-card" style="border-left-color:#dc2626;">
                <p class="stat-label">Productos Agotados</p>
                <p class="stat-value" style="color:#dc2626;">2</p>
            </div>
        </div>

        <div class="two-col">
            {{-- Orders --}}
            <div class="section-card">
                <div class="section-head">
                    <h2>☕ Pedidos Entrantes</h2>
                </div>
                <div class="order-item">
                    <div class="order-top">
                        <div>
                            <p class="order-name">Orden #1042 — Mesa 4</p>
                            <p class="order-items">2× Cappuccino, 1× Cheesecake</p>
                        </div>
                        <span class="badge badge-pending">Pendiente</span>
                    </div>
                    <div class="order-bottom">
                        <span class="order-time-urgent">Hace 2 min</span>
                        <button class="btn-primary btn-sm">Marcar Listo</button>
                    </div>
                </div>
                <div class="order-item">
                    <div class="order-top">
                        <div>
                            <p class="order-name">Orden #1043 — Para Llevar</p>
                            <p class="order-items">1× Frappé Moka, 2× Croissant</p>
                        </div>
                        <span class="badge badge-pending">Pendiente</span>
                    </div>
                    <div class="order-bottom">
                        <span class="order-time-ok">Hace 5 min</span>
                        <button class="btn-primary btn-sm">Marcar Listo</button>
                    </div>
                </div>
                <div class="order-item" style="background:#faf7f4;">
                    <div class="order-top">
                        <div>
                            <p class="order-name">Orden #1041 — Mesa 2</p>
                            <p class="order-items">1× Americano, 1× Croissant Almendra</p>
                        </div>
                        <span class="badge badge-done">Listo</span>
                    </div>
                </div>
            </div>

            {{-- Inventory --}}
            <div class="section-card">
                <div class="section-head">
                    <h2>📦 Inventario Rápido</h2>
                    <button class="btn-primary btn-sm" onclick="document.getElementById('addProductModal').classList.add('open')">+ Nuevo</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $p)
                        <tr>
                            <td style="font-weight:600;">{{ $p->nombre }}</td>
                            <td>{{ $p->existencia }}</td>
                            <td>
                                @if($p->existencia > 0)
                                    <span class="badge badge-done">Disponible</span>
                                @else
                                    <span class="badge badge-out">Agotado</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex; gap:6px; align-items:center;">
                                    <form action="{{ route('products.toggleStock', $p->id) }}" method="POST" style="margin:0;">
                                        @csrf
                                        @if($p->existencia > 0)
                                            <button type="submit" class="btn-danger">Agotar</button>
                                        @else
                                            <button type="submit" class="btn-outline">Activar</button>
                                        @endif
                                    </form>
                                    <button class="btn-outline" style="padding:5px 8px;" onclick="openEditModal({{ $p->toJson() }})">✏️</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#8B7355; padding:24px;">No hay productos en inventario.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Product Modal --}}
<div class="modal-overlay" id="addProductModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3>☕ Agregar Nuevo Producto</h3>
            <button class="close-btn" onclick="document.getElementById('addProductModal').classList.remove('open')">×</button>
        </div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body-inner">
                <div class="form-field">
                    <label>Nombre del Producto</label>
                    <input type="text" name="nombre" required placeholder="Ej. Latte Vainilla">
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Precio ($)</label>
                        <input type="number" name="precio" step="0.01" required placeholder="0.00">
                    </div>
                    <div class="form-field">
                        <label>Stock inicial</label>
                        <input type="number" name="existencia" required placeholder="0">
                    </div>
                </div>
                <div class="form-field">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="2" required placeholder="Describe el producto brevemente..."></textarea>
                </div>
                <div class="form-field">
                    <label>Imagen</label>
                    <input type="file" name="imagen" accept="image/*" required>
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-outline" onclick="document.getElementById('addProductModal').classList.remove('open')">Cancelar</button>
                <button type="submit" class="btn-primary">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Product Modal --}}
<div class="modal-overlay" id="editProductModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3>✏️ Editar Producto</h3>
            <button class="close-btn" onclick="document.getElementById('editProductModal').classList.remove('open')">×</button>
        </div>
        <form id="editProductForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body-inner">
                <div class="form-field">
                    <label>Nombre del Producto</label>
                    <input type="text" name="nombre" id="edit_nombre" required>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Precio ($)</label>
                        <input type="number" name="precio" id="edit_precio" step="0.01" required>
                    </div>
                    <div class="form-field">
                        <label>Stock actual</label>
                        <input type="number" name="existencia" id="edit_stock" required>
                    </div>
                </div>
                <div class="form-field">
                    <label>Descripción</label>
                    <textarea name="descripcion" id="edit_descripcion" rows="2" required></textarea>
                </div>
                <div class="form-field">
                    <label>Actualizar Imagen (Opcional)</label>
                    <input type="file" name="imagen" accept="image/*">
                </div>
            </div>
            <div class="modal-foot" style="justify-content: space-between;">
                <button type="button" class="btn-danger" id="btnDeleteProduct" onclick="deleteProduct()">Eliminar Producto</button>
                <div style="display:flex; gap:10px;">
                    <button type="button" class="btn-outline" onclick="document.getElementById('editProductModal').classList.remove('open')">Cancelar</button>
                    <button type="submit" class="btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
        <form id="deleteProductForm" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    function openEditModal(product) {
        // Rellenar formulario
        document.getElementById('edit_nombre').value = product.nombre;
        document.getElementById('edit_precio').value = product.precio;
        document.getElementById('edit_stock').value = product.existencia;
        document.getElementById('edit_descripcion').value = product.descripcion;

        // Configurar acción del formulario PUT
        const form = document.getElementById('editProductForm');
        form.action = `/products/${product.id}`;

        // Configurar acción del formulario DELETE
        const delForm = document.getElementById('deleteProductForm');
        delForm.action = `/products/${product.id}`;

        // Mostrar modal
        document.getElementById('editProductModal').classList.add('open');
    }

    function deleteProduct() {
        if(confirm('¿Estás seguro de que deseas eliminar este producto permanentemente?')) {
            document.getElementById('deleteProductForm').submit();
        }
    }
</script>
@endsection
