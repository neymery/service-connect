@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary: #2dd4bf; /* Changement ici */
        --primary-hover: #1da89a; /* Changement ici */
        --secondary: #f97316;
        --dark: #1e293b;
        --light: #f8fafc;
        --gray: #64748b;
        --gray-light: #f1f5f9;
        --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f6f9fc 0%, #eef2ff 100%);
        min-height: 100vh;
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%234f46e5' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
        z-index: -1;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    .login-wrapper {
        width: 100%;
        max-width: 900px;
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: slideUp 0.8s ease-out;
    }

    .login-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }

    .login-form-section {
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-visual-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .login-visual-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .login-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 10px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .login-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        transform: translateY(-1px);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        accent-color: var(--primary);
    }

    .form-check-label {
        color: var(--gray);
        font-size: 0.95rem;
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        padding: 15px 30px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        text-align: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
        color: white;
        box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25);
        width: 100%;
        margin-bottom: 20px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(79, 70, 229, 0.3);
    }

    .btn-link {
        background: none;
        color: var(--primary);
        padding: 10px 0;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .btn-link:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .visual-content {
        text-align: center;
        color: white;
        position: relative;
        z-index: 1;
        padding: 40px;
    }

    .visual-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 3s ease-in-out infinite;
    }

    .visual-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .visual-text {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.6;
    }

    .divider {
        text-align: center;
        margin: 30px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e2e8f0;
    }

    .divider span {
        background: white;
        padding: 0 20px;
        color: var(--gray);
        font-size: 0.9rem;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @media (max-width: 768px) {
        .login-content {
            grid-template-columns: 1fr;
        }

        .login-visual-section {
            display: none;
        }

        .login-form-section {
            padding: 40px 30px;
        }

        .login-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .login-form-section {
            padding: 30px 20px;
        }

        .login-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-wrapper">
        <div class="login-content">
            <!-- Section formulaire -->
            <div class="login-form-section">
                <div class="login-header">
                    <h1 class="login-title">Connexion</h1>
                    <p class="login-subtitle">Accédez à votre espace personnel</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Adresse e-mail') }}</label>
                        <input id="email" 
                               type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               placeholder="votre@email.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                        <input id="password" 
                               type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="••••••••">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="remember" 
                               id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Se connecter') }}
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="btn-link" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        </div>
                    @endif

                    <div class="divider">
                        <span>Pas encore de compte ?</span>
                    </div>

                    @if (Route::has('register'))
                        <div class="text-center">
                            <a href="{{ route('register') }}" class="btn-link">
                                Créer un compte gratuitement
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Section visuelle -->
            <div class="login-visual-section">
                <div class="visual-content">
                    <div class="visual-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10,17 15,12 10,7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                    </div>
                    <h2 class="visual-title">Bon retour !</h2>
                    <p class="visual-text">
                        Connectez-vous pour accéder à votre tableau de bord et gérer vos projets avec nos prestataires qualifiés.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation des champs de formulaire
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Validation en temps réel
    document.getElementById('email').addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (this.value && !emailRegex.test(this.value)) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });

    // Animation du bouton de soumission
    document.querySelector('form').addEventListener('submit', function() {
        const submitBtn = this.querySelector('.btn-primary');
        submitBtn.innerHTML = '<span>Connexion en cours...</span>';
        submitBtn.style.opacity = '0.7';
    });
</script>
@endsection