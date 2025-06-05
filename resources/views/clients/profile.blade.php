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
                    <p class="text-muted">Client</p>
                    
                    <a href="{{ route('client.edit') }}" class="btn btn-primary">Modifier mon profil</a>
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
                <div class="card-header">Mes préférences</div>
                <div class="card-body">
                    @if($profile->preferences)
                        <p>{{ $profile->preferences }}</p>
                    @else
                        <p class="text-muted">Aucune préférence définie. <a href="{{ route('client.edit') }}">Ajoutez vos préférences</a> pour mieux cibler vos recherches.</p>
                    @endif
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Mes évaluations</div>
                <div class="card-body">
                    @php
                        $ratings = $user->ratings()->with('provider')->get();
                    @endphp
                    
                    @if($ratings->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Prestataire</th>
                                        <th>Note</th>
                                        <th>Commentaire</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ratings as $rating)
                                        <tr>
                                            <td>{{ $rating->provider->name }}</td>
                                            <td>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $rating->rating)
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($rating->comment, 30) }}</td>
                                            <td>{{ $rating->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('providers.show', $rating->provider_id) }}" class="btn btn-sm btn-outline-primary">Voir profil</a>
                                                <a href="{{ route('ratings.create', $rating->provider_id) }}" class="btn btn-sm btn-outline-secondary">Modifier</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Vous n'avez pas encore évalué de prestataires.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
