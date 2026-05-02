<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<nav class="bg-black text-white px-10 py-4 flex gap-6">

    <a href="/dashboard">Dashboard</a>
    <a href="/products">Productos</a>
    <a href="/categorias">Categorías</a>

    <form method="POST" action="/logout" class="ml-auto">
        @csrf
        <button>Salir</button>
    </form>

</nav>

<div class="p-10">
    @yield('content')
</div>

</body>
</html>