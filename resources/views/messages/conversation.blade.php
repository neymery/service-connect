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

.container-fluid {
    padding: 30px 15px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
}

.col-md-3, .col-md-9 {
    padding: 0 15px;
}

.col-md-3 {
    flex: 0 0 25%;
    max-width: 25%;
}

.col-md-9 {
    flex: 0 0 75%;
    max-width: 75%;
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
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
    color: white;
    font-weight: 600;
    padding: 20px 25px;
    border-bottom: none;
    position: relative;
}

.conversation-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    padding: 25px;
}

.sidebar-header {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: var(--dark);
}

.sidebar-header h6 {
    color: var(--dark);
    font-weight: 700;
    margin-bottom: 0;
    display: flex;
    align-items: center;
}

.sidebar-header h6::before {
    content: '💬';
    margin-right: 8px;
    font-size: 1.1rem;
}

.card-body {
    padding: 0;
}

.sidebar-body {
    padding: 20px;
    height: 300px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--primary) transparent;
}

.sidebar-body::-webkit-scrollbar {
    width: 6px;
}

.sidebar-body::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-body::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 3px;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.3);
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.user-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.user-details h5 {
    color: white;
    font-weight: 700;
    margin-bottom: 5px;
    font-size: 1.2rem;
}

.user-role {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}

.conversation-stats {
    text-align: right;
    color: rgba(255, 255, 255, 0.9);
}

.conversation-stats small {
    display: block;
    font-size: 0.85rem;
}

.dropdown-toggle {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 8px;
    padding: 8px 12px;
    transition: all 0.3s ease;
}

.dropdown-toggle:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-1px);
}

.dropdown-menu {
    border: none;
    border-radius: 12px;
    box-shadow: var(--shadow);
    padding: 8px 0;
}

.dropdown-item {
    padding: 10px 20px;
    color: var(--dark);
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: var(--primary);
}

.dropdown-item.text-danger:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
}

.messages-container {
    height: 500px;
    overflow-y: auto;
    padding: 20px;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.02) 0%, rgba(245, 158, 11, 0.02) 100%);
    scrollbar-width: thin;
    scrollbar-color: var(--primary) transparent;
    scroll-behavior: smooth;
}

.messages-container::-webkit-scrollbar {
    width: 8px;
}

.messages-container::-webkit-scrollbar-track {
    background: transparent;
}

.messages-container::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 4px;
}

.date-separator {
    text-align: center;
    margin: 20px 0;
}

.date-badge {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: var(--dark);
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid rgba(45, 212, 191, 0.2);
}

.message-wrapper {
    margin-bottom: 15px;
    display: flex;
}

.message-wrapper.my-message {
    justify-content: flex-end;
}

.message-wrapper.their-message {
    justify-content: flex-start;
}

.message-bubble {
    max-width: 70%;
    position: relative;
}

.message-content {
    padding: 15px 18px;
    border-radius: 18px;
    position: relative;
    word-wrap: break-word;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.my-message .message-content {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
    color: white;
    border-bottom-right-radius: 6px;
}

.their-message .message-content {
    background: white;
    color: var(--dark);
    border: 1px solid rgba(45, 212, 191, 0.1);
    border-bottom-left-radius: 6px;
}

.message-content p {
    margin-bottom: 8px;
    line-height: 1.5;
    font-size: 0.95rem;
}

.message-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 5px;
}

.message-time {
    font-size: 0.75rem;
    opacity: 0.8;
}

.my-message .message-time {
    color: rgba(255, 255, 255, 0.8);
}

.their-message .message-time {
    color: var(--gray);
}

.message-status {
    display: flex;
    align-items: center;
}

.message-status i {
    font-size: 0.8rem;
    opacity: 0.8;
}

