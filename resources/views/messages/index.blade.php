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

.col-md-4, .col-lg-3 {
    padding: 0 15px;
}

.col-md-8, .col-lg-9 {
    padding: 0 15px;
}

.col-md-4.col-lg-3 {
    flex: 0 0 25%;
    max-width: 25%;
}

.col-md-8.col-lg-9 {
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

.h-100 {
    height: calc(100vh - 120px) !important;
}

.card-header {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
    color: var(--dark);
    font-weight: 600;
    padding: 20px 25px;
    border-bottom: 1px solid rgba(45, 212, 191, 0.1);
    position: relative;
}

.card-header h5 {
    color: var(--dark);
    font-weight: 700;
    margin-bottom: 0;
    display: flex;
    align-items: center;
}

.card-header h5::before {
    content: '💬';
    margin-right: 10px;
    font-size: 1.2rem;
}

.badge {
    padding: 6px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 8px;
}

.bg-danger {
    background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%) !important;
    color: white;
}

.bg-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%) !important;
    color: white;
}

.dropdown-toggle {
    background: transparent;
    border: 2px solid rgba(45, 212, 191, 0.2);
    color: var(--primary);
    border-radius: 8px;
    padding: 8px 12px;
    transition: all 0.3s ease;
}

.dropdown-toggle:hover {
    background: rgba(45, 212, 191, 0.1);
    border-color: var(--primary);
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

.dropdown-item i {
    color: var(--primary);
}

.card-body {
    padding: 0;
}

.conversations-container {
    height: calc(100vh - 220px);
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: var(--primary) transparent;
}

.conversations-container::-webkit-scrollbar {
    width: 6px;
}

.conversations-container::-webkit-scrollbar-track {
    background: transparent;
}

.conversations-container::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 3px;
}

.list-group-flush {
    border-radius: 0;
}

.conversation-item {
    border: none;
    border-bottom: 1px solid rgba(45, 212, 191, 0.1) !important;
    padding: 20px 25px;
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    position: relative;
}

.conversation-item:hover {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%) !important;
    transform: translateX(3px);
    color: inherit;
}

.conversation-item:focus {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%) !important;
    color: inherit;
}

.unread-conversation {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.08) 0%, rgba(245, 158, 11, 0.08) 100%) !important;
    border-left: 4px solid var(--primary) !important;
    font-weight: 600;
}

.unread-conversation::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(to bottom, var(--primary), var(--secondary));
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.justify-content-between {
    justify-content: space-between;
}

.justify-content-center {
    justify-content: center;
}

.flex-shrink-0 {
    flex-shrink: 0;
}

.flex-grow-1 {
    flex-grow: 1;
}

.me-3 {
    margin-right: 1rem;
}

.me-2 {
    margin-right: 0.5rem;
}

.me-1 {
    margin-right: 0.25rem;
}

.mb-0 {
    margin-bottom: 0;
}

.mb-1 {
    margin-bottom: 0.25rem;
}

.mb-3 {
    margin-bottom: 1rem;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.rounded-circle {
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    box-shadow: 0 4px 8px rgba(45, 212, 191, 0.2);
    transition: all 0.3s ease;
    object-fit: cover;
}

.rounded-circle:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(45, 212, 191, 0.3);
}

