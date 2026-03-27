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
    .page-header { margin-bottom: 28px; padding-bottom: 18px; border-bottom: 1px solid var(--cafe-border); display: flex; justify-content: space-between; align-items: flex-start; }
    .page-header h1 { font-size: 24px; font-weight: 700; color: var(--text-dark); margin: 0; }
    .page-header p { font-size: 13px; color: var(--text-muted); margin: 3px 0 0; }
    .header-right { text-align: right; }
    .caja-value { font-size: 20px; font-weight: 800; color: var(--text-dark); }
    .caja-label { font-size: 12px; color: var(--text-muted); }

    /* KPI Cards */
    .kpi-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
    @media(max-width:900px){ .kpi-grid { grid-template-columns: repeat(2,1fr); } }
    @media(max-width:500px){ .kpi-grid { grid-template-columns: 1fr; } }
    .kpi-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; padding: 20px; display: flex; justify-content: space-between; align-items: center; transition: box-shadow .2s; box-shadow: 0 2px 8px rgba(61,26,14,.05); }
    .kpi-card:hover { box-shadow: 0 6px 20px rgba(61,26,14,.1); }
    .kpi-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--text-muted); margin-bottom: 6px; }
    .kpi-value { font-size: 28px; font-weight: 800; color: var(--text-dark); line-height: 1; }
    .kpi-icon { font-size: 32px; opacity: .2; }

    /* Users table card */
    .section-card { background: #fff; border: 1px solid var(--cafe-border); border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(61,26,14,.05); }
    .section-head { display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; border-bottom: 1px solid var(--cafe-border); }
    .section-head h2 { font-size: 16px; font-weight: 700; color: var(--text-dark); margin: 0; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #faf7f4; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); padding: 11px 20px; border-bottom: 1px solid var(--cafe-border); text-align: left; }
    td { padding: 14px 20px; font-size: 14px; color: var(--text-dark); border-bottom: 1px solid #f5f0eb; vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: #faf7f4; }

    /* Badges */
    .badge { border-radius: 20px; padding: 3px 10px; font-size: 11px; font-weight: 700; }
    .badge-admin { background: #fee2e2; color: #991b1b; }
    .badge-emp { background: #fef3c7; color: #92400e; }
    .badge-cli { background: var(--cafe-light); color: var(--text-muted); }
    .badge-active { background: #d1fae5; color: #065f46; }
    .badge-inactive { background: #f3f4f6; color: #6b7280; }

    /* Avatar */
    .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--cafe-light); border: 2px solid var(--cafe-border); display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: var(--cafe-brown); margin-right: 10px; vertical-align: middle; }

    /* Buttons */
    .btn-primary { background: var(--cafe-dark); color: #fff; border: none; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background .15s; }
    .btn-primary:hover { background: var(--cafe-brown); }
    .btn-sm { padding: 5px 12px; font-size: 12px; border-radius: 6px; }
    .btn-outline { background: #fff; color: var(--text-dark); border: 1px solid var(--cafe-border); border-radius: 6px; padding: 5px 12px; font-size: 12px; cursor: pointer; transition: all .15s; }
    .btn-outline:hover { background: var(--cafe-light); }
    .btn-danger { background: #fff; color: #b91c1c; border: 1px solid #fecaca; border-radius: 6px; padding: 5px 12px; font-size: 12px; cursor: pointer; }
    .btn-danger:hover { background: #fee2e2; }

    /* Table footer */
    .table-foot { padding: 12px 24px; border-top: 1px solid var(--cafe-border); background: #faf7f4; font-size: 12px; color: var(--text-muted); }

    /* Modal */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 999; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal-box { background: #fff; border-radius: 14px; width: 100%; max-width: 460px; box-shadow: 0 20px 60px rgba(61,26,14,.2); overflow: hidden; }
    .modal-head { padding: 20px 24px; border-bottom: 1px solid var(--cafe-border); display: flex; justify-content: space-between; align-items: center; background: var(--cafe-dark); }
    .modal-head h3 { font-size: 16px; font-weight: 700; color: #fff; margin: 0; }
    .modal-body-inner { padding: 24px; display: flex; flex-direction: column; gap: 14px; }
    .modal-foot { padding: 16px 24px; border-top: 1px solid var(--cafe-border); display: flex; justify-content: flex-end; gap: 10px; background: var(--cafe-light); }
    .form-field label { display: block; font-size: 11px; font-weight: 700; color: var(--text-muted); margin-bottom: 5px; text-transform: uppercase; letter-spacing: .05em; }
    .form-field input, .form-field select { width: 100%; border: 1px solid var(--cafe-border); border-radius: 8px; padding: 9px 12px; font-size: 14px; color: var(--text-dark); outline: none; font-family: inherit; transition: border .15s; }
    .form-field input:focus, .form-field select:focus { border-color: var(--cafe-dark); }
    .close-btn { background: rgba(255,255,255,.2); border: none; color: #fff; font-size: 18px; cursor: pointer; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; }
    .alert-success { background: #d1fae5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 16px; font-size: 14px; color: #065f46; margin-bottom: 20px; }
</style>

<div class="page-bg">
    <div class="inner">
        <div class="page-header">
            <div>
                <h1>Dashboard Administrativo</h1>
                <p>Visión general del negocio — {{ date('d M Y') }}</p>
            </div>
            <div class="header-right">
                <p class="caja-value">$12,450.00</p>
                <p class="caja-label">Corte de caja hoy</p>
            </div>
        </div>

        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        {{-- KPIs --}}
        <div class="kpi-grid">
            <div class="kpi-card">
                <div><p class="kpi-label">Ventas Totales</p><p class="kpi-value">1,043</p></div>
                <span class="kpi-icon">🛒</span>
            </div>
            <div class="kpi-card">
                <div><p class="kpi-label">Ingresos</p><p class="kpi-value">$54k</p></div>
                <span class="kpi-icon">💰</span>
            </div>
            <div class="kpi-card">
                <div><p class="kpi-label">Productos Activos</p><p class="kpi-value">{{ $productsCount }}</p></div>
                <span class="kpi-icon">📦</span>
            </div>
            <div class="kpi-card">
                <div><p class="kpi-label">Usuarios</p><p class="kpi-value">{{ $users->count() }}</p></div>
                <span class="kpi-icon">👥</span>
            </div>
        </div>

        {{-- Users Table --}}
        <div class="section-card">
            <div class="section-head">
                <h2>👥 Gestión de Usuarios</h2>
                <button class="btn-primary btn-sm" onclick="document.getElementById('createUserModal').classList.add('open')">+ Añadir Usuario</button>
            </div>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th style="text-align:right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <span class="avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td style="color:var(--text-muted);">{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge badge-admin">Administrador</span>
                                @elseif($user->role == 'empleado')
                                    <span class="badge badge-emp">Empleado</span>
                                @else
                                    <span class="badge badge-cli">Cliente</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-active">● Activo</span>
                            </td>
                            <td style="text-align:right;">
                                <div style="display:inline-flex;gap:6px;">
                                    <button class="btn-outline">Editar</button>
                                    @if($user->role !== 'admin')
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $user->name }}?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-danger">Eliminar</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-foot">Mostrando {{ $users->count() }} usuarios en total</div>
        </div>
    </div>
</div>

{{-- Create User Modal --}}
<div class="modal-overlay" id="createUserModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3>👤 Crear Nuevo Usuario</h3>
            <button class="close-btn" onclick="document.getElementById('createUserModal').classList.remove('open')">×</button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="modal-body-inner">
                <div class="form-field">
                    <label>Nombre Completo</label>
                    <input type="text" name="name" required placeholder="Ej. Mariana Ríos">
                </div>
                <div class="form-field">
                    <label>Correo Electrónico</label>
                    <input type="email" name="email" required placeholder="correo@ejemplo.com">
                </div>
                <div class="form-field">
                    <label>Rol</label>
                    <select name="role" required>
                        <option value="cliente" selected>Cliente</option>
                        <option value="empleado">Empleado</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
                <div class="form-field">
                    <label>Contraseña Temporal</label>
                    <input type="password" name="password" required minlength="8" placeholder="Mínimo 8 caracteres">
                </div>
            </div>
            <div class="modal-foot">
                <button type="button" class="btn-outline" onclick="document.getElementById('createUserModal').classList.remove('open')">Cancelar</button>
                <button type="submit" class="btn-primary">Registrar Usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection
