 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>

        .rating {
            color: #ffc107;
        }
        .unread {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        .message-notification {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Styles pour la navbar */
        .navbar {
            background-color: #2dd4bf !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 0 !important;
        }

        .navbar-brand {
            color: black !important;
            font-weight: 600;
        }

        .nav-link {
            color: black !important;
            font-weight: 500;
            margin: 0 0.5rem !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #14b8a6 !important;
        }

        .dropdown-item {
            color: #2dd4bf !important;
        }

        .dropdown-item:hover {
            background-color: #14b8a6 !important;
            color: white !important;
        }

        .footer {
            background-color: #2dd4bf;
            color: black;
            padding: 40px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg- white shadow-sm p-5"  >
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <!-- {{ config('app.name', 'PrestaConnect') }} -->
            
            <span>PrestaConnect</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('providers.index') }}">Prestataires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('messages.index') }}">
                            Messages
                            <span id="navbar-message-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                                0
                            </span>
                        </a>
                    </li>
                @endauth

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle border border-dark rounded" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown">
                            @if(Auth::user()->isClient())
                                <a class="dropdown-item" href="{{ route('client.profile') }}">
                                    {{ __('Mon profil') }}
                                </a>
                            @else
                                <a class="dropdown-item" href="{{ route('provider.profile') }}">
                                    {{ __('Mon profil') }}
                                </a>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Déconnexion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

        <main class="py-4">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>
            
            @yield('content')
        </main>

    </div>
    <footer class="footer">
        <div class="container ">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @auth
    <script>
        // Actualiser le compteur de messages non lus dans la navbar
        function updateMessageBadge() {
            fetch('{{ route("messages.unread-count") }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('navbar-message-badge');
                    if (data.unread_count > 0) {
                        badge.textContent = data.unread_count;
                        badge.style.display = 'inline';
                        badge.classList.add('message-notification');
                    } else {
                        badge.style.display = 'none';
                        badge.classList.remove('message-notification');
                    }
                })
                .catch(error => console.error('Erreur:', error));
        }

        // Actualiser toutes les 30 secondes
        setInterval(updateMessageBadge, 30000);
        
        // Actualiser au chargement de la page
        document.addEventListener('DOMContentLoaded', updateMessageBadge);
    </script>
    @endauth
</body>
</html>
