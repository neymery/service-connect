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

    .text-center {
        text-align: center;
    }

    .rounded-circle {
        border-radius: 50%;
        border: 4px solid;
        border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
        box-shadow: 0 8px 16px rgba(45, 212, 191, 0.2);
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 10px;
    }

    .text-muted {
        color: var(--gray) !important;
        font-size: 1rem;
    }

    .rating {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        margin-bottom: 1rem;
    }

    .rating .fas,
    .rating .far {
        color: var(--secondary);
        font-size: 1.1rem;
    }

    .rating .ms-1 {
        margin-left: 8px;
        color: var(--gray);
        font-weight: 600;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        font-size: 0.95rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        text-align: center;
        margin-bottom: 10px;
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(239, 68, 68, 0.25);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(239, 68, 68, 0.3);
        color: white;
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
    }

    .bio-section {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
        border-radius: 12px;
        padding: 20px;
        margin: 15px 0;
    }

    .bio-section p {
        color: var(--dark);
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .bio-section p:last-child {
        margin-bottom: 0;
    }

    .bio-section strong {
        color: var(--primary);
    }

    .bio-section a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .bio-section a:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .rating-item {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid rgba(45, 212, 191, 0.1);
        transition: all 0.3s ease;
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

    .rating-item strong {
        color: var(--dark);
        font-size: 1.1rem;
    }

    .rating-item .rating {
        margin-bottom: 10px;
    }

    .rating-item small {
        color: var(--gray);
        font-size: 0.85rem;
    }

    .rating-item p {
        color: var(--dark);
        line-height: 1.5;
        font-style: italic;
    }

    .availability-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .availability-badge.available {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .availability-badge.unavailable {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .availability-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .availability-badge.available::before {
        background-color: var(--success);
    }

    .availability-badge.unavailable::before {
        background-color: var(--danger);
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
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 animate-fade-in">
                <div class="card-body text-center">
                    @if($profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $user->name }}" class="rounded-circle mb-3" width="150" height="150">
                    @else
                        <img src="https://via.placeholder.com/150" alt="{{ $user->name }}" class="rounded-circle mb-3">
                    @endif
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <p class="text-muted">{{ $profile->category->name ?? 'Non spécifié' }}</p>
                    
                    <div class="availability-badge {{ $profile->is_available ? 'available' : 'unavailable' }}">
                        {{ $profile->is_available ? 'Disponible' : 'Non disponible' }}
                    </div>
                    
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
                        <span class="ms-1">({{ number_format($avgRating, 1) }})</span>
                    </div>
                    
                    <form action="{{ route('provider.toggle-availability') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $profile->is_available ? 'btn-danger' : 'btn-success' }} mb-3">
                            {{ $profile->is_available ? 'Je ne suis pas disponible' : 'Je suis disponible' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('provider.edit') }}" class="btn btn-primary">Modifier mon profil</a>
                </div>
            </div>
            
            <div class="card mb-4 animate-fade-in delay-100">
                <div class="card-header">Mes coordonnées</div>
                <div class="card-body">
                    <div class="contact-info">
                        @if($user->phone)
                            <p><i class="fas fa-phone me-2"></i> {{ $user->phone }}</p>
                        @endif
                        
                        @if($user->address)
                            <p><i class="fas fa-map-marker-alt me-2"></i> {{ $user->address }}</p>
                        @endif
                        
                        <p><i class="fas fa-envelope me-2"></i> {{ $user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card mb-4 animate-fade-in delay-200">
                <div class="card-header">À propos de moi</div>
                <div class="card-body">
                    <div class="bio-section">
                        @if($profile->bio)
                            <p>{{ $profile->bio }}</p>
                        @else
                            <p class="text-muted">Aucune information disponible. <a href="{{ route('provider.edit') }}">Ajoutez une bio</a> pour vous présenter aux clients.</p>
                        @endif
                        
                        @if($profile->experience)
                            <p><strong>Expérience:</strong> {{ $profile->experience }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card animate-fade-in delay-300">
                <div class="card-header">Mes évaluations</div>
                <div class="card-body">
                    @php
                        $ratings = $user->receivedRatings()->with('client')->get();
                    @endphp
                    
                    @if($ratings->count() > 0)
                        @foreach($ratings as $rating)
                            <div class="rating-item {{ !$loop->last ? 'border-bottom' : '' }}">
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
                                <p class="mb-0">{{ $rating->comment }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="bio-section">
                            <p class="text-muted">Vous n'avez pas encore reçu d'évaluations.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection