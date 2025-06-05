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

.mb-4 {
    margin-bottom: 1.5rem;
}

.mb-3 {
    margin-bottom: 1rem;
}

.mb-2 {
    margin-bottom: 0.5rem;
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

.original-message .card-header::before {
    content: '📧';
    margin-right: 10px;
    font-size: 1.2rem;
}

.reply-card .card-header {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.15) 0%, rgba(245, 158, 11, 0.15) 100%);
}

.reply-card .card-header::before {
    content: '↩️';
    margin-right: 10px;
    font-size: 1.2rem;
}

.card-body {
    padding: 25px;
}

.message-meta {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    padding: 15px 20px;
    margin-bottom: 20px;
    border-left: 4px solid var(--primary);
}

.sender-info {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.sender-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    margin-right: 12px;
    object-fit: cover;
}

.sender-details strong {
    color: var(--dark);
    font-weight: 600;
    font-size: 1rem;
}

.sender-role {
    color: var(--gray);
    font-size: 0.85rem;
    margin-left: 8px;
    padding: 2px 8px;
    background: rgba(45, 212, 191, 0.1);
    border-radius: 12px;
}

.message-time {
    color: var(--gray);
    font-size: 0.85rem;
    background: var(--gray-light);
    padding: 4px 8px;
    border-radius: 8px;
}

.original-content {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
    border-radius: 12px;
    padding: 20px;
    border-left: 4px solid var(--info);
    position: relative;
    margin-top: 15px;
}

.original-content::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 15px;
    font-size: 3rem;
    color: var(--primary);
    opacity: 0.3;
    font-family: serif;
}

.original-content p {
    color: var(--dark);
    line-height: 1.6;
    margin-bottom: 0;
    font-style: italic;
    padding-left: 20px;
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

.form-section {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid var(--primary);
}

.form-label {
    display: block;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 12px;
    font-size: 1rem;
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
    min-height: 140px;
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
    margin-top: 8px;
    display: block;
    padding: 8px 12px;
    background: rgba(239, 68, 68, 0.1);
    border-radius: 8px;
    border-left: 3px solid var(--danger);
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

.char-counter {
    text-align: right;
    font-size: 0.8rem;
    color: var(--gray);
    margin-top: 8px;
    padding: 4px 8px;
    background: rgba(45, 212, 191, 0.05);
    border-radius: 6px;
    display: inline-block;
    float: right;
}

.reply-tips {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 4px solid var(--info);
}

.reply-tips h6 {
    color: var(--info);
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.reply-tips h6::before {
    content: '💡';
    margin-right: 8px;
}

.reply-tips ul {
    margin-bottom: 0;
    padding-left: 20px;
}

.reply-tips li {
    color: var(--dark);
    margin-bottom: 5px;
    font-size: 0.9rem;
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

    .form-section {
        padding: 20px;
    }

    .sender-info {
        flex-direction: column;
        align-items: flex-start;
        text-align: center;
    }

    .sender-avatar {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
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

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

.animate-slide-in {
    animation: slideInLeft 0.5s ease-out forwards;
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Message original -->
            <div class="card mb-4 original-message animate-fade-in">
                <div class="card-header">Message original</div>
                <div class="card-body">
                    <div class="message-meta">
                        <div class="sender-info">
                            @if($originalMessage->sender->profile && $originalMessage->sender->profile->photo)
                                <img src="{{ asset('storage/' . $originalMessage->sender->profile->photo) }}" 
                                     alt="{{ $originalMessage->sender->name }}" 
                                     class="sender-avatar">
                            @else
                                <div class="sender-avatar" style="background: linear-gradient(135deg, var(--gray) 0%, var(--gray-light) 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="color: white; font-size: 1rem;"></i>
                                </div>
                            @endif
                            <div class="sender-details">
                                <strong>{{ $originalMessage->sender->name }}</strong>
                                <span class="sender-role">
                                    {{ $originalMessage->sender->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="message-time">
                                <i class="fas fa-clock me-1"></i>
                                {{ $originalMessage->created_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="original-content">
                        <p>{{ $originalMessage->content }}</p>
                    </div>
                </div>
            </div>

            <!-- Formulaire de réponse -->
            <div class="card reply-card animate-slide-in delay-200">
                <div class="card-header">Répondre à {{ $originalMessage->sender->name }}</div>

                <div class="card-body">
                    <!-- Conseils pour la réponse -->
                    <div class="reply-tips animate-fade-in delay-300">
                        <h6>Conseils pour une bonne réponse</h6>
                        <ul>
                            <li>Soyez clair et précis dans votre réponse</li>
                            <li>Répondez à toutes les questions posées</li>
                            <li>Restez professionnel et courtois</li>
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('messages.store') }}" id="replyForm">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                        <div class="form-section">
                            <div class="mb-3">
                                <label for="content" class="form-label">Votre réponse</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" 
                                          name="content" 
                                          rows="6" 
                                          required 
                                          placeholder="Tapez votre réponse ici...">{{ old('content') }}</textarea>
                                <div class="char-counter" id="charCounter">0 caractères</div>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="sendBtn">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer la réponse
                            </button>
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Retour aux messages
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    const charCounter = document.getElementById('charCounter');
    const sendBtn = document.getElementById('sendBtn');
    const replyForm = document.getElementById('replyForm');

    // Compteur de caractères
    function updateCharCounter() {
        const length = contentTextarea.value.length;
        charCounter.textContent = `${length} caractères`;
        
        if (length > 1000) {
            charCounter.style.color = 'var(--danger)';
            charCounter.style.background = 'rgba(239, 68, 68, 0.1)';
        } else if (length > 800) {
            charCounter.style.color = 'var(--warning)';
            charCounter.style.background = 'rgba(245, 158, 11, 0.1)';
        } else {
            charCounter.style.color = 'var(--gray)';
            charCounter.style.background = 'rgba(45, 212, 191, 0.05)';
        }

        // Activer/désactiver le bouton selon la longueur
        if (length < 5) {
            sendBtn.disabled = true;
            sendBtn.style.opacity = '0.6';
        } else {
            sendBtn.disabled = false;
            sendBtn.style.opacity = '1';
        }
    }

    contentTextarea.addEventListener('input', updateCharCounter);

    // Validation en temps réel
    contentTextarea.addEventListener('input', function() {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
        }
        
        // Effet visuel pour le contenu
        if (this.value.trim().length > 0) {
            this.style.borderColor = 'var(--primary)';
            this.style.backgroundColor = 'rgba(45, 212, 191, 0.05)';
        } else {
            this.style.borderColor = '#e2e8f0';
            this.style.backgroundColor = '#fafafa';
        }
    });

    // Animation du formulaire lors de la soumission
    replyForm.addEventListener('submit', function() {
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
        sendBtn.style.opacity = '0.7';
        sendBtn.disabled = true;
    });

    // Auto-resize du textarea
    contentTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 300) + 'px';
    });

    // Focus automatique sur le textarea
    setTimeout(() => {
        contentTextarea.focus();
    }, 500);

    // Raccourci clavier Ctrl+Enter pour envoyer
    contentTextarea.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            if (!sendBtn.disabled) {
                replyForm.submit();
            }
        }
    });

    // Initialiser l'état
    updateCharCounter();
});

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

    document.querySelectorAll('.animate-fade-in, .animate-slide-in').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection