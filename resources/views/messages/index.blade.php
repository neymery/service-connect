@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar des conversations -->
        <div class="col-md-4 col-lg-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Messages 
                        @if($totalUnreadCount > 0)
                            <span class="badge bg-danger">{{ $totalUnreadCount }}</span>
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
                
                <div class="card-body p-0" style="height: 600px; overflow-y: auto;">
                    @if($conversations->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($conversations as $conversation)
                                @if($conversation->user)
                                    <a href="{{ route('messages.conversation', $conversation->user->id) }}" 
                                       class="list-group-item list-group-item-action conversation-item {{ $conversation->unread_count > 0 ? 'unread-conversation' : '' }}"
                                       data-user-id="{{ $conversation->user->id }}">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                @if($conversation->user->profile && $conversation->user->profile->photo)
                                                    <img src="{{ asset('storage/' . $conversation->user->profile->photo) }}" 
                                                         alt="{{ $conversation->user->name }}" 
                                                         class="rounded-circle" 
                                                         width="50" height="50" 
                                                         style="object-fit: cover;">
                                                @else
                                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                                @if($conversation->unread_count > 0)
                                                    <span class="position-absolute translate-middle badge rounded-pill bg-danger" 
                                                          style="top: 10px; left: 45px;">
                                                        {{ $conversation->unread_count }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 min-width-0">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-1 text-truncate">{{ $conversation->user->name }}</h6>
                                                    <small class="text-muted">{{ $conversation->last_message_date->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-1 text-muted small text-truncate">
                                                    @if($conversation->is_last_message_mine)
                                                        <i class="fas fa-reply me-1"></i>Vous: 
                                                    @endif
                                                    {{ \Illuminate\Support\Str::limit($conversation->last_message_content, 40) }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
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
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Aucune conversation</h6>
                            <p class="text-muted small">Commencez une nouvelle conversation</p>
                            <a href="{{ route('messages.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-2"></i>Nouveau message
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Zone principale -->
        <div class="col-md-8 col-lg-9">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <i class="fas fa-comment-dots fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">Sélectionnez une conversation</h4>
                        <p class="text-muted">Choisissez une conversation dans la liste pour commencer à discuter</p>
                        <a href="{{ route('messages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Nouvelle conversation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.unread-conversation {
    background-color: #f8f9fa !important;
    border-left: 4px solid #007bff !important;
}

.conversation-item:hover {
    background-color: #e9ecef !important;
}

.min-width-0 {
    min-width: 0;
}
</style>

<script>
// Actualiser le compteur de messages non lus toutes les 30 secondes
setInterval(function() {
    fetch('{{ route("messages.unread-count") }}')
        .then(response => response.json())
        .then(data => {
            // Mettre à jour les badges de compteur
            const badges = document.querySelectorAll('.badge');
            badges.forEach(badge => {
                if (badge.textContent.match(/^\d+$/)) {
                    badge.textContent = data.unread_count;
                    badge.style.display = data.unread_count > 0 ? 'inline' : 'none';
                }
            });
        });
}, 30000);
</script>
@endsection
