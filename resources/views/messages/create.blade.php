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

.card-header {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: var(--dark);
    font-weight: 600;
    padding: 20px 25px;
    border-bottom: 1px solid rgba(45, 212, 191, 0.1);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-header h4 {
    margin: 0;
    font-weight: 700;
    color: var(--dark);
    display: flex;
    align-items: center;
}

.card-header h4::before {
    content: '✉️';
    margin-right: 10px;
    font-size: 1.2rem;
}

.card-body {
    padding: 25px;
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

.mb-0 {
    margin-bottom: 0;
}

.mt-3 {
    margin-top: 1rem;
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
}

textarea.form-control {
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

.form-text {
    font-size: 0.875rem;
    color: var(--gray);
    margin-top: 8px;
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

.text-danger {
    color: var(--danger) !important;
}

.text-warning {
    color: var(--warning) !important;
}

.text-muted {
    color: var(--gray) !important;
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

.btn-lg {
    padding: 16px 28px;
    font-size: 1.05rem;
}

.btn-sm {
    padding: 8px 16px;
    font-size: 0.85rem;
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

.btn-outline-primary {
    background: transparent;
    color: var(--primary);
    border: 2px solid var(--primary);
}

.btn-outline-primary:hover {
    background: rgba(45, 212, 191, 0.1);
    color: var(--primary-hover);
    transform: translateY(-2px);
}

.btn-outline-danger {
    background: transparent;
    color: var(--danger);
    border: 2px solid var(--danger);
}

.btn-outline-danger:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
    transform: translateY(-2px);
}

.d-flex {
    display: flex;
}

.flex-wrap {
    flex-wrap: wrap;
}

.align-items-center {
    align-items: center;
}

.justify-content-between {
    justify-content: space-between;
}

.flex-grow-1 {
    flex-grow: 1;
}

.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

.w-100 {
    width: 100%;
}

.me-3 {
    margin-right: 1rem;
}

.me-2 {
    margin-right: 0.5rem;
}

.gap-2 {
    gap: 0.5rem;
}

.d-grid {
    display: grid;
}

.rounded-circle {
    border-radius: 50%;
}

.bg-light {
    background-color: var(--light);
}

.bg-secondary {
    background-color: var(--gray);
}

.text-white {
    color: white;
}

.border {
    border: 1px solid #e2e8f0;
}

.border-bottom {
    border-bottom: 1px solid #e2e8f0;
}

.rounded {
    border-radius: 0.375rem;
}

.shadow-sm {
    box-shadow: var(--shadow-sm);
}

.p-3 {
    padding: 1rem;
}

.py-3 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}

/* User card styles */
.user-card {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    border: 1px solid rgba(45, 212, 191, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
}

.user-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
    border-color: rgba(45, 212, 191, 0.3);
}

.user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(45, 212, 191, 0.2);
    transition: all 0.3s ease;
}

.user-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(45, 212, 191, 0.3);
}

.avatar-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    background: linear-gradient(135deg, var(--gray) 0%, var(--gray-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(45, 212, 191, 0.2);
}

.user-role-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: var(--primary);
    border: 1px solid rgba(45, 212, 191, 0.2);
    margin-left: 8px;
}

.user-role-badge i {
    margin-right: 4px;
    font-size: 0.7rem;
}

/* Search results styles */
.search-results-container {
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
    border-radius: 12px;
    box-shadow: var(--shadow);
    border: 1px solid rgba(45, 212, 191, 0.1);
    background: white;
    margin-top: 5px;
}

.search-result-item {
    padding: 12px 15px;
    border-bottom: 1px solid rgba(45, 212, 191, 0.1);
    cursor: pointer;
    transition: all 0.2s ease;
}

.search-result-item:hover {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    transform: translateX(5px);
}

.search-result-item:last-child {
    border-bottom: none;
}

.search-result-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    object-fit: cover;
}

/* Message suggestions */
.suggestions-container {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 4px solid var(--info);
}

.suggestions-container h6 {
    color: var(--info);
    font-weight: 600;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.suggestions-container h6::before {
    content: '💡';
    margin-right: 8px;
}

.suggestion-btn {
    background: white;
    border: 1px solid rgba(45, 212, 191, 0.2);
    color: var(--dark);
    border-radius: 20px;
    padding: 8px 15px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    margin-bottom: 8px;
    box-shadow: var(--shadow-sm);
}

.suggestion-btn:hover {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
    color: white;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(45, 212, 191, 0.25);
}

.suggestion-btn i {
    margin-right: 5px;
    font-size: 0.8rem;
}

.char-counter {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 20px;
    padding: 4px 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.char-counter.warning {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
    color: var(--warning);
}

.char-counter.danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    color: var(--danger);
}

/* Tips section */
.tips-section {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(16, 185, 129, 0.02) 100%);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 4px solid var(--success);
}

.tips-section h6 {
    color: var(--success);
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.tips-section h6::before {
    content: '✨';
    margin-right: 8px;
}

.tips-section ul {
    margin-bottom: 0;
    padding-left: 25px;
}

.tips-section li {
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

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }

    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .card-header .btn {
        align-self: flex-start;
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

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
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

.animate-slide-in-right {
    animation: slideInRight 0.5s ease-out forwards;
}

.animate-slide-in-left {
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

.delay-400 {
    animation-delay: 0.4s;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card animate-fade-in">
                <div class="card-header">
                    <h4 class="mb-0">Nouveau message</h4>
                    <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour aux messages
                    </a>
                </div>

                <div class="card-body">
                    <!-- Conseils pour un bon message -->
                    <div class="tips-section animate-slide-in-left delay-100">
                        <h6>Conseils pour un message efficace</h6>
                        <ul>
                            <li>Soyez clair et précis dans votre demande</li>
                            <li>Présentez-vous brièvement si c'est votre premier contact</li>
                            <li>Posez des questions spécifiques pour obtenir des réponses précises</li>
                            <li>Indiquez vos disponibilités si vous demandez un rendez-vous</li>
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('messages.store') }}" id="new-message-form" class="animate-fade-in delay-200">
                        @csrf

                        <div class="form-section mb-4">
                            <label for="receiver_id" class="form-label">
                                <i class="fas fa-user me-2" style="color: var(--primary);"></i>Destinataire *
                            </label>
                            @if($receiver)
                                <!-- Destinataire pré-sélectionné -->
                                <div class="user-card">
                                    <div class="card-body py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($receiver->profile && $receiver->profile->photo)
                                                    <img src="{{ asset('storage/' . $receiver->profile->photo) }}" 
                                                         alt="{{ $receiver->name }}" 
                                                         class="user-avatar">
                                                @else
                                                    <div class="avatar-placeholder">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">{{ $receiver->name }}</h5>
                                                <div class="mb-1">
                                                    <span class="user-role-badge">
                                                        <i class="fas fa-{{ $receiver->role === 'prestataire' ? 'briefcase' : 'user' }}"></i>
                                                        {{ $receiver->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                                        @if($receiver->role === 'prestataire' && $receiver->profile && $receiver->profile->category)
                                                            - {{ $receiver->profile->category->name }}
                                                        @endif
                                                    </span>
                                                </div>
                                                @if($receiver->profile && $receiver->profile->bio)
                                                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">
                                                        {{ \Illuminate\Support\Str::limit($receiver->profile->bio, 100) }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('providers.show', $receiver->id) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>Profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                            @else
                                <!-- Sélecteur de destinataire avec recherche -->
                                <div class="position-relative">
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%); border: none;">
                                            <i class="fas fa-search" style="color: var(--primary);"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control" 
                                               id="user-search" 
                                               placeholder="Rechercher un utilisateur par nom ou catégorie..."
                                               autocomplete="off">
                                    </div>
                                    <div id="search-results" class="search-results-container position-absolute w-100" style="display: none;"></div>
                                </div>
                                <input type="hidden" name="receiver_id" id="selected-receiver-id" required>
                                <div id="selected-user" class="mt-3" style="display: none;"></div>
                                @error('receiver_id')
                                    <div class="invalid-feedback mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>

                        <div class="form-section mb-4">
                            <label for="content" class="form-label">
                                <i class="fas fa-comment-alt me-2" style="color: var(--primary);"></i>Message *
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="6" 
                                      required 
                                      placeholder="Tapez votre message ici..."
                                      maxlength="1000">{{ old('content') }}</textarea>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="form-text">
                                    <i class="fas fa-info-circle me-1" style="color: var(--primary);"></i>
                                    Soyez clair et précis
                                </span>
                                <span class="char-counter" id="char-counter">
                                    <i class="fas fa-text-height me-1"></i>
                                    <span id="char-count">0</span>/1000
                                </span>
                            </div>
                            @error('content')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Suggestions de messages -->
                        <div class="suggestions-container animate-slide-in-right delay-300">
                            <h6>Suggestions de messages</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="suggestion-btn" 
                                        data-text="Bonjour, je suis intéressé(e) par vos services. Pourriez-vous me donner plus d'informations sur vos prestations et vos tarifs ? Merci d'avance pour votre réponse.">
                                    <i class="fas fa-info-circle"></i>Demande d'informations
                                </button>
                                <button type="button" class="suggestion-btn" 
                                        data-text="Bonjour, je souhaiterais obtenir un devis pour le service suivant : [précisez votre besoin]. Pourriez-vous me faire une proposition ? Merci.">
                                    <i class="fas fa-file-invoice-dollar"></i>Demande de devis
                                </button>
                                <button type="button" class="suggestion-btn" 
                                        data-text="Bonjour, j'aimerais prendre rendez-vous pour [précisez le service]. Je suis disponible [précisez vos disponibilités]. Merci de me confirmer si l'une de ces dates vous convient.">
                                    <i class="fas fa-calendar-check"></i>Prise de rendez-vous
                                </button>
                                <button type="button" class="suggestion-btn" 
                                        data-text="Bonjour, j'ai une question concernant [précisez votre question]. Pourriez-vous m'éclairer sur ce point ? Merci pour votre aide.">
                                    <i class="fas fa-question-circle"></i>Question spécifique
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2 animate-fade-in delay-400">
                            <button type="submit" class="btn btn-primary btn-lg" id="send-message-btn">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                            </button>
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Annuler
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
    const charCounter = document.getElementById('char-counter');
    const charCount = document.getElementById('char-count');
    const userSearch = document.getElementById('user-search');
    const searchResults = document.getElementById('search-results');
    const selectedReceiverId = document.getElementById('selected-receiver-id');
    const selectedUserDiv = document.getElementById('selected-user');
    const suggestionBtns = document.querySelectorAll('.suggestion-btn');
    const sendMessageBtn = document.getElementById('send-message-btn');

    // Compteur de caractères
    if (contentTextarea) {
        contentTextarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 800) {
                charCounter.className = count > 900 ? 'char-counter danger' : 'char-counter warning';
            } else {
                charCounter.className = 'char-counter';
            }
            
            // Activer/désactiver le bouton d'envoi
            if (count < 5) {
                sendMessageBtn.disabled = true;
                sendMessageBtn.style.opacity = '0.7';
            } else {
                sendMessageBtn.disabled = false;
                sendMessageBtn.style.opacity = '1';
            }
            
            // Auto-resize du textarea
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 300) + 'px';
        });

        // Initialiser le compteur
        charCount.textContent = contentTextarea.value.length;
        
        // Effet visuel pour le contenu
        contentTextarea.addEventListener('focus', function() {
            this.style.borderColor = 'var(--primary)';
            this.style.backgroundColor = 'rgba(45, 212, 191, 0.03)';
        });
        
        contentTextarea.addEventListener('blur', function() {
            if (this.value.trim().length === 0) {
                this.style.borderColor = '#e2e8f0';
                this.style.backgroundColor = '#fafafa';
            }
        });
    }

    // Recherche d'utilisateurs
    if (userSearch) {
        let searchTimeout;
        
        userSearch.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }
            
            // Afficher un indicateur de chargement
            searchResults.innerHTML = '<div class="p-3 text-center"><i class="fas fa-spinner fa-spin me-2"></i>Recherche en cours...</div>';
            searchResults.style.display = 'block';
            
            searchTimeout = setTimeout(() => {
                fetch(`{{ route('messages.search-users') }}?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(users => {
                        displaySearchResults(users);
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                        searchResults.innerHTML = '<div class="p-3 text-danger"><i class="fas fa-exclamation-circle me-2"></i>Une erreur est survenue</div>';
                    });
            }, 300);
        });

        // Cacher les résultats quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!userSearch.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
        
        // Focus sur le champ de recherche
        if (!selectedReceiverId.value) {
            setTimeout(() => {
                userSearch.focus();
            }, 500);
        }
    }

    function displaySearchResults(users) {
        if (users.length === 0) {
            searchResults.innerHTML = `
                <div class="p-3 text-center text-muted">
                    <i class="fas fa-search fa-2x mb-2"></i>
                    <p class="mb-0">Aucun utilisateur trouvé</p>
                    <small>Essayez avec un autre terme de recherche</small>
                </div>`;
        } else {
            searchResults.innerHTML = users.map((user, index) => `
                <div class="search-result-item" 
                     style="animation: fadeIn 0.3s ease-out forwards; animation-delay: ${index * 0.05}s;" 
                     data-user='${JSON.stringify(user)}'>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            ${user.photo ? 
                                `<img src="${user.photo}" alt="${user.name}" class="search-result-avatar">` :
                                `<div class="search-result-avatar d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--gray) 0%, var(--gray-light) 100%);">
                                    <i class="fas fa-user text-white"></i>
                                </div>`
                            }
                        </div>
                        <div>
                            <h6 class="mb-0">${user.name}</h6>
                            <div class="d-flex align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-${user.role === 'prestataire' ? 'briefcase' : 'user'} me-1" style="color: var(--primary);"></i>
                                    ${user.role === 'prestataire' ? 'Prestataire' : 'Client'}
                                </small>
                                ${user.category ? 
                                    `<small class="text-muted ms-2">
                                        <i class="fas fa-tag me-1" style="color: var(--secondary);"></i>${user.category}
                                    </small>` : 
                                    ''
                                }
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        
        searchResults.style.display = 'block';
        
        // Ajouter les événements de clic
        document.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', function() {
                const user = JSON.parse(this.dataset.user);
                selectUser(user);
            });
        });
    }

    function selectUser(user) {
        selectedReceiverId.value = user.id;
        userSearch.value = user.name;
        searchResults.style.display = 'none';
        
        selectedUserDiv.innerHTML = `
            <div class="user-card animate-fade-in">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            ${user.photo ? 
                                `<img src="${user.photo}" alt="${user.name}" class="user-avatar">` :
                                `<div class="avatar-placeholder">
                                    <i class="fas fa-user text-white"></i>
                                </div>`
                            }
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">${user.name}</h5>
                            <div class="mb-1">
                                <span class="user-role-badge">
                                    <i class="fas fa-${user.role === 'prestataire' ? 'briefcase' : 'user'}"></i>
                                    ${user.role === 'prestataire' ? 'Prestataire' : 'Client'}
                                    ${user.category ? ' - ' + user.category : ''}
                                </span>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearSelection()">
                                <i class="fas fa-times"></i>
                            </button>
                            ${user.profile_url ? 
                                `<a href="${user.profile_url}" class="btn btn-outline-primary btn-sm ms-2">
                                    <i class="fas fa-eye me-1"></i>Profil
                                </a>` : 
                                ''
                            }
                        </div>
                    </div>
                </div>
            </div>
        `;
        selectedUserDiv.style.display = 'block';
        userSearch.style.display = 'none';
        
        // Focus sur le textarea après la sélection
        setTimeout(() => {
            contentTextarea.focus();
        }, 300);
    }

    // Suggestions de messages
    suggestionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.dataset.text;
            contentTextarea.value = text;
            contentTextarea.dispatchEvent(new Event('input'));
            
            // Animation du bouton
            this.classList.add('animate-pulse');
            setTimeout(() => {
                this.classList.remove('animate-pulse');
            }, 500);
            
            // Focus sur le textarea
            contentTextarea.focus();
            
            // Positionner le curseur à la fin
            contentTextarea.setSelectionRange(text.length, text.length);
        });
    });

    // Animation des boutons de suggestion au survol
    suggestionBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 6px 12px rgba(45, 212, 191, 0.2)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Validation du formulaire
    const newMessageForm = document.getElementById('new-message-form');
    if (newMessageForm) {
        newMessageForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Vérifier si un destinataire est sélectionné
            if (!selectedReceiverId.value && !document.querySelector('input[name="receiver_id"][type="hidden"][value]')) {
                isValid = false;
                if (userSearch) {
                    userSearch.classList.add('is-invalid');
                    if (!document.getElementById('receiver-error')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.id = 'receiver-error';
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Veuillez sélectionner un destinataire';
                        userSearch.parentNode.appendChild(errorDiv);
                    }
                }
            }
            
            // Vérifier si le message est rempli
            if (!contentTextarea.value.trim()) {
                isValid = false;
                contentTextarea.classList.add('is-invalid');
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
            
            // Animation de soumission
            sendMessageBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
            sendMessageBtn.disabled = true;
            return true;
        });
    }

    // Fonction globale pour effacer la sélection
    window.clearSelection = function() {
        selectedReceiverId.value = '';
        userSearch.value = '';
        userSearch.style.display = 'block';
        selectedUserDiv.style.display = 'none';
        searchResults.style.display = 'none';
        
        // Focus sur le champ de recherche
        setTimeout(() => {
            userSearch.focus();
        }, 100);
    };
    
    // Raccourci clavier Ctrl+Enter pour envoyer
    contentTextarea.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            if (!sendMessageBtn.disabled) {
                newMessageForm.submit();
            }
        }
    });
    
    // Animation des éléments au scroll
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

    document.querySelectorAll('.animate-fade-in, .animate-slide-in-left, .animate-slide-in-right').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection
