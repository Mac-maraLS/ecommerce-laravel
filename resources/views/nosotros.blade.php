<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nosotros | Café ToMaBra</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #fafafa;
        }

        nav {
            display: flex;
            justify-content: space-between;
            padding: 15px 10%;
            background: white;
        }

        .btn {
            background: #4e342e;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
        }

        .hero {
            height: 50vh;
            background: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93');
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .container {
            padding: 50px 10%;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<nav>
    <a href="/">Inicio</a>

    <div>
        @guest
            <a href="/login" class="btn">Login</a>
            <a href="/register" class="btn">Registro</a>
        @endguest

        @auth
            <a href="/products" class="btn">Tienda</a>
        @endauth
    </div>
</nav>

<div class="hero">
    <h1>Sobre Nosotros</h1>
</div>

<div class="container">

    <div class="card">
        <h2>☕ Nuestra Historia</h2>
        <p>
            Café ToMaBra nace en Chiapas con la misión de llevar café de alta calidad
            directamente del productor al consumidor.
        </p>
    </div>

    <div class="card">
        <h2>🌱 Nuestra Misión</h2>
        <p>
            Ofrecer café orgánico, apoyar a productores locales y brindar
            una experiencia única a nuestros clientes.
        </p>
    </div>

    <div class="card">
        <h2>📍 Ubicación</h2>
        <p>
            Tuxtla Gutiérrez, Chiapas, México
        </p>
    </div>

</div>

</body>
</html>