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

.justify-content-center {
    justify-content: center;
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
    background: linear-gradient(135deg, var(--secondary) 0%, #e97e0f 100%);
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
    padding: 25px 30px;
    border-bottom: none;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}

.card-header::before {
    content: '⭐';
    margin-right: 12px;
    font-size: 1.4rem;
}

.card-header::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M30 30l15-15v30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.3;
}

.card-body {
    padding: 30px;
}

.provider-info {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
    border-left: 4px solid var(--primary);
    display: flex;
    align-items: center;
}

.provider-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    margin-right: 15px;
    object-fit: cover;
}

.provider-details h4 {
    color: var(--dark);
    font-weight: 600;
    margin-bottom: 5px;
}

.provider-details p {
    color: var(--gray);
    margin-bottom: 0;
    font-size: 0.9rem;
}

.mb-3 {
    margin-bottom: 1.5rem;
}

.mt-1 {
    margin-top: 0.25rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 12px;
    font-size: 1rem;
}

.rating-section {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.03) 0%, rgba(245, 158, 11, 0.01) 100%);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    border: 1px solid rgba(245, 158, 11, 0.1);
}

.rating-input {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 20px 0;
}

.star-rating {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin: 20px 0;
}

.star-input {
    display: none;
}

.star-label {
    font-size: 2.5rem;
    color: #e2e8f0;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.star-label:hover,
.star-label.active {
    color: var(--secondary);
    transform: scale(1.1);
    text-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
}

.star-label:hover::before,
.star-label.active::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    z-index: -1;
}

.rating-description {
    text-align: center;
    margin-top: 15px;
    font-weight: 600;
    color: var(--dark);
    min-height: 24px;
    transition: all 0.3s ease;
}

.form-control {
    width: 100%;
    padding: 15px 18px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #fafafa;
    color: var(--dark);
    resize: vertical;
    min-height: 120px;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    background-color: white;
    box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
    transform: translateY(-1px);
}

.form-control.is-invalid {
    border-color: var(--danger);
    background-color: #fef2f2;
}