.message-actions {
    margin-top: 8px;
    text-align: right;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.message-bubble:hover .message-actions {
    opacity: 1;
}

.btn-sm {
    padding: 4px 8px;
    font-size: 0.75rem;
    border-radius: 6px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    margin: 20px;
}

.empty-state i {
    color: var(--primary);
    margin-bottom: 20px;
}

.empty-state h6 {
    color: var(--dark);
    font-weight: 600;
    margin-bottom: 10px;
}

.empty-state p {
    color: var(--gray);
}

.card-footer {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-top: 1px solid rgba(45, 212, 191, 0.1);
    padding: 20px 25px;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: white;
    resize: none;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
    transform: translateY(-1px);
}

.form-text {
    font-size: 0.8rem;
    color: var(--gray);
    margin-top: 5px;
}

.char-counter {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    border-radius: 12px;
    padding: 2px 8px;
    font-weight: 500;
}

.char-counter.text-warning {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
    color: var(--warning);
}

.char-counter.text-danger {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    color: var(--danger);
}

.btn {
    padding: 10px 16px;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: none;
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

.btn-outline-danger {
    background: transparent;
    color: var(--danger);
    border: 1px solid var(--danger);
}

.btn-outline-danger:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
    transform: translateY(-2px);
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.align-items-end {
    align-items: flex-end;
}

.justify-content-between {
    justify-content: space-between;
}

.justify-content-start {
    justify-content: flex-start;
}

.justify-content-end {
    justify-content: flex-end;
}

.flex-grow-1 {
    flex-grow: 1;
}

.flex-column {
    flex-direction: column;
}

.me-3 {
    margin-right: 1rem;
}

.me-2 {
    margin-right: 0.5rem;
}

.mb-0 {
    margin-bottom: 0;
}

.mb-1 {
    margin-bottom: 0.25rem;
}

.mb-2 {
    margin-bottom: 0.5rem;
}

.mb-3 {
    margin-bottom: 1rem;
}

.text-end {
    text-align: right;
}

.text-center {
    text-align: center;
}

.w-100 {
    width: 100%;
}

/* Animations */
@keyframes slideInRight {
    from {
        transform: translateX(20px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInLeft {
    from {
        transform: translateX(-20px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.my-message {
    animation: slideInRight 0.3s ease-out;
}

.their-message {
    animation: slideInLeft 0.3s ease-out;
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

.pulse-animation {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(45, 212, 191, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(45, 212, 191, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(45, 212, 191, 0);
    }
}

@media (max-width: 768px) {
    .col-md-3 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .col-md-9 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .container-fluid {
        padding: 20px 15px;
    }

    .messages-container {
        height: 400px;
    }

    .message-bubble {
        max-width: 85%;
    }

    .conversation-header {
        padding: 20px;
    }

    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .conversation-stats {
        text-align: left;
    }
}
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar des conversations (version réduite) -->
        <div class="col-md-3">
            <div class="card animate-fade-in">
                <div class="card-header sidebar-header">
                    <h6 class="mb-0">Conversations</h6>
                </div>
                <div class="card-body sidebar-body">
                    <div class="text-center">
                        <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i>Retour aux messages
                        </a>
                    </div>
                    
                    <!-- Statistiques rapides -->
                    <div class="mt-3 p-3 rounded-3" style="background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);">
                        <h6 class="text-center mb-2" style="color: var(--primary); font-weight: 600;">
                            <i class="fas fa-chart-line me-2"></i>Statistiques
                        </h6>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-number" style="color: var(--primary); font-weight: 700;">{{ $stats['total_messages'] ?? 0 }}</div>
                                    <div class="stat-label" style="font-size: 0.7rem; color: var(--gray);">Messages</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-item">
                                    <div class="stat-number" style="color: var(--secondary); font-weight: 700;">{{ $stats['days_since_first'] ?? 0 }}</div>
                                    <div class="stat-label" style="font-size: 0.7rem; color: var(--gray);">Jours</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zone de conversation principale -->
        <div class="col-md-9">
            <div class="card animate-fade-in" style="animation-delay: 0.2s;">
                <!-- En-tête de la conversation -->
                <div class="card-header conversation-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user-info">
                            @if($otherUser->profile && $otherUser->profile->photo)
                                <img src="{{ asset('storage/' . $otherUser->profile->photo) }}" 
                                     alt="{{ $otherUser->name }}" 
                                     class="user-avatar me-3">
                            @else
                                <div class="avatar-placeholder me-3">
                                    <i class="fas fa-user" style="color: rgba(255, 255, 255, 0.8); font-size: 1.2rem;"></i>
                                </div>
                            @endif
                            <div class="user-details">
                                <h5 class="mb-1">{{ $otherUser->name }}</h5>
                                <div class="user-role">
                                    <i class="fas fa-{{ $otherUser->role === 'prestataire' ? 'briefcase' : 'user' }} me-2"></i>
                                    {{ $otherUser->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                    @if($otherUser->role === 'prestataire' && $otherUser->profile && $otherUser->profile->category)
                                        - {{ $otherUser->profile->category->name }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="conversation-stats me-3">
                                <small>{{ $stats['total_messages'] ?? 0 }} messages</small>
                                <small>Depuis {{ $messages->last()->created_at->format('M Y') ?? 'récemment' }}</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('providers.show', $otherUser->id) }}">
                                        <i class="fas fa-user me-2" style="color: var(--primary);"></i>Voir le profil
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="clearConversation()">
                                        <i class="fas fa-trash me-2"></i>Supprimer la conversation
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zone des messages -->
                <div class="card-body">
                    <div id="messages-container" class="messages-container">
                        @if($messages->count() > 0)
                            @php $currentDate = null; @endphp
                            @foreach($messages->reverse() as $message)
                                @php $messageDate = $message->created_at->format('Y-m-d'); @endphp
                                
                                <!-- Séparateur de date -->
                                @if($currentDate !== $messageDate)
                                    <div class="date-separator">
                                        <span class="date-badge">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            {{ $message->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    @php $currentDate = $messageDate; @endphp
                                @endif

                                <!-- Message -->
                                <div class="message-wrapper {{ $message->sender_id === Auth::id() ? 'my-message' : 'their-message' }}" 
                                     data-message-id="{{ $message->id }}">
                                    <div class="message-bubble">
                                        <div class="message-content">
                                            <p class="mb-1">{{ $message->content }}</p>
                                            <div class="message-meta">
                                                <small class="message-time">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ $message->created_at->format('H:i') }}
                                                </small>
                                                @if($message->sender_id === Auth::id())
                                                    <div class="message-status">
                                                        @if($message->read_at)
                                                            <i class="fas fa-check-double" title="Lu le {{ $message->read_at->format('d/m/Y H:i') }}" style="color: var(--success);"></i>
                                                        @else
                                                            <i class="fas fa-check" title="Envoyé"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if($message->sender_id === Auth::id())
                                            <div class="message-actions">
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage({{ $message->id }})" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="empty-state">
                                <i class="fas fa-comment fa-3x"></i>
                                <h6>Aucun message</h6>
                                <p>Commencez la conversation en envoyant un message</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Formulaire de réponse rapide -->
                <div class="card-footer">
                    <form id="quick-reply-form" class="d-flex align-items-end">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                        
                        <div class="flex-grow-1 me-3">
                            <textarea class="form-control" 
                                      name="content" 
                                      id="message-input"
                                      rows="2" 
                                      placeholder="Tapez votre message..." 
                                      required></textarea>
                            <div class="form-text d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-info-circle me-1" style="color: var(--primary);"></i>
                                    Appuyez sur Entrée pour envoyer
                                </span>
                                <span class="char-counter" id="char-counter">
                                    <span id="char-count">0</span>/1000
                                </span>
                            </div>
                        </div>
                        
                        <div class="d-flex flex-column">
                            <button type="submit" class="btn btn-primary mb-2" id="send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearInput()" title="Effacer">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('messages-container');
    const messageInput = document.getElementById('message-input');
    const charCount = document.getElementById('char-count');
    const charCounter = document.getElementById('char-counter');
    const quickReplyForm = document.getElementById('quick-reply-form');
    const sendBtn = document.getElementById('send-btn');

    // Auto-scroll vers le bas
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Compteur de caractères avec style
    messageInput.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        
        if (count > 800) {
            charCounter.className = count > 900 ? 'char-counter text-danger' : 'char-counter text-warning';
        } else {
            charCounter.className = 'char-counter';
        }
        
        // Auto-resize du textarea
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });

    // Envoi rapide avec Enter (Shift+Enter pour nouvelle ligne)
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            quickReplyForm.dispatchEvent(new Event('submit'));
        }
    });

    // Effet visuel lors du focus
    messageInput.addEventListener('focus', function() {
        this.style.borderColor = 'var(--primary)';
        this.style.backgroundColor = 'rgba(45, 212, 191, 0.03)';
    });

    messageInput.addEventListener('blur', function() {
        if (this.value.trim().length === 0) {
            this.style.borderColor = '#e2e8f0';
            this.style.backgroundColor = 'white';
        }
    });

    // Soumission AJAX du formulaire
    quickReplyForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const content = formData.get('content').trim();
        
        if (!content) return;

        // Animation du bouton d'envoi
        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        sendBtn.classList.add('pulse-animation');

        fetch('{{ route("messages.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Ajouter le message à l'interface
                addMessageToUI(data.message);
                
                // Vider le formulaire
                messageInput.value = '';
                charCount.textContent = '0';
                charCounter.className = 'char-counter';
                messageInput.style.height = 'auto';
                
                // Scroll vers le bas avec animation
                messagesContainer.scrollTo({
                    top: messagesContainer.scrollHeight,
                    behavior: 'smooth'
                });
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            // Notification d'erreur stylisée
            showNotification('Erreur lors de l\'envoi du message', 'error');
        })
        .finally(() => {
            // Réactiver le bouton
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
            sendBtn.classList.remove('pulse-animation');
        });
    });

    function addMessageToUI(message) {
        const now = new Date();
        const messageHtml = `
            <div class="message-wrapper my-message" data-message-id="${message.id}">
                <div class="message-bubble">
                    <div class="message-content">
                        <p class="mb-1">${message.content}</p>
                        <div class="message-meta">
                            <small class="message-time">
                                <i class="fas fa-clock me-1"></i>
                                ${now.toLocaleTimeString('fr-FR', {hour: '2-digit', minute: '2-digit'})}
                            </small>
                            <div class="message-status">
                                <i class="fas fa-check" title="Envoyé"></i>
                            </div>
                        </div>
                    </div>
                    <div class="message-actions">
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage(${message.id})" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
    }

    function showNotification(message, type = 'info') {
        // Créer une notification temporaire
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'error' ? 'danger' : 'success'} position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'} me-2"></i>
            ${message}
        `;
        
        document.body.appendChild(notification);
        
        // Animation d'entrée
        notification.style.transform = 'translateX(100%)';
        notification.style.transition = 'transform 0.3s ease';
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Suppression automatique
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }
});

function clearInput() {
    const messageInput = document.getElementById('message-input');
    const charCount = document.getElementById('char-count');
    const charCounter = document.getElementById('char-counter');
    
    messageInput.value = '';
    charCount.textContent = '0';
    charCounter.className = 'char-counter';
    messageInput.style.height = 'auto';
    messageInput.focus();
}

function deleteMessage(messageId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) return;
    
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    
    // Animation de suppression
    messageElement.style.transition = 'all 0.3s ease';
    messageElement.style.transform = 'translateX(100%)';
    messageElement.style.opacity = '0';
    
    fetch(`/messages/${messageId}/delete`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            setTimeout(() => {
                messageElement.remove();
            }, 300);
        } else {
            // Annuler l'animation si erreur
            messageElement.style.transform = '';
            messageElement.style.opacity = '';
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        messageElement.style.transform = '';
        messageElement.style.opacity = '';
    });
}

function clearConversation() {
    if (confirm('Êtes-vous sûr de vouloir supprimer toute cette conversation ? Cette action est irréversible.')) {
        // Implémenter la suppression de conversation
        alert('Fonctionnalité à implémenter côté serveur');
    }
}

// Actualiser les statuts de lecture toutes les 30 secondes
setInterval(function() {
    fetch(`{{ route('messages.conversation', $otherUser->id) }}?check_status=1`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.unread_messages) {
            // Mettre à jour les statuts des messages
            data.unread_messages.forEach(messageId => {
                const statusIcon = document.querySelector(`[data-message-id="${messageId}"] .message-status i`);
                if (statusIcon && statusIcon.classList.contains('fa-check')) {
                    statusIcon.classList.remove('fa-check');
                    statusIcon.classList.add('fa-check-double');
                    statusIcon.style.color = 'var(--success)';
                    statusIcon.title = 'Lu';
                }
            });
        }
    })
    .catch(error => console.log('Erreur lors de la vérification des statuts:', error));
}, 30000);

// Marquer les messages comme lus automatiquement
fetch(`{{ route('messages.mark-read', $otherUser->id) }}`, {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json'
    }
}).catch(error => console.log('Erreur lors du marquage comme lu:', error));
</script>
@endsection