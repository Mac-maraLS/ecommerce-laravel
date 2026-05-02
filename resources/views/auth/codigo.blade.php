@extends('layouts.app')

@section('content')

<style>
    .verify-wrapper {
        min-height: 88vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
    }

    .verify-card {
        max-width: 420px;
        width: 100%;
        background: #fff;
        padding: 3rem;
        border-radius: 28px;
        box-shadow: 0 25px 80px rgba(61,26,14,0.1);
        border: 1px solid rgba(232,221,213,0.5);
        text-align: center;
        animation: fadeInUp 0.6s var(--transition) both;
    }

    .verify-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--cafe-700), var(--cafe-500));
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 1.75rem;
        box-shadow: 0 12px 32px rgba(61,26,14,0.25);
        animation: float 4s ease-in-out infinite;
    }

    .verify-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--cafe-800);
        margin-bottom: 0.5rem;
    }

    .verify-desc {
        font-size: 0.85rem;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .code-input {
        width: 100%;
        text-align: center;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: 12px;
        padding: 1.1rem 1rem;
        border: 2px solid var(--border);
        border-radius: 16px;
        background: var(--cream);
        color: var(--cafe-800);
        outline: none;
        transition: all 0.3s ease;
        font-family: 'Inter', monospace;
    }

    .code-input:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 5px var(--accent-glow);
        background: #fff;
    }

    .code-input::placeholder {
        color: #d4c4b8;
        letter-spacing: 16px;
    }

    .verify-timer {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 1.5rem;
        font-size: 0.75rem;
        color: var(--text-muted);
        padding: 0.4rem 1rem;
        background: var(--cream);
        border-radius: 100px;
    }

    .timer-dot {
        width: 6px; height: 6px;
        background: var(--warning);
        border-radius: 50%;
        animation: pulse-soft 1.5s ease-in-out infinite;
    }
</style>

<div class="verify-wrapper">
    <div class="verify-card">

        <div class="verify-icon">🔐</div>

        <h1 class="verify-title">Verificación 2FA</h1>
        <p class="verify-desc">
            Ingresa el código de 6 dígitos que enviamos a tu correo electrónico para verificar tu identidad.
        </p>

        @if(session('error'))
            <div class="alert-error" style="margin-bottom:1.5rem; text-align:left;">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/verificar-codigo">
            @csrf

            <div style="margin-bottom:1.5rem;">
                <input type="text" name="codigo" placeholder="••••••" class="code-input" maxlength="6" autofocus>
            </div>

            <button class="btn-full">Verificar código →</button>

            <div class="verify-timer">
                <span class="timer-dot"></span>
                El código expira en 5 minutos
            </div>
        </form>

    </div>
</div>

@endsection