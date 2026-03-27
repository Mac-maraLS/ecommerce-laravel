<nav id="main-nav">
    <style>
        #main-nav {
            background: #fff;
            border-bottom: 1px solid #E8DDD5;
            font-family: Arial, sans-serif;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
        }
        .nav-logo {
            font-size: 18px;
            font-weight: 800;
            color: #3D1A0E;
            text-decoration: none;
            letter-spacing: -.02em;
        }
        .nav-logo span { color: #8B4513; }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-link {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #3D1A0E;
            text-decoration: none;
            transition: background .15s;
        }
        .nav-link:hover { background: #F5F0EB; }
        .nav-link.active { background: #F5F0EB; font-weight: 600; }

        /* Cart button */
        .nav-cart {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #3D1A0E;
            text-decoration: none;
            background: #F5F0EB;
            border: 1px solid #E8DDD5;
            transition: background .15s;
        }
        .nav-cart:hover { background: #EDE6DF; }
        .cart-badge {
            background: #3D1A0E;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Profile dropdown */
        .nav-right { display: flex; align-items: center; gap: 10px; }
        .profile-wrap { position: relative; }
        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border: 1px solid #E8DDD5;
            border-radius: 8px;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #3D1A0E;
            transition: background .15s;
        }
        .profile-btn:hover { background: #F5F0EB; }
        .profile-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: #3D1A0E;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .profile-name { max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .profile-chevron { font-size: 10px; color: #8B7355; transition: transform .2s; }
        .profile-wrap.open .profile-chevron { transform: rotate(180deg); }

        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0; top: calc(100% + 6px);
            background: #fff;
            border: 1px solid #E8DDD5;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(61,26,14,.12);
            min-width: 210px;
            overflow: hidden;
            z-index: 200;
        }
        .profile-wrap.open .profile-dropdown { display: block; }

        .dropdown-header {
            padding: 14px 16px;
            border-bottom: 1px solid #F5F0EB;
            background: #faf7f4;
        }
        .dropdown-header .d-name { font-size: 14px; font-weight: 700; color: #2C1810; }
        .dropdown-header .d-email { font-size: 12px; color: #8B7355; margin-top: 2px; }
        .dropdown-header .d-role {
            display: inline-block;
            margin-top: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 2px 8px;
            border-radius: 20px;
            background: #3D1A0E;
            color: #fff;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            font-size: 14px;
            color: #2C1810;
            text-decoration: none;
            transition: background .12s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .dropdown-item:hover { background: #f5f0eb; }
        .dropdown-item.danger { color: #b91c1c; }
        .dropdown-item.danger:hover { background: #fee2e2; }
        .dropdown-sep { height: 1px; background: #F5F0EB; margin: 4px 0; }

        /* Mobile hamburger */
        .hamburger { display: none; flex-direction: column; gap: 4px; cursor: pointer; padding: 8px; border: none; background: none; border-radius: 8px; }
        .hamburger span { width: 22px; height: 2px; background: #3D1A0E; border-radius: 2px; display: block; transition: all .2s; }
        .mobile-menu { display: none; border-top: 1px solid #E8DDD5; padding: 12px 24px 16px; background: #fff; }
        .mobile-menu.open { display: block; }
        .mobile-link { display: block; padding: 10px 12px; border-radius: 8px; font-size: 14px; color: #2C1810; text-decoration: none; font-weight: 500; transition: background .12s; margin-bottom: 2px; }
        .mobile-link:hover { background: #F5F0EB; }
        .mobile-sep { height: 1px; background: #E8DDD5; margin: 8px 0; }
        @media(max-width: 640px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
        }
    </style>

    <div class="nav-inner">
        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="nav-logo">Café <span>ToMaBra</span></a>

        {{-- Desktop links --}}
        <div class="nav-links">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Panel Admin</a>
            @elseif(Auth::user()->isEmpleado())
                <a href="{{ route('empleado.dashboard') }}" class="nav-link {{ request()->routeIs('empleado.dashboard') ? 'active' : '' }}">Panel Empleado</a>
            @else
                <a href="{{ route('cliente.dashboard') }}" class="nav-link {{ request()->routeIs('cliente.dashboard') ? 'active' : '' }}">Mi Panel</a>
            @endif
        </div>

        <div class="nav-right">
            {{-- Carrito (solo clientes) --}}
            @if(!Auth::user()->isAdmin() && !Auth::user()->isEmpleado())
                <a href="{{ route('carrito.ver') }}" class="nav-cart">
                    🛒 Carrito
                    <span class="cart-badge">0</span>
                </a>
            @endif

            {{-- Profile dropdown --}}
            <div class="profile-wrap" id="profileWrap">
                <button class="profile-btn" onclick="toggleProfile()">
                    <span class="profile-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                    <span class="profile-name">{{ Auth::user()->name }}</span>
                    <span class="profile-chevron">▼</span>
                </button>
                <div class="profile-dropdown">
                    <div class="dropdown-header">
                        <div class="d-name">{{ Auth::user()->name }}</div>
                        <div class="d-email">{{ Auth::user()->email }}</div>
                        <span class="d-role">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item danger">
                            🚪 Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

            {{-- Mobile hamburger --}}
            <button class="hamburger" onclick="toggleMobile()" aria-label="Menú">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div class="mobile-menu" id="mobileMenu">
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="mobile-link">Panel Admin</a>
        @elseif(Auth::user()->isEmpleado())
            <a href="{{ route('empleado.dashboard') }}" class="mobile-link">Panel Empleado</a>
        @else
            <a href="{{ route('cliente.dashboard') }}" class="mobile-link">☕ Mi Panel</a>
            <a href="{{ route('carrito.ver') }}" class="mobile-link">🛒 Ver Carrito</a>
        @endif
        <div class="mobile-sep"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mobile-link" style="border:none; width:100%; text-align:left; cursor:pointer; color:#b91c1c;">🚪 Cerrar sesión</button>
        </form>
    </div>

    <script>
        function toggleProfile() {
            document.getElementById('profileWrap').classList.toggle('open');
        }
        function toggleMobile() {
            document.getElementById('mobileMenu').classList.toggle('open');
        }
        // Cerrar dropdown al hacer click fuera
        document.addEventListener('click', function(e) {
            const wrap = document.getElementById('profileWrap');
            if (wrap && !wrap.contains(e.target)) {
                wrap.classList.remove('open');
            }
        });
    </script>
</nav>
