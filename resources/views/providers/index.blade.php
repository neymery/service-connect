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

    h1 {
        color: var(--dark);
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-left: 20px;
    }

    h1::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 5px;
        background: linear-gradient(to bottom, var(--primary), var(--secondary));
        border-radius: 3px;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
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
        transform: translateY(-3px);
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

    .filter-card {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
        border-left: 4px solid var(--primary);
    }

    .filter-card::before {
        display: none;
    }

    .card-body {
        padding: 25px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .g-3 {
        gap: 1rem;
    }

    .col-md-3, .col-md-4 {
        padding: 0 15px;
    }

    .col-md-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        margin-bottom: 30px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: white;
        color: var(--dark);
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
        transform: translateY(-1px);
    }

    .btn {
        display: inline-block;
        padding: 12px 20px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 8px;
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
    }

    .d-flex {
        display: flex;
    }

    .align-items-end {
        align-items: flex-end;
    }

    .align-items-center {
        align-items: center;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .justify-content-center {
        justify-content: center;
    }

    .me-2 {
        margin-right: 0.5rem;
    }

    .ms-1 {
        margin-left: 0.25rem;
    }

    .ms-3 {
        margin-left: 1rem;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .text-muted {
        color: var(--gray) !important;
    }

    .h-100 {
        height: 100%;
    }

    .flex-shrink-0 {
        flex-shrink: 0;
    }

    .rounded-circle {
        border-radius: 50%;
        border: 3px solid;
        border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
        box-shadow: 0 4px 8px rgba(45, 212, 191, 0.2);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 2px;
    }

    .rating .fas,
    .rating .far {
        color: var(--secondary);
        font-size: 0.9rem;
    }

    .card-text {
        color: var(--dark);
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .card-text strong {
        color: var(--primary);
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .bg-success {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%) !important;
        color: white;
    }

    .bg-danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%) !important;
        color: white;
    }

    .alert {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 12px;
        padding: 25px;
        border-left: 4px solid var(--info);
    }

    .alert h4 {
        color: var(--info);
        font-weight: 600;
        margin-bottom: 10px;
    }

    .alert p {
        color: var(--dark);
        margin-bottom: 0;
    }

    .stats-section {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        border: 1px solid rgba(45, 212, 191, 0.1);
    }

    .provider-card {
        position: relative;
        overflow: hidden;
    }

    .provider-card .card-body {
        position: relative;
        z-index: 1;
    }

    .provider-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        border-radius: 0 0 0 60px;
        z-index: 0;
    }

    @media (max-width: 768px) {
        .col-md-3, .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .container {
            padding: 20px 15px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 15px;
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
</style>

<div class="container">
    <h1 class="mb-4 animate-fade-in">Tous les prestataires</h1>
    
    <div class="card mb-4 filter-card animate-fade-in delay-100">
        <div class="card-body">
            <form action="{{ route('providers.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Recherche</label>
                    <input type="text" name="search" id="search" class="form-control" 
                           placeholder="Nom ou description..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="category_id" class="form-label">Catégorie</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="available" class="form-label">Disponibilité</label>
                    <select name="available" id="available" class="form-select">
                        <option value="">Tous</option>
                        <option value="1" {{ request('available') == '1' ? 'selected' : '' }}>Disponibles uniquement</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filtrer</button>
                    @if(request()->hasAny(['category_id', 'available', 'search']))
                        <a href="{{ route('providers.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
    @if($providers->count() > 0)
        <div class="stats-section animate-fade-in delay-200">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted mb-0">
                    <strong>{{ $providers->total() }}</strong> prestataire(s) trouvé(s)
                </p>
                <div class="text-muted">
                    Affichage de <strong>{{ $providers->firstItem() }}</strong> à <strong>{{ $providers->lastItem() }}</strong> sur <strong>{{ $providers->total() }}</strong> résultats
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($providers as $index => $provider)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 provider-card animate-fade-in" style="animation-delay: {{ 0.3 + ($index * 0.1) }}s">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    @if(isset($provider->photo) && $provider->photo)
                                        <img src="{{ asset('storage/' . $provider->photo) }}" alt="{{ $provider->name }}" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                                    @else
                                        <img src="https://via.placeholder.com/60" alt="{{ $provider->name }}" class="rounded-circle">
                                    @endif
                                </div>
                                <div class="ms-3">
                                    <h5 class="card-title mb-0">{{ $provider->name }}</h5>
                                    <div class="rating">
                                        @php
                                            $ratings = \App\Models\Rating::where('provider_id', $provider->id)->get();
                                            $avgRating = $ratings->avg('rating') ?: 0;
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
                                        <span class="ms-1 text-muted">({{ $ratings->count() }})</span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="card-text">
                                <strong>Catégorie:</strong> 
                                {{ \App\Models\Category::find($provider->category_id)->name ?? 'Non spécifié' }}
                            </p>
                            
                            <p class="card-text">
                                <strong>Disponibilité:</strong> 
                                @if($provider->is_available)
                                    <span class="badge bg-success">Disponible</span>
                                @else
                                    <span class="badge bg-danger">Non disponible</span>
                                @endif
                            </p>
                            
                            @if($provider->bio)
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit($provider->bio, 100) }}
                                </p>
                            @endif
                            
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-primary">Voir profil</a>
                                @if(Auth::check() && Auth::user()->isClient())
                                    <a href="{{ route('messages.create', $provider->id) }}" class="btn btn-outline-primary">Contacter</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center animate-fade-in" style="animation-delay: {{ 0.5 + (count($providers) * 0.1) }}s">
            {{ $providers->links() }}
        </div>
    @else
        <div class="alert alert-info animate-fade-in delay-200">
            <h4>Aucun prestataire trouvé</h4>
            <p>Aucun prestataire ne correspond à vos critères de recherche. Essayez de modifier vos filtres.</p>
        </div>
    @endif
</div>

<script>
    // Animation des cartes au scroll
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

        document.querySelectorAll('.provider-card').forEach(card => {
            observer.observe(card);
        });
    });

    // Amélioration des filtres
    document.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('change', function() {
            if (this.value) {
                this.style.borderColor = 'var(--primary)';
                this.style.backgroundColor = 'rgba(45, 212, 191, 0.05)';
            } else {
                this.style.borderColor = '#e2e8f0';
                this.style.backgroundColor = 'white';
            }
        });

        // État initial
        if (input.value) {
            input.style.borderColor = 'var(--primary)';
            input.style.backgroundColor = 'rgba(45, 212, 191, 0.05)';
        }
    });
</script>
@endsection