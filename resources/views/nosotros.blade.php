@extends('layouts.app')

@section('content')

<style>
    .about-section {
        max-width: 780px;
        margin: 0 auto;
        padding: 4rem 2rem;
    }

    .about-header {
        text-align: center;
        margin-bottom: 3.5rem;
        animation: fadeInUp 0.5s var(--transition) both;
    }

    .about-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        background: rgba(200,149,108,0.08);
        border: 1px solid rgba(200,149,108,0.2);
        border-radius: 100px;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 1rem;
    }

    .about-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: var(--cafe-800);
        letter-spacing: -0.03em;
    }

    .story-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 3rem;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.5s var(--transition) 0.1s both;
    }

    .story-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--accent), var(--accent-light), transparent);
        border-radius: 4px 0 0 4px;
    }

    .story-text {
        color: var(--text-muted);
        line-height: 2;
        font-size: 1.05rem;
        margin-bottom: 2.5rem;
    }

    .story-text::first-letter {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        float: left;
        margin-right: 0.5rem;
        margin-top: 0.1rem;
        line-height: 1;
        color: var(--cafe-700);
        font-weight: 700;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        padding-top: 2.5rem;
        border-top: 1px solid var(--border);
    }

    .value-item {
        text-align: center;
        animation: fadeInUp 0.5s var(--transition) both;
    }

    .value-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--cream), var(--cream-dark));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 0.75rem;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .value-item:hover .value-icon {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(61,26,14,0.08);
    }

    .value-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--text-muted);
    }
</style>

<div class="about-section">
    <div class="about-header">
        <span class="about-badge">🌱 Desde 2020</span>
        <h1 class="about-title">Nuestra Historia</h1>
        <div class="accent-bar" style="margin:1rem auto 0;"></div>
    </div>

    <div class="story-card">
        <p class="story-text">
            ToMaBra nace en las montañas de Chiapas, donde cada grano es cultivado con dedicación.
            Trabajamos con productores locales para ofrecer café auténtico y de calidad. Cada taza
            cuenta la historia de nuestras tierras, de la pasión que ponemos en cada cosecha y del
            amor por la tradición cafetera mexicana.
        </p>

        <div class="values-grid">
            <div class="value-item" style="animation-delay:0.2s;">
                <div class="value-icon">🌱</div>
                <p class="value-label">Orgánico</p>
            </div>
            <div class="value-item" style="animation-delay:0.3s;">
                <div class="value-icon">🤝</div>
                <p class="value-label">Comercio Justo</p>
            </div>
            <div class="value-item" style="animation-delay:0.4s;">
                <div class="value-icon">📍</div>
                <p class="value-label">Chiapas, MX</p>
            </div>
        </div>
    </div>
</div>

@endsection