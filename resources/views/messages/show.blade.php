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
    font-size: 1.1rem;
    padding: 20px 25px;
    border-bottom: 1px solid rgba(45, 212, 191, 0.1);
    position: relative;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}

.message-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.message-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(45, 212, 191, 0.2);
}

.avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    background: linear-gradient(135deg, var(--gray) 0%, var(--gray-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-placeholder i {
    color: white;
    font-size: 1.2rem;
}

.message-details h5 {
    color: var(--dark);
    font-weight: 700;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.message-type {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.message-sent {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    color: var(--success);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.message-sent::before {
    content: '📤';
    margin-right: 6px;
}

.message-received {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    color: var(--info);
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.message-received::before {
    content: '📥';
    margin-right: 6px;
}

.user-role {
    color: var(--gray);
    font-size: 0.85rem;
    display: flex;
    align-items: center;
}

.user-role i {
    margin-right: 5px;
    color: var(--primary);
}

.message-timestamp {
    background: var(--gray-light);
    color: var(--gray);
    padding: 8px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}

.message-timestamp i {
    margin-right: 6px;
    color: var(--primary);
}

.card-body {
    padding: 30px;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.message-content {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
    border-radius: 12px;
    padding: 25px;
    border-left: 4px solid var(--primary);
    position: relative;
    margin-bottom: 25px;
}

.message-content::before {
    content: '"';
    position: absolute;
    top: -15px;
    left: 20px;
    font-size: 4rem;
    color: var(--primary);
    opacity: 0.2;
    font-family: serif;
}

.message-content p {
    color: var(--dark);
    line-height: 1.7;
    margin-bottom: 0;
    font-size: 1.05rem;
    padding-left: 25px;
    position: relative;
    z-index: 1;
}

.message-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 15px;
    margin: 20px 0;
    padding: 20px;
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    border: 1px solid rgba(45, 212, 191, 0.1);
}

.stat-item {
    text-align: center;
    padding: 10px;
}

.stat-number {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary);
    display: block;
}

.stat-label {
    font-size: 0.8rem;
    color: var(--gray);
    font-weight: 500;
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

.actions-section {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.05) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-radius: 12px;
    padding: 20px;
    border: 1px solid rgba(45, 212, 191, 0.1);
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

.btn-outline-info {
    background: transparent;
    color: var(--info);
    border: 2px solid var(--info);
}

.btn-outline-info:hover {
    background: var(--info);
    color: white;
    transform: translateY(-2px);
}

.btn i {
    margin-right: 8px;
}

.conversation-link {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    border-radius: 12px;
    padding: 15px 20px;
    margin-bottom: 20px;
    border-left: 4px solid var(--info);
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    display: block;
}

.conversation-link:hover {
    transform: translateX(5px);
    box-shadow: var(--shadow-sm);
    color: inherit;
}

.conversation-link h6 {
    color: var(--info);
    font-weight: 600;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
}

.conversation-link h6::before {
    content: '💬';
    margin-right: 8px;
}

.conversation-link p {
    color: var(--gray);
    margin-bottom: 0;
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

    .message-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .message-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .message-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 15px;
    }

    .actions-section {
        text-align: center;
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

.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

.animate-slide-in {
    animation: slideInRight 0.5s ease-out forwards;
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
            <div class="card animate-fade-in">
                <div class="card-header">
                    <div class="message-header">
                        <div class="message-info">
                            @php
                                $otherUser = $message->sender_id === Auth::id() ? $message->receiver : $message->sender;
                                $isSent = $message->sender_id === Auth::id();
                            @endphp
                            
                            @if($otherUser->profile && $otherUser->profile->photo)
                                <img src="{{ asset('storage/' . $otherUser->profile->photo) }}" 
                                     alt="{{ $otherUser->name }}" 
                                     class="message-avatar">
                            @else
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            
                            <div class="message-details">
                                <div class="message-type {{ $isSent ? 'message-sent' : 'message-received' }}">
                                    {{ $isSent ? 'Message envoyé' : 'Message reçu' }}
                                </div>
                                <h5>
                                    {{ $isSent ? 'À ' . $message->receiver->name : 'De ' . $message->sender->name }}
                                </h5>
                                <div class="user-role">
                                    <i class="fas fa-{{ $otherUser->role === 'prestataire' ? 'briefcase' : 'user' }}"></i>
                                    {{ $otherUser->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                    @if($otherUser->role === 'prestataire' && $otherUser->profile && $otherUser->profile->category)
                                        - {{ $otherUser->profile->category->name }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="message-timestamp">
                            <i class="fas fa-clock"></i>
                            {{ $message->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Lien vers la conversation complète -->
                    <a href="{{ route('messages.conversation', $otherUser->id) }}" class="conversation-link animate-slide-in delay-100">
                        <h6>Voir la conversation complète</h6>
                        <p>Accédez à l'historique complet de vos échanges avec {{ $otherUser->name }}</p>
                    </a>

                    <!-- Contenu du message -->
                    <div class="message-content animate-fade-in delay-200">
                        <p>{{ $message->content }}</p>
                    </div>

                    <!-- Statistiques du message -->
                    <div class="message-stats animate-fade-in delay-300">
                        <div class="stat-item">
                            <span class="stat-number">{{ strlen($message->content) }}</span>
                            <span class="stat-label">Caractères</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ str_word_count($message->content) }}</span>
                            <span class="stat-label">Mots</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $message->created_at->diffForHumans() }}</span>
                            <span class="stat-label">Envoyé</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="actions-section animate-slide-in delay-400">
                        <div class="d-flex justify-content-between">
                            <div>
                                @if($message->receiver_id === Auth::id())
                                    <a href="{{ route('messages.reply', $message->id) }}" class="btn btn-primary">
                                        <i class="fas fa-reply"></i>Répondre
                                    </a>
                                @endif
                                <a href="{{ route('messages.conversation', $otherUser->id) }}" class="btn btn-outline-info">
                                    <i class="fas fa-comments"></i>Conversation
                                </a>
                            </div>
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i>Retour aux messages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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

    document.querySelectorAll('.animate-fade-in, .animate-slide-in').forEach(el => {
        observer.observe(el);
    });

    // Effet de survol sur le lien de conversation
    const conversationLink = document.querySelector('.conversation-link');
    if (conversationLink) {
        conversationLink.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(8px)';
            this.style.boxShadow = '0 4px 12px rgba(45, 212, 191, 0.15)';
        });

        conversationLink.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    }

    // Animation des statistiques
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const finalValue = stat.textContent;
        if (!isNaN(finalValue)) {
            let currentValue = 0;
            const increment = Math.ceil(finalValue / 20);
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    currentValue = finalValue;
                    clearInterval(timer);
                }
                stat.textContent = currentValue;
            }, 50);
        }
    });
});
</script>
@endsection