@extends('layouts.app')

@section('content')
<style>
:root {
    --primary: #2dd4bf;
    --primary-hover: #14b8a6;
    --secondary: #f59e0b;
    --dark: #0f172a;
    --light: #f8fafc;
    --gray: #64748b;
    --gray-light: #f1f5f9;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --info: #3b82f6;
    --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

.container {
    padding: 40px 15px;
    max-width: 1200px;
}

.page-header {
    background: white;
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: var(--shadow-sm);
    border: 1px solid rgba(45, 212, 191, 0.1);
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
}

.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.mb-3 {
    margin-bottom: 1rem;
}

.ms-3 {
    margin-left: 1rem;
}

.ms-1 {
    margin-left: 0.25rem;
}

.mt-3 {
    margin-top: 1rem;
}

h1 {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0;
    display: flex;
    align-items: center;
}

h1::before {
    content: '🎯';
    margin-right: 15px;
    font-size: 2rem;
}

h2 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

h2::before {
    content: '👥';
    margin-right: 12px;
    font-size: 1.5rem;
}

.lead {
    font-size: 1.2rem;
    color: var(--gray);
    line-height: 1.6;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    padding: 20px;
    border-radius: 12px;
    border-left: 4px solid var(--primary);
    margin-bottom: 30px;
}

.btn {
    padding: 12px 24px;
    font-size: 0.95rem;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-outline-secondary {
    background: transparent;
    color: var(--gray);
    border: 2px solid #e2e8f0;
}

.btn-outline-secondary:hover {
    background: var(--gray-light);
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
    color: white;
    box-shadow: 0 4px 6px rgba(45, 212, 191, 0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 10px rgba(45, 212, 191, 0.3);
    color: white;
    text-decoration: none;
}

.btn-outline-primary {
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-outline-primary:hover {
    background: rgba(45, 212, 191, 0.1);
    color: var(--primary-hover);
    transform: translateY(-2px);
    text-decoration: none;
}

.row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
    margin: 0;
}

.col-md-4 {
    padding: 0;
}

.card {
    background: white;
    border-radius: 20px;
    padding: 0;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(45, 212, 191, 0.1);
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
    height: 100%;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
}

.card::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
    transition: left 0.5s ease;
    z-index: 1;
}

.card:hover::after {
    left: 0;
}

.card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: var(--shadow-lg);
    border-color: rgba(45, 212, 191, 0.3);
}

.h-100 {
    height: 100%;
}

.card-body {
    padding: 25px;
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.flex-shrink-0 {
    flex-shrink: 0;
}

.rounded-circle {
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(45, 212, 191, 0.2);
    transition: all 0.3s ease;
}

.rounded-circle:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(45, 212, 191, 0.3);
}

.card-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 8px;
}

