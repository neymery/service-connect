@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
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
            
            <div class="card mb-4">
                <div class="card-header">Coordonnées</div>
                <div class="card-body">
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
        
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">À propos</div>
                <div class="card-body">
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
            
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Évaluations ({{ $ratings->total() }})</span>
                        <span class="text-muted">Page {{ $ratings->currentPage() }} sur {{ $ratings->lastPage() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if($ratings->count() > 0)
                        @foreach($ratings as $rating)
                            <div class="mb-4 pb-4 border-bottom">
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
                        <div class="mt-3">
                            {{ $ratings->links() }}
                        </div>
                    @else
                        <p class="text-muted">Aucune évaluation pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
