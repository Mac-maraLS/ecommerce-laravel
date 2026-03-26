<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto | Café ToMaBra</title>

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

        .container {
            padding: 50px 10%;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
        }

        button {
            background: #4e342e;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            cursor: pointer;
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

<div class="container">

    <div class="card">
        <h2>📩 Contáctanos</h2>

        <form action="#" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>

            <textarea name="message" rows="5" placeholder="Escribe tu mensaje..." required></textarea>

            <button type="submit">Enviar mensaje</button>
        </form>
    </div>

</div>

</body>
</html>