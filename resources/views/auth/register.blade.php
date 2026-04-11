<h2>Registro</h2>

<form method="POST" action="/register">
    @csrf

    <input type="text" name="nombre" placeholder="Nombre"><br>
    <input type="text" name="apellidos" placeholder="Apellidos"><br>
    <input type="text" name="correo" placeholder="Correo"><br>
    <input type="password" name="clave" placeholder="Contraseña"><br>

    <button type="submit">Registrarse</button>

    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <p style="color:red">{{ $error }}</p>
            @endforeach
        </div>
    @endif
</form>