@extends('layouts.app')

@section('content')

<style>
    .hero-section {
        min-height: 88vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .hero-orb-1 {
        position: absolute;
        top: -15%;
        right: -8%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, var(--accent-glow), transparent 65%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
        pointer-events: none;
    }

    .hero-orb-2 {
        position: absolute;
        bottom: -10%;
        left: -6%;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(61,26,14,0.05), transparent 65%);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite reverse;
        pointer-events: none;
    }

    .hero-orb-3 {
        position: absolute;
        top: 30%;
        left: 10%;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(200,149,108,0.15), transparent 70%);
        border-radius: 50%;
        animation: float 5s ease-in-out infinite 1s;
        pointer-events: none;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        background: rgba(200,149,108,0.08);
        border: 1px solid rgba(200,149,108,0.2);
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 2rem;
        animation: fadeInUp 0.6s var(--transition) both;
    }

    .hero-badge-dot {
        width: 6px;
        height: 6px;
        background: var(--accent);
        border-radius: 50%;
        animation: pulse-soft 2s ease-in-out infinite;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3rem, 7vw, 5.5rem);
        font-weight: 900;
        line-height: 1.05;
        color: var(--cafe-800);
        margin-bottom: 1.75rem;
        letter-spacing: -0.03em;
        animation: fadeInUp 0.6s var(--transition) 0.1s both;
    }

    .hero-title span {
        background: linear-gradient(135deg, var(--accent), #b07d56);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-style: italic;
    }

    .hero-desc {
        max-width: 460px;
        color: var(--text-muted);
        font-size: 1.05rem;
        line-height: 1.85;
        margin-bottom: 3rem;
        animation: fadeInUp 0.6s var(--transition) 0.2s both;
    }

    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, var(--cafe-700), var(--cafe-500));
        color: #fff;
        padding: 1rem 2.5rem;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        text-decoration: none;
        border-radius: 16px;
        box-shadow: 0 6px 28px rgba(61,26,14,0.3);
        transition: all 0.35s var(--transition);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s var(--transition) 0.3s both;
    }

    .hero-cta::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent);
        transition: left 0.6s ease;
    }

    .hero-cta:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px rgba(61,26,14,0.4);
    }

    .hero-cta:hover::before { left: 100%; }

    .hero-cta-arrow {
        transition: transform 0.3s ease;
    }

    .hero-cta:hover .hero-cta-arrow {
        transform: translateX(4px);
    }

    .hero-scroll-hint {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.7rem;
        color: var(--text-muted);
        opacity: 0.5;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        animation: fadeInUp 0.6s var(--transition) 0.6s both;
    }

    .scroll-line {
        width: 1px;
        height: 24px;
        background: linear-gradient(180deg, var(--text-muted), transparent);
        animation: pulse-soft 2s ease-in-out infinite;
    }
</style>

<section class="hero-section">
    <div class="hero-orb-1"></div>
    <div class="hero-orb-2"></div>
    <div class="hero-orb-3"></div>

    <div class="hero-badge">
        <span class="hero-badge-dot"></span>
        CHIAPAS, MÉXICO
    </div>

    <h1 class="hero-title">
        Café que <br>
        nace de <span>la tierra</span>
    </h1>

    <p class="hero-desc">
        Cultivado en las alturas de Chiapas, tostado a mano,
        con respeto por la tradición y el origen.
    </p>

    <a href="/catalogo" class="hero-cta">
        EXPLORAR CATÁLOGO
        <span class="hero-cta-arrow">→</span>
    </a>

    <div class="hero-scroll-hint">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>

@endsection