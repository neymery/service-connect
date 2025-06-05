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
        display: flex;
        align-items: center;
    }

    .card-header::before {
        content: '';
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
        margin-right: 10px;
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
        object-fit: cover;
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

    .client-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        border-radius: 20px;
        border: 1px solid rgba(45, 212, 191, 0.2);
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 20px;
    }

    .client-badge::before {
        content: '👤';
        margin-right: 8px;
        font-size: 1.1rem;
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

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.85rem;
    }

    .btn-outline-primary {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-outline-primary:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
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
        transform: translateY(-1px);
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

    .preferences-section {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
        border-radius: 12px;
        padding: 25px;
        margin: 15px 0;
        border-left: 4px solid var(--primary);
    }

    .preferences-section p {
        color: var(--dark);
        line-height: 1.7;
        margin-bottom: 0;
        font-size: 1.05rem;
    }

    .preferences-section a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .preferences-section a:hover {
        text-decoration: underline;
    }

    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table {
        margin-bottom: 0;
        background: white;
    }

    .table thead th {
        background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        color: var(--dark);
        font-weight: 600;
        border: none;
        padding: 15px 20px;
        font-size: 0.9rem;
    }

    .table tbody td {
        padding: 15px 20px;
        border-color: rgba(45, 212, 191, 0.1);
        color: var(--dark);
        vertical-align: middle;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: rgba(45, 212, 191, 0.03);
        transform: translateX(2px);
    }

    .rating {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        padding: 5px 10px;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
        border-radius: 15px;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .rating .fas,
    .rating .far {
        color: var(--secondary);
        font-size: 0.9rem;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
        border-radius: 12px;
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    .empty-state-icon {
        font-size: 3rem;
        color: var(--info);
        margin-bottom: 15px;
    }

    .empty-state h4 {
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: var(--gray);
        margin-bottom: 0;
    }

    .stats-grid {
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

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .table-responsive {
            font-size: 0.85rem;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
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
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $user->name }}" class="rounded-circle mb-3" width="150" height="150">
                    @else
                        <img src="https://via.placeholder.com/150" alt="{{ $user->name }}" class="rounded-circle mb-3">
                    @endif
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <div class="client-badge">Client</div>

                    @php
                        $ratingsCount = $user->ratings()->count();
                        $avgRating = $user->ratings()->avg('rating') ?: 0;
                    @endphp

                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{{ $ratingsCount }}</span>
                            <span class="stat-label">Évaluations</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ number_format($avgRating, 1) }}</span>
                            <span class="stat-label">Note moyenne</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('client.edit') }}" class="btn btn-primary">Modifier mon profil</a>
                </div>
            </div>
            
            <div class="card mb-4 animate-fade-in delay-100">
                <div class="card-header">📞 Mes coordonnées</div>
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
                <div class="card-header">⚙️ Mes préférences</div>
                <div class="card-body">
                    <div class="preferences-section">
                        @if($profile->preferences)
                            <p>{{ $profile->preferences }}</p>
                        @else
                            <p class="text-muted">Aucune préférence définie. <a href="{{ route('client.edit') }}">Ajoutez vos préférences</a> pour mieux cibler vos recherches.</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="card animate-fade-in delay-300">
                <div class="card-header">⭐ Mes évaluations</div>
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
                                    @foreach($ratings as $index => $rating)
                                        <tr class="animate-fade-in" style="animation-delay: {{ 0.4 + ($index * 0.1) }}s">
                                            <td><strong>{{ $rating->provider->name }}</strong></td>
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
                        <div class="empty-state">
                            <div class="empty-state-icon">📝</div>
                            <h4>Aucune évaluation</h4>
                            <p>Vous n'avez pas encore évalué de prestataires. Commencez par rechercher des services !</p>
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

        document.querySelectorAll('tr.animate-fade-in').forEach(row => {
            observer.observe(row);
        });
    });

    // Effet de survol sur les lignes du tableau
    document.querySelectorAll('.table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.boxShadow = '0 2px 8px rgba(45, 212, 191, 0.15)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    });
</script>
@endsection