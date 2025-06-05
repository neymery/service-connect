<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2dd4bf; /* Changement ici */
            --primary-hover: #1da89a; /* Changement ici */
            --secondary: #f97316; /* Reste inchangé */
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #f1f5f9;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
            line-height: 1.6;
            background-color: var(--light);
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: white;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .navbar-brand:hover {
            color: var(--primary-hover);
        }
        
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-toggler {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
        }
        
        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 20px;
        }
        
        .nav-link {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            background-color: var(--gray-light);
            color: var(--primary);
        }
        
        /* Hero Section */
        .hero {
            padding: 100px 0 80px;
            background: linear-gradient(135deg, #f6f9fc 0%, #eef2ff 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%234f46e5' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: fadeIn 1s ease-out;
        }
        
        .hero p {
            font-size: 1.25rem;
            color: var(--gray);
            margin-bottom: 30px;
            max-width: 600px;
            animation: fadeIn 1s ease-out 0.3s both;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(79, 70, 229, 0.3);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--dark);
            border: 2px solid var(--gray-light);
        }
        
        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            animation: fadeIn 1s ease-out 0.6s both;
        }
        
        .hero-image {
            animation: floatIn 1s ease-out 0.9s both;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
            max-width: 100%;
            height: auto;
        }
        
        /* Features Section */
        .features {
            padding: 100px 0;
            background-color: white;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        
        .feature-box {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            z-index: -1;
        }
        
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .feature-box h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .feature-box p {
            color: var(--gray);
            margin-bottom: 0;
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary);
        }
        
        /* Footer */
        .footer {
            background-color: var(--dark);
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        
        /* Animations */
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
        
        @keyframes floatIn {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero-image {
                margin-top: 40px;
            }
        }
        
        @media (max-width: 768px) {
            .navbar-toggler {
                display: block;
            }
            
            .navbar-collapse {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: white;
                padding: 20px;
                box-shadow: var(--shadow);
                display: none;
            }
            
            .navbar-collapse.show {
                display: block;
            }
            
            .navbar-nav {
                flex-direction: column;
                gap: 10px;
            }
            
            .hero {
                padding: 80px 0 60px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .row {
                flex-direction: column;
            }
            
            .col-md-6, .col-md-4 {
                width: 100%;
                margin-bottom: 30px;
            }
        }
        
        /* Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding: 0 15px;
            margin-bottom: 30px;
        }
        
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }
        
        .align-items-center {
            align-items: center;
        }
        
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container navbar-container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!-- {{ config('app.name', 'Laravel') }} -->
                <span>PrestaConnect</span>
            </a>
            <button class="navbar-toggler" type="button" id="navbarToggler">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
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
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>Trouvez le prestataire idéal pour vos besoins</h1>
                    <p>Notre plateforme met en relation les clients avec des prestataires de services qualifiés dans différentes catégories.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                        <a href="{{ route('login') }}" class="btn btn-outline">Se connecter</a>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <svg class="hero-image" width="500" height="300" viewBox="0 0 800 600" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" style="stop-color:#4f46e5;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#f97316;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <rect x="50" y="50" width="700" height="500" rx="20" ry="20" fill="#f8fafc" stroke="#e2e8f0" stroke-width="2"/>
                        <circle cx="400" cy="200" r="80" fill="url(#grad1)" opacity="0.8"/>
                        <rect x="150" y="320" width="500" height="20" rx="10" ry="10" fill="#e2e8f0"/>
                        <rect x="150" y="360" width="400" height="20" rx="10" ry="10" fill="#e2e8f0"/>
                        <rect x="150" y="400" width="300" height="20" rx="10" ry="10" fill="#e2e8f0"/>
                        <rect x="150" y="440" width="200" height="40" rx="10" ry="10" fill="url(#grad1)"/>
                        <circle cx="200" cy="200" r="30" fill="#4f46e5" opacity="0.6"/>
                        <circle cx="600" cy="200" r="30" fill="#f97316" opacity="0.6"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Nos services</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3>Trouvez des professionnels</h3>
                        <p>Accédez à une large gamme de prestataires qualifiés dans différentes catégories.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                        <h3>Communication directe</h3>
                        <p>Échangez directement avec les prestataires pour discuter de vos besoins.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <h3>Évaluations et avis</h3>
                        <p>Consultez les évaluations des autres clients pour faire le meilleur choix.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Toggle mobile menu
        document.getElementById('navbarToggler').addEventListener('click', function() {
            document.getElementById('navbarSupportedContent').classList.toggle('show');
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
                navbar.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.padding = '15px 0';
                navbar.style.boxShadow = '0 1px 3px 0 rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>
</html>