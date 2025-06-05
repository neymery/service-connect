@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $user->name }}" class="rounded-circle mb-3" width="150" height="150">
                    @else
                        <img src="https://via.placeholder.com/150" alt="{{ $user->name }}" class="rounded-circle mb-3">
                    @endif
                    <h3 class="card-title">{{ $user->name }}</h3>
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
                        <span class="ms-1">({{ number_format($avgRating, 1) }})</span>
                    </div>
                    
                    <form action="{{ route('provider.toggle-availability') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $profile->is_available ? 'btn-success' : 'btn-danger' }} mb-3">
                            {{ $profile->is_available ? 'Je suis disponible' : 'Je ne suis pas disponible' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('provider.edit') }}" class="btn btn-primary">Modifier mon profil</a>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">Mes coordonnées</div>
                <div class="card-body">
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
        
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">À propos de moi</div>
                <div class="card-body">
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
            
            <div class="card">
                <div class="card-header">Mes évaluations</div>
                <div class="card-body">
                    @php
                        $ratings = $user->receivedRatings()->with('client')->get();
                    @endphp
                    
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
                                <p class="mb-0">{{ $rating->comment }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Vous n'avez pas encore reçu d'évaluations.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
