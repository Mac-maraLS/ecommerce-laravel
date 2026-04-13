<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo | Café ToMaBra</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f5f5f5;
        }

        nav {
            display: flex;
            justify-content: space-between;
            padding: 15px 10%;
            background: white;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 10px;
        }

        .price {
            color: green;
            font-weight: bold;
        }

        img {
            width: 100%;
        }
    </style>
</head>

<body>

<nav>
    <a href="/">Inicio</a>

    <div>
        <a href="/nosotros">Nosotros</a>
        <a href="/contacto">Contacto</a>
    </div>
</nav>

<h1 style="text-align:center;">🛒 Catálogo</h1>

<div class="grid">

@foreach($products as $product)
    <div class="card">

        @if($product->imagen)
            <img src="{{ asset('storage/' . $product->imagen) }}">
        @endif

        <h3>{{ $product->nombre }}</h3>
        <p>{{ $product->descripcion }}</p>
        <p class="price">$ {{ $product->precio }}</p>

    </div>
@endforeach

</div>

</body>
</html>