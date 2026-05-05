@extends('layouts.guest')

@section('content')
    <section class="card">
        <h1>Verificacion 2FA</h1>
        <p>Ingresa el codigo numerico enviado a tu correo. El codigo expira en 5 minutos.</p>

        <form method="POST" action="{{ route('login.2fa.validar') }}">
            @csrf
            <label>
                Codigo
                <input type="text" name="codigo" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" required autofocus>
            </label>

            <div class="actions">
                <button class="button" type="submit">Validar codigo</button>
                <a class="button secondary" href="{{ route('login') }}">Cancelar</a>
            </div>
        </form>
    </section>
@endsection
