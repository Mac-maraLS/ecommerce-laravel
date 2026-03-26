<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Café ToMaBra | Experiencia Artesanal</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e342e;
            --accent: #c6a664;
            --light: #fafafa;
            --dark: #212121;
            --white: #ffffff;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            scroll-behavior: smooth;
        }

        /* Navegación */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 10%;
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            margin-left: 2rem;
            font-weight: 400;
            transition: color 0.3s;
        }

        .nav-links a:hover { color: var(--accent); }

        .auth-buttons .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-login { color: var(--primary); margin-right: 1rem; }
        .btn-register { background: var(--primary); color: var(--white) !important; }

        /* Hero Section */
        .hero {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
            text-align: center;
            padding: 0 20px;
        }

        .hero h1 { font-family: 'Playfair Display', serif; font-size: 4rem; margin: 0; }
        .hero p { font-size: 1.2rem; max-width: 600px; margin: 1.5rem 0; }

        /* Características / Beneficios */
        .features {
            display: flex;
            justify-content: space-around;
            padding: 4rem 10%;
            background: var(--white);
            text-align: center;
        }

        .feature-item i { font-size: 2rem; color: var(--accent); display: block; margin-bottom: 1rem; }
        .feature-item h3 { font-size: 1.1rem; margin-bottom: 0.5rem; }
        .feature-item p { font-size: 0.9rem; color: #666; }

        /* Secciones Generales */
        .section { padding: 5rem 10%; }
        .section-title { text-align: center; font-family: 'Playfair Display'; font-size: 2.5rem; margin-bottom: 3rem; }

        /* Grid de Productos (Más vendidos) */
        .grid-catalogo {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
        }

        .product-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            border: 1px solid #eee;
            position: relative;
        }

        .badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent);
            color: white;
            padding: 5px 12px;
            font-size: 0.7rem;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .product-info { padding: 1.5rem; text-align: center; }
        .price { color: var(--primary); font-weight: 600; font-size: 1.3rem; display: block; margin: 0.5rem 0; }

        .btn-view-all {
            display: block;
            width: fit-content;
            margin: 3rem auto 0;
            padding: 1rem 2.5rem;
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-view-all:hover { background: var(--primary); color: white; }

        /* Footer */
        footer { background: #1a1a1a; color: #888; text-align: center; padding: 4rem 10%; }
        .footer-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 2rem; text-align: left; }
        .footer-grid h4 { color: white; margin-bottom: 1rem; }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">Café ToMaBra</a>
    <div class="nav-links">
        <a href="/">Inicio</a>
        <a href="/nosotros">Nosotros</a>
        <a href="/contacto">Contacto</a>
        <a href="/catalogo">Catalogo</a>
    </div>
    <div class="auth-buttons">
        @guest
            <a href="/login" class="btn btn-login">Iniciar Sesión</a>
            <a href="/register" class="btn btn-register">Registrarse</a>
        @endguest

        @auth
            <a href="/products" class="btn btn-register">Ir a la tienda</a>
        @endauth
    </div>
</nav>

<header class="hero" id="inicio">
    <h1>Calidad en cada gota</h1>
    <p>Descubre el sabor auténtico del café chiapaneco, seleccionado cuidadosamente desde la finca hasta tu mesa.</p>
    <a href="/nosotros" class="btn-register">Conócenos</a>
</header>

<section class="features">
    <div class="feature-item">
        <span>☕</span>
        <h3>Grano Orgánico</h3>
        <p>100% cultivado sin químicos.</p>
    </div>
    <div class="feature-item">
        <span>🚚</span>
        <h3>Envío Rápido</h3>
        <p>A todo México en 24/48 horas.</p>
    </div>
    <div class="feature-item">
        <span>💳</span>
        <h3>Pago Seguro</h3>
        <p>Tus datos están protegidos.</p>
    </div>
</section>

<main>
    <section class="section" id="favoritos">
        <h2 class="section-title">Los más vendidos</h2>
        <div class="grid-catalogo">
            <div class="product-card">
                <span class="badge">Popular</span>
                <div class="product-info">
                    <h3>Espresso de Altura</h3>
                    <p>Notas intensas de cacao y frutos rojos.</p>
                    <span class="price">$120.00 / 250g</span>
                    <button class="btn btn-register" style="border:none; cursor:pointer; width:100%">Añadir al carrito</button>
                </div>
            </div>
            <div class="product-card">
                <span class="badge">Sugerido</span>
                <div class="product-info">
                    <h3>Mezcla Especial ToMaBra</h3>
                    <p>Balance perfecto entre acidez y dulzor.</p>
                    <span class="price">$180.00 / 500g</span>
                    <button class="btn btn-register" style="border:none; cursor:pointer; width:100%">Añadir al carrito</button>
                </div>
            </div>
            <div class="product-card">
                <div class="product-info">
                    <h3>Caramel Macchiato</h3>
                    <p>Dulce, cremoso y con un toque de vainilla.</p>
                    <span class="price">$65.00</span>
                    <button class="btn btn-register" style="border:none; cursor:pointer; width:100%">Añadir al carrito</button>
                </div>
            </div>
        </div>
        
        <a href="/catalogo" class="btn-view-all">Ver catálogo completo</a>
    </section>

    <section class="section" id="nosotros" style="background: #fdfaf6;">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h2 class="section-title">Pasión por el Grano</h2>
            <p>En <strong>Café ToMaBra</strong>, no solo vendemos café; compartimos una herencia. Ubicados en el corazón de Chiapas, trabajamos directamente con productores locales para garantizar un comercio justo y la máxima calidad en tu taza.</p>
        </div>
    </section>
</main>

<footer id="contacto">
    <div class="footer-grid">
        <div>
            <h4>Café ToMaBra</h4>
            <p>Llevando la esencia de Chiapas a tu hogar.</p>
        </div>
        <div>
            <h4>Enlaces</h4>
            <p><a href="#" style="color:#888; text-decoration:none;">Términos y condiciones</a></p>
            <p><a href="#" style="color:#888; text-decoration:none;">Políticas de envío</a></p>
        </div>
        <div>
            <h4>Contacto</h4>
            <p>Tuxtla Gutiérrez, Chiapas</p>
            <p>ventas@tomabra.com</p>
        </div>
    </div>
    <hr style="border: 0; border-top: 1px solid #333; margin: 2rem 0;">
    <p>&copy; 2026 Café ToMaBra. Todos los derechos reservados.</p>
</footer>

</body>
</html>