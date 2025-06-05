@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $category->name }}</h1>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Retour aux catégories</a>
    </div>
    
    <p class="lead mb-4">{{ $category->description }}</p>
    
    <h2 class="mb-3">Prestataires disponibles</h2>
    
    @if($providers->count() > 0)
        <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    @if($provider->photo)
                                        <img src="{{ asset('storage/' . $provider->photo) }}" alt="{{ $provider->user->name }}" class="rounded-circle" width="60" height="60">
                                    @else
                                        <img src="https://via.placeholder.com/60" alt="{{ $provider->user->name }}" class="rounded-circle">
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
                            
                            <p class="card-text">
                                <strong>Disponibilité:</strong> 
                                @if($provider->is_available)
                                    <span class="text-success">Disponible</span>
                                @else
                                    <span class="text-danger">Non disponible</span>
                                @endif
                            </p>
                            
                            <p class="card-text">
                                <strong>Expérience:</strong> {{ $provider->experience ?? 'Non spécifié' }}
                            </p>
                            
                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('providers.show', $provider->user->id) }}" class="btn btn-primary">Voir profil</a>
                                <a href="{{ route('messages.create', $provider->user->id) }}" class="btn btn-outline-primary">Contacter</a>
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
@endsection
