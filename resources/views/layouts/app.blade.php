<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ToMaBra</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#f7f5f2] text-gray-800">

<!-- NAV -->
<nav class="flex justify-between items-center px-16 py-6 bg-[#f7f5f2] border-b">

    <h1 class="text-2xl tracking-widest font-serif">
        ToMaBra
    </h1>

    <div class="flex gap-10 text-sm tracking-widest uppercase">

        <a href="/catalogo">Catálogo</a>
        <a href="/nosotros">Nosotros</a>
        <a href="/proceso">Proceso</a>
        <a href="/contacto">Contacto</a>

    </div>

    <div class="flex gap-3">

        @auth
            <form method="POST" action="/logout">
                @csrf
                <button class="bg-black text-white px-5 py-2 text-sm tracking-widest">
                    Salir
                </button>
            </form>
        @else
            <a href="/login" class="px-4 py-2 border text-sm">Login</a>
            <a href="/register" class="bg-black text-white px-5 py-2 text-sm">
                Registro
            </a>
        @endauth

    </div>

</nav>

<div>
    @yield('content')
</div>

</body>
</html>