.avatar-placeholder {
    background: linear-gradient(135deg, var(--gray) 0%, var(--gray-light) 100%) !important;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.avatar-placeholder i {
    color: white;
    font-size: 1.2rem;
}

.position-absolute {
    position: absolute;
}

.translate-middle {
    transform: translate(-50%, -50%);
}

.rounded-pill {
    border-radius: 50rem;
}

.notification-badge {
    top: 5px;
    left: 40px;
    min-width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: 700;
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.min-width-0 {
    min-width: 0;
}

.conversation-item h6 {
    color: var(--dark);
    font-weight: 600;
    font-size: 1rem;
}

.conversation-item p {
    color: var(--gray);
    font-size: 0.9rem;
    line-height: 1.4;
}

.conversation-item small {
    color: var(--gray);
    font-size: 0.8rem;
}

.text-muted {
    color: var(--gray) !important;
}

.small {
    font-size: 0.875rem;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
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
    margin-bottom: 20px;
}

.main-empty-state {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 16px;
    padding: 80px 40px;
}

.main-empty-state i {
    color: var(--primary);
    margin-bottom: 30px;
}

.main-empty-state h4 {
    color: var(--dark);
    font-weight: 700;
    margin-bottom: 15px;
}

.main-empty-state p {
    color: var(--gray);
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.btn {
    display: inline-block;
    padding: 12px 20px;
    font-size: 0.9rem;
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

.online-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    background: var(--success);
    border: 2px solid white;
    border-radius: 50%;
}

@media (max-width: 768px) {
    .col-md-4.col-lg-3 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }

    .col-md-8.col-lg-9 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .container-fluid {
        padding: 20px 15px;
    }

    .h-100 {
        height: auto !important;
        min-height: 400px;
    }

    .conversations-container {
        height: 400px;
    }

    .conversation-item {
        padding: 15px 20px;
    }

    .main-empty-state {
        padding: 40px 20px;
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

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
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
    animation: slideIn 0.3s ease-out forwards;
}

.delay-100 {
    animation-delay: 0.1s;
}

.delay-200 {
    animation-delay: 0.2s;
}

.pulse-notification {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
    }
}
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar des conversations -->
        <div class="col-md-4 col-lg-3">
            <div class="card h-100 animate-fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Messages 
                        @if($totalUnreadCount > 0)
                            <span class="badge bg-danger pulse-notification">{{ $totalUnreadCount }}</span>
                        @endif
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('messages.create') }}"><i class="fas fa-plus me-2"></i>Nouveau message</a></li>
                            @if($totalUnreadCount > 0)
                                <li><a class="dropdown-item" href="{{ route('messages.mark-all-read') }}"><i class="fas fa-check-double me-2"></i>Tout marquer comme lu</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="conversations-container">
                        @if($conversations->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($conversations as $index => $conversation)
                                    @if($conversation->user)
                                        <a href="{{ route('messages.conversation', $conversation->user->id) }}" 
                                           class="list-group-item list-group-item-action conversation-item {{ $conversation->unread_count > 0 ? 'unread-conversation' : '' }} animate-slide-in"
                                           style="animation-delay: {{ $index * 0.1 }}s"
                                           data-user-id="{{ $conversation->user->id }}">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3 position-relative">
                                                    @if($conversation->user->profile && $conversation->user->profile->photo)
                                                        <img src="{{ asset('storage/' . $conversation->user->profile->photo) }}" 
                                                             alt="{{ $conversation->user->name }}" 
                                                             class="rounded-circle" 
                                                             width="50" height="50">
                                                    @else
                                                        <div class="avatar-placeholder">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    @endif
                                                    @if($conversation->unread_count > 0)
                                                        <span class="position-absolute translate-middle badge rounded-pill bg-danger notification-badge">
                                                            {{ $conversation->unread_count }}
                                                        </span>
                                                    @endif
                                                    <div class="online-indicator"></div>
                                                </div>
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-1 text-truncate">{{ $conversation->user->name }}</h6>
                                                        <small class="text-muted">{{ $conversation->last_message_date->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="mb-1 text-muted small text-truncate">
                                                        @if($conversation->is_last_message_mine)
                                                            <i class="fas fa-reply me-1" style="color: var(--primary);"></i>Vous: 
                                                        @endif
                                                        {{ \Illuminate\Support\Str::limit($conversation->last_message_content, 40) }}
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            <i class="fas fa-{{ $conversation->user->role === 'prestataire' ? 'briefcase' : 'user' }} me-1" style="color: var(--primary);"></i>
                                                            {{ $conversation->user->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                                            @if($conversation->user->role === 'prestataire' && $conversation->user->profile && $conversation->user->profile->category)
                                                                - {{ $conversation->user->profile->category->name }}
                                                            @endif
                                                        </small>
                                                        @if($conversation->unread_count > 0)
                                                            <span class="badge bg-primary">{{ $conversation->unread_count }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-comments fa-3x"></i>
                                <h6>Aucune conversation</h6>
                                <p>Commencez une nouvelle conversation</p>
                                <a href="{{ route('messages.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Nouveau message
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Zone principale -->
        <div class="col-md-8 col-lg-9">
            <div class="card h-100 animate-fade-in delay-200">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="main-empty-state">
                        <i class="fas fa-comment-dots fa-4x"></i>
                        <h4>Sélectionnez une conversation</h4>
                        <p>Choisissez une conversation dans la liste pour commencer à discuter</p>
                        <a href="{{ route('messages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Nouvelle conversation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des conversations au chargement
    const conversations = document.querySelectorAll('.conversation-item');
    conversations.forEach((conv, index) => {
        setTimeout(() => {
            conv.style.opacity = '1';
            conv.style.transform = 'translateX(0)';
        }, index * 100);
    });

    // Effet de survol amélioré
    conversations.forEach(conv => {
        conv.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.boxShadow = '0 4px 12px rgba(45, 212, 191, 0.15)';
        });

        conv.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    });
});

// Actualiser le compteur de messages non lus toutes les 30 secondes
setInterval(function() {
    fetch('{{ route("messages.unread-count") }}')
        .then(response => response.json())
        .then(data => {
            // Mettre à jour les badges de compteur
            const mainBadge = document.querySelector('.card-header .badge');
            if (mainBadge) {
                if (data.unread_count > 0) {
                    mainBadge.textContent = data.unread_count;
                    mainBadge.style.display = 'inline';
                    mainBadge.classList.add('pulse-notification');
                } else {
                    mainBadge.style.display = 'none';
                    mainBadge.classList.remove('pulse-notification');
                }
            }

            // Mettre à jour les badges individuels
            const conversationBadges = document.querySelectorAll('.conversation-item .badge');
            conversationBadges.forEach(badge => {
                if (badge.textContent.match(/^\d+$/)) {
                    const count = parseInt(badge.textContent);
                    if (count > 0) {
                        badge.style.display = 'inline';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            });
        })
        .catch(error => {
            console.log('Erreur lors de la mise à jour des compteurs:', error);
        });
}, 30000);

// Marquer les messages comme lus lors du clic
document.querySelectorAll('.conversation-item').forEach(item => {
    item.addEventListener('click', function() {
        const badges = this.querySelectorAll('.badge');
        badges.forEach(badge => {
            badge.style.display = 'none';
        });
        this.classList.remove('unread-conversation');
    });
});
</script>
@endsection