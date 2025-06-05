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

    .dashboard-container {
        padding: 30px 0;
    }

    .card {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 20px 25px;
        border-bottom: none;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .card-body {
        padding: 25px;
    }

    .card-body h4 {
        color: var(--dark);
        font-weight: 700;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .card-body p {
        color: var(--gray);
        margin-bottom: 20px;
    }

    .alert {
        border-radius: 12px;
        border: none;
        padding: 20px;
        margin-bottom: 0;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
        border-left: 4px solid var(--success);
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
        border-left: 4px solid var(--danger);
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

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
        padding: 0 15px;
        margin-bottom: 30px;
    }

    .col-md-2 {
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
        padding: 0 15px;
        margin-bottom: 20px;
    }

    .col-sm-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .h-100 {
        height: 100%;
    }

    .text-center {
        text-align: center;
    }

    .text-decoration-none {
        text-decoration: none;
    }

    .text-decoration-none:hover {
        text-decoration: none;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .fas {
        font-size: 3rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark);
    }

    .card-text {
        color: var(--gray);
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    h4.mb-3 {
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        padding-left: 15px;
    }

    h4.mb-3::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, var(--primary), var(--secondary));
        border-radius: 2px;
    }

    .category-card {
        transition: all 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow);
    }

    .category-card .fas {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .category-card h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .col-md-2 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-sm-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (max-width: 576px) {
        .col-md-2, .col-sm-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

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
                            <div class="card h-100 text-center category-card">
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