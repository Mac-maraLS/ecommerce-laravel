@extends('layouts.guest')

@section('content')
    <h1>Login manual</h1>
    <p>Usa correo y clave del usuario cargado por seeders.</p>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <label>
            Correo
            <input type="email" name="correo" value="{{ old('correo') }}" required>
        </label>

        <label>
            Clave
            <input type="password" name="clave" required>
        </label>

        <button type="submit">Entrar</button>
    </form>

    <p class="hint">Admin: admin@tuxtla.tecnm.mx / 123</p>
    <p class="hint">Gerente: gerente@tuxtla.tecnm.mx / 123</p>
@endsection
