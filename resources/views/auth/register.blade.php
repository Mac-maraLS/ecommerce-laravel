@extends('layouts.app')

@section('content')

<style>
    .register-wrapper {
        min-height: 88vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
    }

    .register-card {
        max-width: 480px;
        width: 100%;
        background: #fff;
        padding: 3rem;
        border-radius: 28px;
        box-shadow: 0 25px 80px rgba(61,26,14,0.1);
        border: 1px solid rgba(232,221,213,0.5);
        animation: fadeInUp 0.6s var(--transition) both;
        position: relative;
        overflow: hidden;
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--cafe-700), var(--accent), var(--accent-light));
        background-size: 200% 100%;
        animation: gradient-shift 4s ease infinite;
    }

    .register-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .register-icon-wrap {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--accent), var(--accent-light));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin: 0 auto 1.25rem;
        box-shadow: 0 8px 24px var(--accent-glow);
        animation: float 4s ease-in-out infinite;
    }

    .register-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--cafe-800);
        margin-bottom: 0.25rem;
    }

    .register-header p {
        font-size: 0.82rem;
        color: var(--text-muted);
    }

    .name-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .field { margin-bottom: 1.25rem; }
</style>

<div class="register-wrapper">
    <div class="register-card">

        <div class="register-header">
            <div class="register-icon-wrap">☕</div>
            <h2>Crear cuenta</h2>
            <p>Únete a la familia ToMaBra</p>
        </div>

        @if($errors->any())
            <div class="alert-error" style="margin-bottom:1.5rem;">
                @foreach($errors->all() as $e) <p>{{ $e }}</p> @endforeach
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <div class="name-grid">
                <div class="field">
                    <label class="label">Nombre</label>
                    <input name="nombre" placeholder="Juan" class="input">
                </div>
                <div class="field">
                    <label class="label">Apellidos</label>
                    <input name="apellidos" placeholder="Pérez" class="input">
                </div>
            </div>

            <div class="field">
                <label class="label">Correo electrónico</label>
                <input name="correo" placeholder="correo@ejemplo.com" class="input">
            </div>

            <div class="field">
                <label class="label">Contraseña</label>
                <input type="password" name="clave" placeholder="Mínimo 8 caracteres" class="input">
            </div>

            <button class="btn-full" style="margin-top:0.25rem;">Crear mi cuenta →</button>

            <p style="text-align:center; margin-top:1.75rem; font-size:0.8rem; color:var(--text-muted);">
                ¿Ya tienes cuenta?
                <a href="/login" style="color:var(--cafe-700); font-weight:700; text-decoration:none; border-bottom:1.5px solid var(--accent-light);">Inicia sesión</a>
            </p>
        </form>

    </div>
</div>

@endsection