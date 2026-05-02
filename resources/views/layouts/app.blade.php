<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café ToMaBra</title>
    @vite('resources/css/app.css')
</head>

<body>

<!-- NAV -->
<nav id="mainNav" style="display:flex; justify-content:space-between; align-items:center; padding:0 8%; height:64px; background:rgba(250,247,243,0.85); backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px); border-bottom:1px solid rgba(232,221,213,0.6); position:sticky; top:0; z-index:100; transition:all 0.3s ease;">

    <a href="/" style="font-family:'Playfair Display',serif; font-size:1.3rem; font-weight:900; color:var(--cafe-800); text-decoration:none; letter-spacing:-0.03em; display:flex; align-items:center; gap:0.5rem;">
        <span style="font-size:1.1rem;">☕</span> Café <span style="color:var(--accent);">ToMaBra</span>
    </a>

    <div style="display:flex; gap:0.15rem; align-items:center;">
        <a href="/" class="nav-pill">Inicio</a>
        <a href="/catalogo" class="nav-pill">Catálogo</a>
        <a href="/nosotros" class="nav-pill">Nosotros</a>
        <a href="/contacto" class="nav-pill">Contacto</a>
    </div>

    <div style="display:flex; gap:0.5rem; align-items:center;">
        @auth
            <form method="POST" action="/logout">
                @csrf
                <button class="nav-btn-logout">Cerrar sesión</button>
            </form>
        @else
            <a href="/login" class="nav-btn-outline">Entrar</a>
            <a href="/register" class="nav-btn-filled">Crear cuenta</a>
        @endauth
    </div>

</nav>

<style>
    .nav-pill {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--cafe-600);
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
    }
    .nav-pill:hover {
        background: rgba(200,149,108,0.1);
        color: var(--cafe-800);
    }
    .nav-pill::after {
        content: '';
        position: absolute;
        bottom: 2px; left: 50%;
        width: 0; height: 2px;
        background: var(--accent);
        border-radius: 1px;
        transform: translateX(-50%);
        transition: width 0.25s ease;
    }
    .nav-pill:hover::after { width: 50%; }

    .nav-btn-outline {
        padding: 0.45rem 1.1rem;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--cafe-700);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .nav-btn-outline:hover {
        border-color: var(--accent);
        background: rgba(200,149,108,0.06);
    }

    .nav-btn-filled {
        padding: 0.45rem 1.1rem;
        background: linear-gradient(135deg, var(--cafe-700), var(--cafe-500));
        color: #fff;
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 2px 10px rgba(61,26,14,0.2);
        transition: all 0.25s ease;
    }
    .nav-btn-filled:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 16px rgba(61,26,14,0.3);
    }

    .nav-btn-logout {
        padding: 0.45rem 1.1rem;
        background: transparent;
        border: 1.5px solid rgba(239,68,68,0.2);
        border-radius: 10px;
        font-size: 0.78rem;
        font-weight: 600;
        color: #b91c1c;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s ease;
    }
    .nav-btn-logout:hover {
        background: #fef2f2;
        border-color: rgba(239,68,68,0.3);
    }

    /* Nav scroll effect */
    .nav-scrolled {
        box-shadow: 0 4px 20px rgba(61,26,14,0.06);
    }
</style>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 20) {
            nav.classList.add('nav-scrolled');
        } else {
            nav.classList.remove('nav-scrolled');
        }
    });
</script>

<div>
    @yield('content')
</div>

<!-- FOOTER -->
<footer style="background:linear-gradient(180deg, var(--cafe-900), #0d0805); color:rgba(255,255,255,0.4); padding:3rem 8% 2rem; margin-top:4rem; position:relative;">
    <div style="position:absolute; top:0; left:0; right:0; height:1px; background:linear-gradient(90deg, transparent, var(--accent), transparent);"></div>
    <div style="max-width:1100px; margin:0 auto; display:flex; justify-content:space-between; align-items:center;">
        <div>
            <p style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:rgba(255,255,255,0.7); margin-bottom:0.25rem;">☕ Café ToMaBra</p>
            <p style="font-size:0.75rem;">De las montañas de Chiapas a tu taza.</p>
        </div>
        <p style="font-size:0.7rem;">&copy; 2026 Todos los derechos reservados.</p>
    </div>
</footer>

</body>
</html>