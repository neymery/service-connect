@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar des conversations (version réduite) -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Conversations</h6>
                </div>
                <div class="card-body p-0" style="height: 300px; overflow-y: auto;">
                    <!-- Ici on peut inclure une version simplifiée de la liste des conversations -->
                    <div class="p-3">
                        <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                            <i class="fas fa-arrow-left me-2"></i>Retour aux messages
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zone de conversation principale -->
        <div class="col-md-9">
            <div class="card">
                <!-- En-tête de la conversation -->
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <div class="d-flex align-items-center">
                        @if($otherUser->profile && $otherUser->profile->photo)
                            <img src="{{ asset('storage/' . $otherUser->profile->photo) }}" 
                                 alt="{{ $otherUser->name }}" 
                                 class="rounded-circle me-3" 
                                 width="40" height="40" 
                                 style="object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                 style="width: 40px; height: 40px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="mb-0">{{ $otherUser->name }}</h5>
                            <small class="text-white-50">
                                {{ $otherUser->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                @if($otherUser->role === 'prestataire' && $otherUser->profile && $otherUser->profile->category)
                                    - {{ $otherUser->profile->category->name }}
                                @endif
                            </small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3 text-end">
                            <small class="d-block">{{ $stats['total_messages'] }} messages</small>
                            <small class="text-white-50">Depuis {{ $messages->last()->created_at->format('M Y') ?? 'récemment' }}</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('providers.show', $otherUser->id) }}">
                                    <i class="fas fa-user me-2"></i>Voir le profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="clearConversation()">
                                    <i class="fas fa-trash me-2"></i>Supprimer la conversation
                                </a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Zone des messages -->
                <div class="card-body p-0">
                    <div id="messages-container" style="height: 500px; overflow-y: auto; padding: 20px;">
                        @if($messages->count() > 0)
                            @php $currentDate = null; @endphp
                            @foreach($messages->reverse() as $message)
                                @php $messageDate = $message->created_at->format('Y-m-d'); @endphp
                                
                                <!-- Séparateur de date -->
                                @if($currentDate !== $messageDate)
                                    <div class="text-center my-3">
                                        <span class="badge bg-light text-dark">
                                            {{ $message->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    @php $currentDate = $messageDate; @endphp
                                @endif

                                <!-- Message -->
                                <div class="mb-3 d-flex {{ $message->sender_id === Auth::id() ? 'justify-content-end' : 'justify-content-start' }}" 
                                     data-message-id="{{ $message->id }}">
                                    <div class="message-bubble {{ $message->sender_id === Auth::id() ? 'my-message' : 'their-message' }}" 
                                         style="max-width: 70%;">
                                        <div class="p-3 rounded-3 {{ $message->sender_id === Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                                            <p class="mb-1">{{ $message->content }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="{{ $message->sender_id === Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                                    {{ $message->created_at->format('H:i') }}
                                                </small>
                                                @if($message->sender_id === Auth::id())
                                                    <div class="message-status">
                                                        @if($message->read_at)
                                                            <i class="fas fa-check-double text-white-50" title="Lu le {{ $message->read_at->format('d/m/Y H:i') }}"></i>
                                                        @else
                                                            <i class="fas fa-check text-white-50" title="Envoyé"></i>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if($message->sender_id === Auth::id())
                                            <div class="message-actions mt-1 text-end">
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage({{ $message->id }})" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-comment fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">Aucun message</h6>
                                <p class="text-muted">Commencez la conversation en envoyant un message</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Formulaire de réponse rapide -->
                <div class="card-footer bg-light">
                    <form id="quick-reply-form" class="d-flex align-items-end">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                        
                        <div class="flex-grow-1 me-3">
                            <textarea class="form-control" 
                                      name="content" 
                                      id="message-input"
                                      rows="2" 
                                      placeholder="Tapez votre message..." 
                                      required
                                      style="resize: none;"></textarea>
                            <div class="form-text">
                                <span id="char-count">0</span>/1000 caractères
                            </div>
                        </div>
                        
                        <div class="d-flex flex-column">
                            <button type="submit" class="btn btn-primary mb-2" id="send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearInput()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.my-message {
    animation: slideInRight 0.3s ease-out;
}

.their-message {
    animation: slideInLeft 0.3s ease-out;
}

@keyframes slideInRight {
    from { transform: translateX(20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideInLeft {
    from { transform: translateX(-20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

.message-actions {
    opacity: 0;
    transition: opacity 0.2s;
}

.message-bubble:hover .message-actions {
    opacity: 1;
}

#messages-container {
    scroll-behavior: smooth;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('messages-container');
    const messageInput = document.getElementById('message-input');
    const charCount = document.getElementById('char-count');
    const quickReplyForm = document.getElementById('quick-reply-form');
    const sendBtn = document.getElementById('send-btn');

    // Auto-scroll vers le bas
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Compteur de caractères
    messageInput.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = count;
        charCount.className = count > 1000 ? 'text-danger' : count > 800 ? 'text-warning' : '';
    });

    // Envoi rapide avec Enter (Shift+Enter pour nouvelle ligne)
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            quickReplyForm.dispatchEvent(new Event('submit'));
        }
    });

    // Soumission AJAX du formulaire
    quickReplyForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const content = formData.get('content').trim();
        
        if (!content) return;

        // Désactiver le bouton d'envoi
        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

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
                
                // Scroll vers le bas
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de l\'envoi du message');
        })
        .finally(() => {
            // Réactiver le bouton
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
        });
    });

    function addMessageToUI(message) {
        const now = new Date();
        const messageHtml = `
            <div class="mb-3 d-flex justify-content-end" data-message-id="${message.id}">
                <div class="message-bubble my-message" style="max-width: 70%;">
                    <div class="p-3 rounded-3 bg-primary text-white">
                        <p class="mb-1">${message.content}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-white-50">${now.toLocaleTimeString('fr-FR', {hour: '2-digit', minute: '2-digit'})}</small>
                            <div class="message-status">
                                <i class="fas fa-check text-white-50" title="Envoyé"></i>
                            </div>
                        </div>
                    </div>
                    <div class="message-actions mt-1 text-end">
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteMessage(${message.id})" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        messagesContainer.insertAdjacentHTML('beforeend', messageHtml);
    }
});

function clearInput() {
    document.getElementById('message-input').value = '';
    document.getElementById('char-count').textContent = '0';
}

function deleteMessage(messageId) {
    if (!confirm('Êtes-vous sûr de vouloir supprimer ce message ?')) return;
    
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
            document.querySelector(`[data-message-id="${messageId}"]`).remove();
        }
    })
    .catch(error => console.error('Erreur:', error));
}

function clearConversation() {
    if (confirm('Êtes-vous sûr de vouloir supprimer toute cette conversation ?')) {
        // Implémenter la suppression de conversation
        alert('Fonctionnalité à implémenter');
    }
}

// Actualiser les statuts de lecture toutes les 10 secondes
setInterval(function() {
    // Marquer les messages comme lus automatiquement
    const unreadMessages = document.querySelectorAll('.their-message .fa-check:not(.fa-check-double)');
    // Logique pour mettre à jour les statuts
}, 10000);
</script>
@endsection