.rating {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.rating i {
    color: #fbbf24;
    margin-right: 2px;
    font-size: 0.9rem;
}

.rating .fas {
    color: #f59e0b;
}

.rating .far {
    color: #d1d5db;
}

.text-muted {
    color: var(--gray) !important;
    font-size: 0.85rem;
}

.card-text {
    color: var(--gray);
    line-height: 1.5;
    margin-bottom: 12px;
    font-size: 0.95rem;
}

.card-text strong {
    color: var(--dark);
    font-weight: 600;
}

.text-success {
    color: var(--success) !important;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.text-success::before {
    content: '✅';
    margin-right: 5px;
    font-size: 0.8rem;
}

.text-danger {
    color: var(--danger) !important;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.text-danger::before {
    content: '❌';
    margin-right: 5px;
    font-size: 0.8rem;
}

.provider-actions {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid rgba(45, 212, 191, 0.1);
}

.alert {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 12px;
    padding: 20px;
    color: var(--info);
    border-left: 4px solid var(--info);
    display: flex;
    align-items: center;
}

.alert::before {
    content: 'ℹ️';
    margin-right: 10px;
    font-size: 1.2rem;
}

.alert-info {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    border-color: rgba(59, 130, 246, 0.2);
    color: var(--info);
}

.provider-stats {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid rgba(45, 212, 191, 0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    text-align: center;
}

.stat-item {
    padding: 8px;
}

.stat-number {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--primary);
    display: block;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 500;
}

@media (max-width: 768px) {
    .container {
        padding: 30px 15px;
    }

    h1 {
        font-size: 2rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    .row {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }

    .page-header {
        padding: 20px;
    }

    .lead {
        font-size: 1.1rem;
        padding: 15px;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.page-header {
    animation: slideInLeft 0.6s ease-out forwards;
}

.card {
    animation: fadeInUp 0.6s ease-out forwards;
}

.card:nth-child(1) { animation-delay: 0.1s; }
.card:nth-child(2) { animation-delay: 0.2s; }
.card:nth-child(3) { animation-delay: 0.3s; }
.card:nth-child(4) { animation-delay: 0.4s; }
.card:nth-child(5) { animation-delay: 0.5s; }
.card:nth-child(6) { animation-delay: 0.6s; }

.alert {
    animation: fadeInUp 0.6s ease-out forwards;
}
</style>

<div class="container">
    <!-- En-tête de page -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $category->name }}</h1>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour aux catégories
            </a>
        </div>
        
        <p class="lead">{{ $category->description }}</p>
    </div>
    
    <h2 class="mb-3">Prestataires disponibles</h2>
    
    @if($providers->count() > 0)
        <div class="row">
            @foreach($providers as $provider)
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <!-- Profil du prestataire -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    @if($provider->photo)
                                        <img src="{{ asset('storage/' . $provider->photo) }}" 
                                             alt="{{ $provider->user->name }}" 
                                             class="rounded-circle" 
                                             width="60" height="60">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--gray) 0%, var(--gray-light) 100%);">
                                            <i class="fas fa-user" style="color: white; font-size: 1.5rem;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title mb-0">{{ $provider->user->name }}</h5>
                                    <div class="rating">
                                        @php
                                            $avgRating = $provider->averageRating();
                                            $fullStars = floor($avgRating);
                                            $halfStar = $avgRating - $fullStars >= 0.5;
                                        @endphp
                                        
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $fullStars)
                                                <i class="fas fa-star"></i>
                                            @elseif($i == $fullStars + 1 && $halfStar)
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span class="ms-1 text-muted">({{ $provider->ratings->count() }})</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistiques du prestataire -->
                            <div class="provider-stats">
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <span class="stat-number">{{ number_format($avgRating, 1) }}</span>
                                        <span class="stat-label">Note</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $provider->ratings->count() }}</span>
                                        <span class="stat-label">Avis</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">{{ rand(10, 100) }}</span>
                                        <span class="stat-label">Projets</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Informations du prestataire -->
                            <p class="card-text">
                                <strong><i class="fas fa-clock me-2" style="color: var(--primary);"></i>Disponibilité:</strong> 
                                @if($provider->is_available)
                                    <span class="text-success">Disponible</span>
                                @else
                                    <span class="text-danger">Non disponible</span>
                                @endif
                            </p>
                            
                            <p class="card-text">
                                <strong><i class="fas fa-briefcase me-2" style="color: var(--secondary);"></i>Expérience:</strong> 
                                {{ $provider->experience ?? 'Non spécifié' }}
                            </p>

                            @if($provider->bio)
                                <p class="card-text">
                                    <strong><i class="fas fa-info-circle me-2" style="color: var(--info);"></i>À propos:</strong>
                                    {{ \Illuminate\Support\Str::limit($provider->bio, 80) }}
                                </p>
                            @endif
                            
                            <!-- Actions -->
                            <div class="provider-actions">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('providers.show', $provider->user->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-2"></i>Voir profil
                                    </a>
                                    <a href="{{ route('messages.create', $provider->user->id) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-envelope me-2"></i>Contacter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            Aucun prestataire disponible dans cette catégorie pour le moment.
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au scroll
    const cards = document.querySelectorAll('.card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        observer.observe(card);
    });

    // Effet de parallaxe léger
    document.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        cards.forEach((card, index) => {
            const speed = (index % 3 + 1) * 0.3;
            const x = (mouseX - 0.5) * speed;
            const y = (mouseY - 0.5) * speed;
            
            card.style.transform = `translate(${x}px, ${y}px)`;
        });
    });

    // Animation des étoiles au survol
    const ratings = document.querySelectorAll('.rating');
    ratings.forEach(rating => {
        const stars = rating.querySelectorAll('i');
        
        rating.addEventListener('mouseenter', () => {
            stars.forEach((star, index) => {
                setTimeout(() => {
                    star.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        star.style.transform = 'scale(1)';
                    }, 100);
                }, index * 50);
            });
        });
    });
});
</script>
@endsection