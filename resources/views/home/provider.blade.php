@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">Tableau de bord</div>

                <div class="card-body">
                    <h4>Bienvenue, {{ $user->name }} !</h4>
                    <p>Vous êtes connecté en tant que prestataire. Gérez votre profil et vos messages.</p>
                    
                    <div class="alert {{ $user->profile->is_available ? 'alert-success' : 'alert-danger' }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Statut actuel:</strong> 
                                {{ $user->profile->is_available ? 'Vous êtes marqué comme disponible' : 'Vous êtes marqué comme non disponible' }}
                            </div>
                            <form action="{{ route('provider.toggle-availability') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn {{ $user->profile->is_available ? 'btn-danger' : 'btn-success' }}">
                                    {{ $user->profile->is_available ? 'Marquer comme non disponible' : 'Marquer comme disponible' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-user-edit fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Mon profil</h5>
                            <p class="card-text">Gérez vos informations professionnelles et votre disponibilité.</p>
                            <a href="{{ route('provider.profile') }}" class="btn btn-primary">Voir mon profil</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Mes messages</h5>
                            <p class="card-text">Consultez et répondez aux messages de vos clients.</p>
                            <a href="{{ route('messages.index') }}" class="btn btn-primary">Voir les messages</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Autres prestataires</h5>
                            <p class="card-text">Découvrez les autres prestataires sur la plateforme.</p>
                            <a href="{{ route('providers.index') }}" class="btn btn-primary">Voir les prestataires</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <h4 class="mb-3">Catégories de services</h4>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-2 col-sm-4 mb-4">
                        <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <i class="fas {{ $category->icon }} fa-2x mb-2 text-primary"></i>
                                    <h6 class="card-title">{{ $category->name }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
