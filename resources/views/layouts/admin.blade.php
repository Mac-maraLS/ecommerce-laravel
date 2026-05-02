<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — Café ToMaBra</title>
    @vite('resources/css/app.css')
</head>

<body style="background:var(--cream);">

<style>
    .admin-nav {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 0 8%;
        height: 56px;
        background: var(--cafe-800);
        border-bottom: 2px solid var(--accent);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .admin-logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.05rem;
        font-weight: 900;
        color: #fff;
        text-decoration: none;
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-right: 1rem;
    }

    .admin-logo-badge {
        font-size: 0.55rem;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        background: rgba(200,149,108,0.2);
        color: var(--accent-light);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }

    .admin-links {
        display: flex;
        gap: 0.15rem;
        flex: 1;
    }

    .admin-link {
        padding: 0.4rem 0.9rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 500;
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .admin-link:hover {
        background: rgba(255,255,255,0.08);
        color: rgba(255,255,255,0.9);
    }

    .admin-logout {
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.5);
        padding: 0.35rem 0.9rem;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.08);
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s ease;
    }

    .admin-logout:hover {
        background: rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.8);
    }
</style>

<nav class="admin-nav">
    <a href="/dashboard" class="admin-logo">
        ☕ ToMaBra <span class="admin-logo-badge">Admin</span>
    </a>

    <div class="admin-links">
        <a href="/dashboard" class="admin-link">Dashboard</a>
        <a href="/products" class="admin-link">Productos</a>
        <a href="/categorias" class="admin-link">Categorías</a>
    </div>

    <form method="POST" action="/logout">
        @csrf
        <button class="admin-logout">Cerrar sesión</button>
    </form>
</nav>

<div style="max-width:1200px; margin:0 auto; padding:2.5rem 2rem;">
    @yield('content')
</div>

</body>
</html>