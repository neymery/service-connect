@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Nouveau message</h4>
                    <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('messages.store') }}" id="new-message-form">
                        @csrf

                        <div class="mb-4">
                            <label for="receiver_id" class="form-label">Destinataire *</label>
                            @if($receiver)
                                <!-- Destinataire pré-sélectionné -->
                                <div class="card bg-light">
                                    <div class="card-body py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                @if($receiver->profile && $receiver->profile->photo)
                                                    <img src="{{ asset('storage/' . $receiver->profile->photo) }}" 
                                                         alt="{{ $receiver->name }}" 
                                                         class="rounded-circle" 
                                                         width="50" height="50" 
                                                         style="object-fit: cover;">
                                                @else
                                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="mb-1">{{ $receiver->name }}</h5>
                                                <p class="mb-0 text-muted">
                                                    {{ $receiver->role === 'prestataire' ? 'Prestataire' : 'Client' }}
                                                    @if($receiver->role === 'prestataire' && $receiver->profile && $receiver->profile->category)
                                                        - {{ $receiver->profile->category->name }}
                                                    @endif
                                                </p>
                                                @if($receiver->profile && $receiver->profile->bio)
                                                    <small class="text-muted">{{ \Illuminate\Support\Str::limit($receiver->profile->bio, 100) }}</small>
                                                @endif
                                            </div>
                                            <div>
                                                <a href="{{ route('providers.show', $receiver->id) }}" class="btn btn-sm btn-outline-primary">
                                                    Voir profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                            @else
                                <!-- Sélecteur de destinataire avec recherche -->
                                <div class="position-relative">
                                    <input type="text" 
                                           class="form-control" 
                                           id="user-search" 
                                           placeholder="Rechercher un utilisateur..."
                                           autocomplete="off">
                                    <div id="search-results" class="position-absolute w-100 bg-white border rounded shadow-sm" style="z-index: 1000; display: none; max-height: 300px; overflow-y: auto;"></div>
                                </div>
                                <input type="hidden" name="receiver_id" id="selected-receiver-id" required>
                                <div id="selected-user" class="mt-3" style="display: none;"></div>
                                @error('receiver_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label">Message *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="6" 
                                      required 
                                      placeholder="Tapez votre message ici..."
                                      maxlength="1000">{{ old('content') }}</textarea>
                            <div class="form-text d-flex justify-content-between">
                                <span>Soyez clair et précis dans votre demande</span>
                                <span><span id="char-counter">0</span>/1000 caractères</span>
                            </div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Suggestions de messages -->
                        <div class="mb-4">
                            <label class="form-label">Suggestions de messages :</label>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary suggestion-btn" 
                                        data-text="Bonjour, je suis intéressé(e) par vos services. Pourriez-vous me donner plus d'informations ?">
                                    Demande d'informations
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary suggestion-btn" 
                                        data-text="Bonjour, êtes-vous disponible pour un devis ? Merci.">
                                    Demande de devis
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary suggestion-btn" 
                                        data-text="Bonjour, j'aimerais prendre rendez-vous. Quelles sont vos disponibilités ?">
                                    Prise de rendez-vous
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="send-message-btn">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                            </button>
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">Annuler</a>
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
    const userSearch = document.getElementById('user-search');
    const searchResults = document.getElementById('search-results');
    const selectedReceiverId = document.getElementById('selected-receiver-id');
    const selectedUserDiv = document.getElementById('selected-user');
    const suggestionBtns = document.querySelectorAll('.suggestion-btn');

    // Compteur de caractères
    if (contentTextarea) {
        contentTextarea.addEventListener('input', function() {
            const count = this.value.length;
            charCounter.textContent = count;
            charCounter.className = count > 1000 ? 'text-danger' : count > 800 ? 'text-warning' : '';
        });

        // Initialiser le compteur
        charCounter.textContent = contentTextarea.value.length;
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
            
            searchTimeout = setTimeout(() => {
                fetch(`{{ route('messages.search-users') }}?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(users => {
                        displaySearchResults(users);
                    })
                    .catch(error => console.error('Erreur:', error));
            }, 300);
        });

        // Cacher les résultats quand on clique ailleurs
        document.addEventListener('click', function(e) {
            if (!userSearch.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }

    function displaySearchResults(users) {
        if (users.length === 0) {
            searchResults.innerHTML = '<div class="p-3 text-muted">Aucun utilisateur trouvé</div>';
        } else {
            searchResults.innerHTML = users.map(user => `
                <div class="p-3 border-bottom search-result-item" style="cursor: pointer;" data-user='${JSON.stringify(user)}'>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            ${user.photo ? 
                                `<img src="${user.photo}" alt="${user.name}" class="rounded-circle" width="40" height="40" style="object-fit: cover;">` :
                                `<div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>`
                            }
                        </div>
                        <div>
                            <h6 class="mb-0">${user.name}</h6>
                            <small class="text-muted">${user.role === 'prestataire' ? 'Prestataire' : 'Client'}${user.category ? ' - ' + user.category : ''}</small>
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
            <div class="card bg-light">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            ${user.photo ? 
                                `<img src="${user.photo}" alt="${user.name}" class="rounded-circle" width="50" height="50" style="object-fit: cover;">` :
                                `<div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>`
                            }
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">${user.name}</h5>
                            <p class="mb-0 text-muted">${user.role === 'prestataire' ? 'Prestataire' : 'Client'}${user.category ? ' - ' + user.category : ''}</p>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearSelection()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        selectedUserDiv.style.display = 'block';
        userSearch.style.display = 'none';
    }

    // Suggestions de messages
    suggestionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.dataset.text;
            contentTextarea.value = text;
            contentTextarea.dispatchEvent(new Event('input'));
            contentTextarea.focus();
        });
    });

    // Fonction globale pour effacer la sélection
    window.clearSelection = function() {
        selectedReceiverId.value = '';
        userSearch.value = '';
        userSearch.style.display = 'block';
        selectedUserDiv.style.display = 'none';
        searchResults.style.display = 'none';
    };
});
</script>
@endsection
