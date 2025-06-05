@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tous les prestataires</h1>
    
    <div class="card mb-4">
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted">{{ $providers->total() }} prestataire(s) trouvé(s)</p>
            <div>
                Affichage de {{ $providers->firstItem() }} à {{ $providers->lastItem() }} sur {{ $providers->total() }} résultats
            </div>
        </div>

        <div class="row">
            @foreach($providers as $provider)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
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
        <div class="d-flex justify-content-center">
            {{ $providers->links() }}
        </div>
    @else
        <div class="alert alert-info">
            <h4>Aucun prestataire trouvé</h4>
            <p>Aucun prestataire ne correspond à vos critères de recherche. Essayez de modifier vos filtres.</p>
        </div>
    @endif
</div>
@endsection
