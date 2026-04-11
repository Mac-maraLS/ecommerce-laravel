@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="/login">
    @csrf

    <input type="text" name="correo" placeholder="Correo"><br>
    <input type="password" name="clave" placeholder="Contraseña"><br>

    <button type="submit">Login</button>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
</form>