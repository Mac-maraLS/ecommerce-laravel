<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cafe Aroma' }}</title>
    <style>
        :root {
            --bg: #f5f1ea;
            --card: #ffffff;
            --ink: #1f2937;
            --accent: #9a3412;
            --accent-soft: #fed7aa;
            --line: #d6d3d1;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Georgia, serif; background:
            radial-gradient(circle at top left, #f6d7b8 0, transparent 28%),
            radial-gradient(circle at top right, #f3e7d3 0, transparent 24%),
            linear-gradient(180deg, #f7f2eb 0%, #efe5d6 100%);
            color: var(--ink); }
        nav, main { width: min(1120px, calc(100% - 32px)); margin: 0 auto; }
        nav { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between; padding: 20px 0; }
        nav a, nav button { text-decoration: none; color: var(--ink); background: var(--card); border: 1px solid var(--line); border-radius: 999px; padding: 10px 16px; cursor: pointer; }
        nav .links { display: flex; flex-wrap: wrap; gap: 10px; }
        .brand { font-size: 28px; font-weight: 700; letter-spacing: .02em; color: #7c2d12; }
        main { padding-bottom: 40px; }
        .hero, .card { background: var(--card); border: 1px solid var(--line); border-radius: 18px; padding: 24px; margin-bottom: 18px; box-shadow: 0 10px 30px rgba(120, 53, 15, .08); }
        .hero { padding: 44px; background: linear-gradient(135deg, rgba(154,52,18,.95), rgba(120,53,15,.92)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1600&auto=format&fit=crop') center/cover; color: white; }
        .hero h1 { font-size: clamp(38px, 6vw, 68px); margin: 0 0 12px; line-height: .95; }
        .hero p { max-width: 620px; font-size: 18px; color: rgba(255,255,255,.9); }
        .hero .actions { margin-top: 22px; }
        .hero .button.secondary { background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.3); }
        .grid { display: grid; gap: 18px; }
        .grid.cols-2 { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .grid.cols-3 { grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
        table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: 18px; overflow: hidden; }
        th, td { padding: 12px; border-bottom: 1px solid var(--line); text-align: left; vertical-align: top; }
        th { background: #fef2f2; }
        form.inline { display: inline; }
        input, select, textarea { width: 100%; padding: 10px 12px; border-radius: 10px; border: 1px solid #cbd5e1; font: inherit; }
        label { display: block; margin-bottom: 12px; font-weight: 700; }
        textarea { min-height: 120px; resize: vertical; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .button { display: inline-block; background: var(--accent); color: white; border: none; border-radius: 10px; padding: 10px 16px; text-decoration: none; cursor: pointer; }
        .button.secondary { background: #57534e; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: var(--accent-soft); margin: 2px 6px 2px 0; }
        .thumb { width: 72px; height: 72px; object-fit: cover; border-radius: 10px; border: 1px solid var(--line); margin: 2px; }
        .thumbs { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px; }
        .thumbs img, .product-image { width: 100%; max-height: 180px; object-fit: cover; border-radius: 12px; border: 1px solid var(--line); margin-bottom: 12px; }
        .alert { padding: 14px 16px; border-radius: 12px; margin-bottom: 18px; }
        .alert.success { background: #dcfce7; }
        .alert.error { background: #fee2e2; }
        ul.errors { margin: 8px 0 0; padding-left: 18px; }
    </style>
</head>
<body>
    <nav>
        <div class="links">
            <span class="brand">Cafe Aroma</span>
            <a href="{{ route('inicio') }}">Inicio</a>
            <a href="{{ route('catalogo') }}">Catalogo</a>
            @auth
                @if(auth()->user()->esAdministrador())
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @endif
                <a href="{{ route('productos.index') }}">Productos</a>
                <a href="{{ route('categorias.index') }}">Categorias</a>
                <a href="{{ route('ventas.index') }}">Ventas</a>
                @if(auth()->user()->esAdministrador() || auth()->user()->esGerente())
                    <a href="{{ route('usuarios.index') }}">Usuarios</a>
                @endif
            @endauth
        </div>
        <div class="links">
            @auth
                <span>{{ auth()->user()->nombre_completo }} ({{ auth()->user()->rol }})</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit">Cerrar sesion</button>
                </form>
            @else
                <a href="{{ route('login') }}">Iniciar sesion</a>
            @endauth
        </div>
    </nav>

    <main>
        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert error">
                <strong>Hay errores de validacion.</strong>
                <ul class="errors">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>
