<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ecommerce</title>
    @vite('resources/css/app.css')
</head>

<body>

<nav class="navbar">
    <h1 class="text-xl font-bold">☕ ToMaBra</h1>

    <div class="nav-links space-x-4">
        <a href="/">Inicio</a>
        <a href="/catalogo">Catálogo</a>
        <a href="/nosotros">Nosotros</a>
        <a href="/contacto">Contacto</a>
    </div>

    <div class="space-x-2">
        @auth
            <a href="/products" class="btn btn-secondary">Panel</a>

            <form action="/logout" method="POST" class="inline">
                @csrf
                <button class="btn btn-primary">Salir</button>
            </form>
        @else
            <a href="/login" class="btn btn-secondary">Login</a>
            <a href="/register" class="btn btn-primary">Registro</a>
        @endauth
    </div>
</nav>

<div class="container mt-6">
    @yield('content')
</div>

</body>
</html>