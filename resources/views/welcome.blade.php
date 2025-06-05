<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .hero {
            background-color: #f8f9fa;
            padding: 100px 0;
        }
        .features {
            padding: 80px 0;
        }
        .feature-box {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            height: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Tableau de bord</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 fw-bold">Trouvez le prestataire idéal pour vos besoins</h1>
                    <p class="lead">Notre plateforme met en relation les clients avec des prestataires de services qualifiés dans différentes catégories.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">S'inscrire</a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Se connecter</a>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="https://via.placeholder.com/500x300" alt="Services" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="text-center mb-5">Nos services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>Trouvez des professionnels</h3>
                        <p>Accédez à une large gamme de prestataires qualifiés dans différentes catégories.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>Communication directe</h3>
                        <p>Échangez directement avec les prestataires pour discuter de vos besoins.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h3>Évaluations et avis</h3>
                        <p>Consultez les évaluations des autres clients pour faire le meilleur choix.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
