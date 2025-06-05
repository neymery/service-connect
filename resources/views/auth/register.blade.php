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

    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        z-index: 1;
    }

    .register-wrapper {
        width: 100%;
        max-width: 1100px;
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: slideUp 0.8s ease-out;
    }

    .register-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 700px;
    }

    .register-form-section {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow-y: auto;
        max-height: 700px;
    }

    .register-visual-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .register-visual-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.3;
    }

    .register-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 10px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .register-subtitle {
        color: var(--gray);
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        transform: translateY(-1px);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 5px;
        display: block;
    }

    .role-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 25px;
    }

    .role-option {
        position: relative;
        cursor: pointer;
    }

    .role-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .role-card {
        padding: 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
        background: white;
    }

    .role-option input[type="radio"]:checked + .role-card {
        border-color: var(--primary);
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
    }

    .role-icon {
        font-size: 2rem;
        margin-bottom: 10px;
        display: block;
    }

    .role-title {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .role-description {
        font-size: 0.85rem;
        color: var(--gray);
    }

    .provider-fields {
        background: linear-gradient(135deg, rgba(79, 70, 229, 0.05) 0%, rgba(249, 115, 22, 0.05) 100%);
        border-radius: 12px;
        padding: 20px;
        margin: 20px 0;
        border-left: 4px solid var(--primary);
        animation: slideDown 0.3s ease-out;
    }

    .provider-fields.d-none {
        display: none !important;
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
        margin-top: 20px;
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
        margin: 25px 0;
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

    .password-strength {
        margin-top: 8px;
    }

    .strength-bar {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .strength-fill {
        height: 100%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-text {
        font-size: 0.8rem;
        color: var(--gray);
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

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
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
        .register-content {
            grid-template-columns: 1fr;
        }

        .register-visual-section {
            display: none;
        }

        .register-form-section {
            padding: 30px 20px;
        }

        .register-title {
            font-size: 1.8rem;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .role-selector {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="register-container">
    <div class="register-wrapper">
        <div class="register-content">
            <!-- Section formulaire -->
            <div class="register-form-section">
                <div class="register-header">
                    <h1 class="register-title">Créer un compte</h1>
                    <p class="register-subtitle">Rejoignez notre communauté de professionnels</p>
                </div>

                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('Nom complet') }}</label>
                            <input id="name" 
                                   type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus
                                   placeholder="Votre nom complet">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Adresse e-mail') }}</label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email"
                                   placeholder="votre@email.com">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="••••••••">
                            
                            <div class="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-fill" id="strengthFill"></div>
                                </div>
                                <div class="strength-text" id="strengthText">Saisissez un mot de passe</div>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                            <input id="password-confirm" 
                                   type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">{{ __('Type de compte') }}</label>
                        <div class="role-selector">
                            <div class="role-option">
                                <input type="radio" id="client" name="role" value="client" {{ old('role') == 'client' ? 'checked' : '' }} required>
                                <label for="client" class="role-card">
                                    <span class="role-icon">👤</span>
                                    <div class="role-title">Client</div>
                                    <div class="role-description">Je recherche des services</div>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" id="prestataire" name="role" value="prestataire" {{ old('role') == 'prestataire' ? 'checked' : '' }} required>
                                <label for="prestataire" class="role-card">
                                    <span class="role-icon">🛠️</span>
                                    <div class="role-title">Prestataire</div>
                                    <div class="role-description">Je propose mes services</div>
                                </label>
                            </div>
                        </div>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div id="provider-fields" class="provider-fields d-none">
                        <h4 style="color: var(--primary); margin-bottom: 15px; font-size: 1.1rem;">
                            🎯 Informations prestataire
                        </h4>
                        <div class="form-group">
                            <label for="category_id" class="form-label">{{ __('Catégorie de service') }}</label>
                            <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                <option value="">Sélectionnez votre spécialité</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">{{ __('Téléphone') }}</label>
                            <input id="phone" 
                                   type="tel" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   placeholder="+33 6 12 34 56 78">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">{{ __('Ville') }}</label>
                            <input id="address" 
                                   type="text" 
                                   class="form-control @error('address') is-invalid @enderror" 
                                   name="address" 
                                   value="{{ old('address') }}"
                                   placeholder="Votre ville">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Créer mon compte') }}
                    </button>

                    <div class="divider">
                        <span>Déjà un compte ?</span>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn-link">
                            Se connecter
                        </a>
                    </div>
                </form>
            </div>

            <!-- Section visuelle -->
            <div class="register-visual-section">
                <div class="visual-content">
                    <div class="visual-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                    </div>
                    <h2 class="visual-title">Rejoignez-nous !</h2>
                    <p class="visual-text">
                        Créez votre compte et accédez à une communauté de professionnels qualifiés. Que vous soyez client ou prestataire, trouvez les opportunités qui vous correspondent.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleInputs = document.querySelectorAll('input[name="role"]');
        const providerFields = document.getElementById('provider-fields');
        const categorySelect = document.getElementById('category_id');
        const passwordInput = document.getElementById('password');
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        
        // Gestion du changement de rôle
        roleInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'prestataire') {
                    providerFields.classList.remove('d-none');
                    categorySelect.setAttribute('required', 'required');
                } else {
                    providerFields.classList.add('d-none');
                    categorySelect.removeAttribute('required');
                }
            });
        });
        
        // État initial
        const checkedRole = document.querySelector('input[name="role"]:checked');
        if (checkedRole && checkedRole.value === 'prestataire') {
            providerFields.classList.remove('d-none');
            categorySelect.setAttribute('required', 'required');
        }

        // Validation de la force du mot de passe
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let text = '';
            let color = '';

            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            switch (strength) {
                case 0:
                case 1:
                    text = 'Très faible';
                    color = '#ef4444';
                    break;
                case 2:
                    text = 'Faible';
                    color = '#f97316';
                    break;
                case 3:
                    text = 'Moyen';
                    color = '#eab308';
                    break;
                case 4:
                    text = 'Fort';
                    color = '#22c55e';
                    break;
                case 5:
                    text = 'Très fort';
                    color = '#16a34a';
                    break;
            }

            strengthFill.style.width = (strength * 20) + '%';
            strengthFill.style.backgroundColor = color;
            strengthText.textContent = text;
            strengthText.style.color = color;
        });

        // Validation email en temps réel
        document.getElementById('email').addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && !emailRegex.test(this.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Validation confirmation mot de passe
        document.getElementById('password-confirm').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            if (this.value && this.value !== password) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        // Animation du bouton de soumission
        document.getElementById('registerForm').addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.innerHTML = 'Création du compte...';
            submitBtn.style.opacity = '0.7';
        });
    });
</script>
@endsection