.invalid-feedback {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

.text-danger {
    color: var(--danger) !important;
    font-size: 0.875rem;
    font-weight: 500;
}

.btn {
    display: inline-block;
    padding: 14px 28px;
    font-size: 1rem;
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

.d-grid {
    display: grid;
}

.gap-2 {
    gap: 15px;
}

.comment-section {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid var(--primary);
}

.char-counter {
    text-align: right;
    font-size: 0.8rem;
    color: var(--gray);
    margin-top: 5px;
}

@media (max-width: 768px) {
    .col-md-8 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .container {
        padding: 20px 15px;
    }

    .card-body {
        padding: 20px;
    }

    .star-label {
        font-size: 2rem;
    }

    .provider-info {
        flex-direction: column;
        text-align: center;
    }

    .provider-avatar {
        margin-right: 0;
        margin-bottom: 15px;
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

@keyframes starPulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
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

.star-pulse {
    animation: starPulse 0.3s ease-in-out;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card animate-fade-in">
                <div class="card-header">
                    {{ $existingRating ? 'Modifier votre évaluation de' : 'Évaluer' }} {{ $provider->name }}
                </div>

                <div class="card-body">
                    <!-- Informations du prestataire -->
                    <div class="provider-info animate-fade-in delay-100">
                        @if(isset($provider->profile) && $provider->profile->photo)
                            <img src="{{ asset('storage/' . $provider->profile->photo) }}" alt="{{ $provider->name }}" class="provider-avatar">
                        @else
                            <img src="https://via.placeholder.com/60" alt="{{ $provider->name }}" class="provider-avatar">
                        @endif
                        <div class="provider-details">
                            <h4>{{ $provider->name }}</h4>
                            <p>{{ $provider->profile->category->name ?? 'Prestataire de services' }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('ratings.store', $provider->id) }}" id="ratingForm">
                        @csrf

                        <!-- Section notation -->
                        <div class="rating-section animate-fade-in delay-200">
                            <label for="rating" class="form-label">Votre note</label>
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" class="star-input" name="rating" id="rating{{ $i }}" value="{{ $i }}" {{ (old('rating', $existingRating->rating ?? 0) == $i) ? 'checked' : '' }} required>
                                    <label class="star-label" for="rating{{ $i }}" data-rating="{{ $i }}">⭐</label>
                                @endfor
                            </div>
                            <div class="rating-description" id="ratingDescription">
                                @if(old('rating', $existingRating->rating ?? 0))
                                    {{ ['', 'Très insatisfait', 'Insatisfait', 'Correct', 'Satisfait', 'Très satisfait'][old('rating', $existingRating->rating ?? 0)] }}
                                @else
                                    Cliquez sur les étoiles pour noter
                                @endif
                            </div>
                            @error('rating')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Section commentaire -->
                        <div class="comment-section animate-fade-in delay-300">
                            <label for="comment" class="form-label">Votre commentaire</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="5" placeholder="Partagez votre expérience avec ce prestataire...">{{ old('comment', $existingRating->comment ?? '') }}</textarea>
                            <div class="char-counter" id="charCounter">0 caractères</div>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 animate-fade-in delay-400">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                {{ $existingRating ? '✏️ Mettre à jour' : '📝 Soumettre' }} l'évaluation
                            </button>
                            <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const starLabels = document.querySelectorAll('.star-label');
    const ratingDescription = document.getElementById('ratingDescription');
    const commentTextarea = document.getElementById('comment');
    const charCounter = document.getElementById('charCounter');
    const submitBtn = document.getElementById('submitBtn');
    
    const descriptions = [
        'Cliquez sur les étoiles pour noter',
        'Très insatisfait 😞',
        'Insatisfait 😐',
        'Correct 🙂',
        'Satisfait 😊',
        'Très satisfait 🤩'
    ];

    // Initialiser l'état des étoiles
    function updateStars() {
        const checkedRating = document.querySelector('input[name="rating"]:checked');
        const rating = checkedRating ? parseInt(checkedRating.value) : 0;
        
        starLabels.forEach((label, index) => {
            if (index < rating) {
                label.classList.add('active');
            } else {
                label.classList.remove('active');
            }
        });
        
        ratingDescription.textContent = descriptions[rating];
    }

    // Gestion des étoiles
    starLabels.forEach((label, index) => {
        label.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            document.getElementById(`rating${rating}`).checked = true;
            
            // Animation de pulsation
            this.classList.add('star-pulse');
            setTimeout(() => {
                this.classList.remove('star-pulse');
            }, 300);
            
            updateStars();
        });

        label.addEventListener('mouseenter', function() {
            const rating = parseInt(this.dataset.rating);
            starLabels.forEach((star, starIndex) => {
                if (starIndex < rating) {
                    star.style.color = 'var(--secondary)';
                    star.style.transform = 'scale(1.05)';
                } else {
                    star.style.color = '#e2e8f0';
                    star.style.transform = 'scale(1)';
                }
            });
            ratingDescription.textContent = descriptions[rating];
        });

        label.addEventListener('mouseleave', function() {
            updateStars();
        });
    });

    // Compteur de caractères
    function updateCharCounter() {
        const length = commentTextarea.value.length;
        charCounter.textContent = `${length} caractères`;
        
        if (length > 500) {
            charCounter.style.color = 'var(--danger)';
        } else if (length > 400) {
            charCounter.style.color = 'var(--warning)';
        } else {
            charCounter.style.color = 'var(--gray)';
        }
    }

    commentTextarea.addEventListener('input', updateCharCounter);

    // Animation du formulaire lors de la soumission
    document.getElementById('ratingForm').addEventListener('submit', function() {
        submitBtn.innerHTML = '⏳ Envoi en cours...';
        submitBtn.style.opacity = '0.7';
        submitBtn.disabled = true;
    });

    // Validation en temps réel
    commentTextarea.addEventListener('input', function() {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
        }
    });

    // Initialiser l'état
    updateStars();
    updateCharCounter();
});
</script>
@endsection