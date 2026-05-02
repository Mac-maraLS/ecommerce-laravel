@extends('layouts.app')

@section('content')

<style>
    .login-wrapper {
        min-height: 88vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
    }

    .login-card {
        display: grid;
        grid-template-columns: 1fr 1.1fr;
        max-width: 880px;
        width: 100%;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 25px 80px rgba(61,26,14,0.12);
        animation: fadeInUp 0.6s var(--transition) both;
    }

    .login-brand {
        background: linear-gradient(160deg, var(--cafe-900), var(--cafe-600) 60%, var(--cafe-500));
        padding: 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .login-brand-orb {
        position: absolute;
        top: -25%;
        right: -25%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(200,149,108,0.2), transparent 65%);
        border-radius: 50%;
        animation: float 7s ease-in-out infinite;
    }

    .login-brand-orb-2 {
        position: absolute;
        bottom: -15%;
        left: -10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(200,149,108,0.1), transparent 70%);
        border-radius: 50%;
        animation: float 5s ease-in-out infinite reverse;
    }

    .login-brand-content {
        position: relative;
        z-index: 2;
    }

    .login-brand-icon {
        font-size: 3rem;
        display: block;
        margin-bottom: 2rem;
        animation: float 4s ease-in-out infinite;
    }

    .login-brand h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .login-brand-bar {
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent-light));
        border-radius: 2px;
        margin: 1.25rem 0;
    }

    .login-brand p {
        font-size: 0.88rem;
        opacity: 0.65;
        line-height: 1.75;
    }

    .login-form-panel {
        background: #fff;
        padding: 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form-panel h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--cafe-800);
        margin-bottom: 0.25rem;
    }

    .login-form-panel .subtitle {
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .login-field {
        margin-bottom: 1.25rem;
        position: relative;
    }

    .login-field-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 0.85rem;
        font-size: 0.85rem;
        opacity: 0.35;
        pointer-events: none;
    }

    .login-field .input {
        padding-left: 2.5rem;
    }

    .login-separator {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 1.5rem 0;
        color: var(--text-muted);
        font-size: 0.7rem;
    }

    .login-separator::before,
    .login-separator::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    @media (max-width: 768px) {
        .login-card { grid-template-columns: 1fr; }
        .login-brand { display: none; }
    }
</style>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-brand">
            <div class="login-brand-orb"></div>
            <div class="login-brand-orb-2"></div>
            <div class="login-brand-content">
                <span class="login-brand-icon">☕</span>
                <h2>Bienvenido de vuelta</h2>
                <div class="login-brand-bar"></div>
                <p>Inicia sesión para acceder a tu cuenta y disfrutar del mejor café artesanal chiapaneco.</p>
            </div>
        </div>

        <div class="login-form-panel">
            <h3>Iniciar Sesión</h3>
            <p class="subtitle">Ingresa tus credenciales para continuar</p>

            @if($errors->any())
                <div class="alert-error" style="margin-bottom:1.25rem;">
                    @foreach($errors->all() as $e)
                        <p>{{ $e }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="login-field">
                    <label class="label">Correo electrónico</label>
                    <div style="position:relative;">
                        <span class="login-field-icon">✉️</span>
                        <input name="correo" placeholder="correo@ejemplo.com" class="input" style="padding-left:2.5rem;">
                    </div>
                </div>

                <div class="login-field">
                    <label class="label">Contraseña</label>
                    <div style="position:relative;">
                        <span class="login-field-icon">🔒</span>
                        <input type="password" name="clave" placeholder="••••••••" class="input" style="padding-left:2.5rem;">
                    </div>
                </div>

                <button class="btn-full" style="margin-top:0.5rem;">Entrar →</button>

                <p style="text-align:center; margin-top:1.75rem; font-size:0.8rem; color:var(--text-muted);">
                    ¿No tienes cuenta?
                    <a href="/register" style="color:var(--cafe-700); font-weight:700; text-decoration:none; border-bottom:1.5px solid var(--accent-light);">Regístrate aquí</a>
                </p>
            </form>
        </div>

    </div>
</div>

@endsection