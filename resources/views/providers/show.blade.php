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
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    .container {
        padding: 30px 15px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        padding: 0 15px;
    }

    .col-md-8 {
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
        padding: 0 15px;
    }

    .card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
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

    .card-header {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        color: var(--dark);
        font-weight: 600;
        font-size: 1.1rem;
        padding: 20px 25px;
        border-bottom: 1px solid rgba(45, 212, 191, 0.1);
        position: relative;
    }

    .card-body {
        padding: 25px;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .text-center {
        text-align: center;
    }

    .rounded-circle {
        border-radius: 50%;
        border: 4px solid;
        border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
        box-shadow: 0 8px 16px rgba(45, 212, 191, 0.2);
        transition: all 0.3s ease;
    }

    .rounded-circle:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 20px rgba(45, 212, 191, 0.3);
    }

    .card-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .text-muted {
        color: var(--gray) !important;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .rating {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        margin-bottom: 1rem;
        padding: 10px 15px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
        border-radius: 25px;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .rating .fas,
    .rating .far {
        color: var(--secondary);
        font-size: 1.1rem;
    }

    .rating .ms-1 {
        margin-left: 8px;
        color: var(--dark);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .card-text {
        color: var(--dark);
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .card-text strong {
        color: var(--primary);
    }

    .badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }

    .badge::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .bg-success {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%) !important;
        color: white;
    }

    .bg-success::before {
        background-color: rgba(255, 255, 255, 0.8);
    }

    .bg-danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%) !important;
        color: white;
    }

    .bg-danger::before {
        background-color: rgba(255, 255, 255, 0.8);
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        text-align: center;
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
    }

    .btn-outline-primary {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-outline-primary:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .d-grid {
        display: grid;
    }

    .gap-2 {
        gap: 12px;
    }

    .contact-info {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
    }

    .contact-info p {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        color: var(--dark);
        font-weight: 500;
    }

    .contact-info p:last-child {
        margin-bottom: 0;
    }

    .contact-info .fas {
        color: var(--primary);
        margin-right: 12px;
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .bio-section {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
        border-radius: 12px;
        padding: 25px;
        margin: 15px 0;
        border-left: 4px solid var(--primary);
    }

    .bio-section p {
        color: var(--dark);
        line-height: 1.7;
        margin-bottom: 15px;
        font-size: 1.05rem;
    }

    .bio-section p:last-child {
        margin-bottom: 0;
    }

    .bio-section strong {
        color: var(--primary);
        font-weight: 600;
    }

    .rating-item {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid rgba(45, 212, 191, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .rating-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, var(--primary), var(--secondary));
        border-radius: 0 2px 2px 0;
    }

    .rating-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
        border-color: rgba(45, 212, 191, 0.2);
    }

    .rating-item:last-child {
        margin-bottom: 0;
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

    .border-bottom {
        border-bottom: 1px solid rgba(45, 212, 191, 0.1) !important;
        padding-bottom: 20px !important;
    }

    .pb-4 {
        padding-bottom: 1.5rem;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .me-2 {
        margin-right: 0.5rem;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .rating-item strong {
        color: var(--dark);
        font-size: 1.1rem;
        font-weight: 600;
    }

    .rating-item .rating {
        margin-bottom: 10px;
        padding: 5px 10px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.08) 0%, rgba(245, 158, 11, 0.03) 100%);
        border-radius: 15px;
        border: none;
    }

    .rating-item small {
        color: var(--gray);
        font-size: 0.85rem;
        background: var(--gray-light);
        padding: 4px 8px;
        border-radius: 12px;
    }

    .rating-item p {
        color: var(--dark);
        line-height: 1.6;
        font-style: italic;
        margin-top: 10px;
        padding: 15px;
        background: rgba(45, 212, 191, 0.03);
        border-radius: 8px;
        border-left: 3px solid var(--primary);
    }

    .ratings-header {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        padding: 20px 25px;
        border-bottom: 1px solid rgba(45, 212, 191, 0.1);
    }

    .profile-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
        border-radius: 12px;
        border: 1px solid rgba(45, 212, 191, 0.1);
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
        display: block;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--gray);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .col-md-4, .col-md-8 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .container {
            padding: 20px 15px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .profile-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Animation classes */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 animate-fade-in">
                <div class="card-body text-center">
                    @if($profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $provider->name }}" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/150" alt="{{ $provider->name }}" class="rounded-circle mb-3">
                    @endif
                    <h3 class="card-title">{{ $provider->name }}</h3>
                    <p class="text-muted">{{ $profile->category->name ?? 'Non spécifié' }}</p>
                    
                    <div class="rating mb-3">
                        @php
                            $avgRating = $profile->averageRating();
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
                        <span class="ms-1">({{ number_format($avgRating, 1) }}) - {{ $ratings->total() }} avis</span>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ number_format($avgRating, 1) }}</span>
                            <span class="stat-label">Note moyenne</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $ratings->total() }}</span>
                            <span class="stat-label">Avis clients</span>
                        </div>
                    </div>
                    
                    <p class="card-text">
                        <strong>Disponibilité:</strong> 
                        @if($profile->is_available)
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-danger">Non disponible</span>
                        @endif
                    </p>
                    
                    @if(Auth::check() && Auth::user()->isClient())
                        <div class="d-grid gap-2">
                            <a href="{{ route('messages.create', $provider->id) }}" class="btn btn-primary">Contacter</a>
                            <a href="{{ route('ratings.create', $provider->id) }}" class="btn btn-outline-primary">Évaluer</a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card mb-4 animate-fade-in delay-100">
                <div class="card-header">Coordonnées</div>
                <div class="card-body">
                    <div class="contact-info">
                        @if($provider->phone)
                            <p><i class="fas fa-phone me-2"></i> {{ $provider->phone }}</p>
                        @endif
                        
                        @if($provider->address)
                            <p><i class="fas fa-map-marker-alt me-2"></i> {{ $provider->address }}</p>
                        @endif
                        
                        <p><i class="fas fa-envelope me-2"></i> {{ $provider->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card mb-4 animate-fade-in delay-200">
                <div class="card-header">À propos</div>
                <div class="card-body">
                    <div class="bio-section">
                        @if($profile->bio)
                            <p>{{ $profile->bio }}</p>
                        @else
                            <p class="text-muted">Aucune information disponible.</p>
                        @endif
                        
                        @if($profile->experience)
                            <p><strong>Expérience:</strong> {{ $profile->experience }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card animate-fade-in delay-300">
                <div class="card-header ratings-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Évaluations ({{ $ratings->total() }})</span>
                        <span class="text-muted">Page {{ $ratings->currentPage() }} sur {{ $ratings->lastPage() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($ratings->count() > 0)
                        @foreach($ratings as $index => $rating)
                            <div class="rating-item animate-fade-in" style="animation-delay: {{ 0.4 + ($index * 0.1) }}s">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong>{{ $rating->client->name }}</strong>
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $rating->created_at->format('d/m/Y') }}</small>
                                </div>
                                @if($rating->comment)
                                    <p class="mb-0">{{ $rating->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                        
                        <!-- Pagination pour les évaluations -->
                        <div class="mt-3 animate-fade-in delay-400">
                            {{ $ratings->links() }}
                        </div>
                    @else
                        <div class="bio-section">
                            <p class="text-muted">Aucune évaluation pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation des éléments au scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.rating-item').forEach(item => {
            observer.observe(item);
        });
    });
</script>
@endsection