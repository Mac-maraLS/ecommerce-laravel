@extends('layouts.app')

@section('content')

<style>
    .contact-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.5rem;
    }

    .contact-card {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        max-width: 920px;
        width: 100%;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 25px 80px rgba(61,26,14,0.12);
        animation: fadeInUp 0.6s var(--transition) both;
    }

    .contact-info-panel {
        background: linear-gradient(160deg, var(--cafe-900), var(--cafe-600) 60%, var(--cafe-500));
        padding: 3.5rem;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .contact-info-orb {
        position: absolute;
        bottom: -20%;
        left: -15%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(200,149,108,0.15), transparent 65%);
        border-radius: 50%;
        animation: float 7s ease-in-out infinite;
    }

    .contact-info-content { position: relative; z-index: 2; }

    .contact-info-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .contact-bar {
        width: 40px; height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent-light));
        border-radius: 2px;
        margin: 1.25rem 0;
    }

    .contact-detail {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        transition: transform 0.2s ease;
    }

    .contact-detail:hover { transform: translateX(4px); }

    .contact-detail-icon {
        width: 42px;
        height: 42px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .contact-detail-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        opacity: 0.45;
        margin-bottom: 2px;
    }

    .contact-detail-value {
        font-size: 0.88rem;
        font-weight: 500;
    }

    .contact-form-panel {
        background: #fff;
        padding: 3.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .contact-form-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--cafe-800);
        margin-bottom: 0.25rem;
    }

    .field { margin-bottom: 1.25rem; }

    @media (max-width: 768px) {
        .contact-card { grid-template-columns: 1fr; }
        .contact-info-panel { padding: 2.5rem; }
    }
</style>

<div class="contact-wrapper">
    <div class="contact-card">

        <div class="contact-info-panel">
            <div class="contact-info-orb"></div>
            <div class="contact-info-content">
                <h2 class="contact-info-title">Hablemos ☕</h2>
                <div class="contact-bar"></div>
                <p style="font-size:0.85rem; opacity:0.6; line-height:1.7; margin-bottom:2.5rem;">¿Tienes alguna pregunta? Nos encantaría escucharte.</p>

                <div class="contact-detail">
                    <div class="contact-detail-icon">📍</div>
                    <div>
                        <p class="contact-detail-label">Dirección</p>
                        <p class="contact-detail-value">Chiapas, México</p>
                    </div>
                </div>
                <div class="contact-detail">
                    <div class="contact-detail-icon">📞</div>
                    <div>
                        <p class="contact-detail-label">Teléfono</p>
                        <p class="contact-detail-value">961-123-4567</p>
                    </div>
                </div>
                <div class="contact-detail">
                    <div class="contact-detail-icon">📧</div>
                    <div>
                        <p class="contact-detail-label">Email</p>
                        <p class="contact-detail-value">contacto@tomabra.com</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form-panel">
            <h3 class="contact-form-title">Envíanos un mensaje</h3>
            <p style="font-size:0.82rem; color:var(--text-muted); margin-bottom:2rem;">Responderemos en menos de 24 horas</p>

            <form action="#" method="POST">
                @csrf
                <div class="field">
                    <label class="label">Nombre</label>
                    <input type="text" name="name" placeholder="Tu nombre completo" class="input" required>
                </div>
                <div class="field">
                    <label class="label">Correo</label>
                    <input type="email" name="email" placeholder="correo@ejemplo.com" class="input" required>
                </div>
                <div class="field">
                    <label class="label">Mensaje</label>
                    <textarea name="message" rows="4" placeholder="Escribe tu mensaje..." class="textarea" required></textarea>
                </div>
                <button class="btn-full">Enviar mensaje →</button>
            </form>
        </div>

    </div>
</div>

@endsection