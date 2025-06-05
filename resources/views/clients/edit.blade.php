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
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
    color: white;
    font-weight: 600;
    font-size: 1.2rem;
    padding: 25px 30px;
    border-bottom: none;
    position: relative;
    overflow: hidden;
}

.card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.3;
}

.card-body {
    padding: 30px;
}

.form-section {
    background: linear-gradient(135deg, rgba(45, 212, 191, 0.03) 0%, rgba(245, 158, 11, 0.03) 100%);
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 4px solid var(--primary);
}

.section-title {
    color: var(--dark);
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.section-title::before {
    content: '';
    width: 8px;
    height: 8px;
    background: var(--primary);
    border-radius: 50%;
    margin-right: 10px;
}

.mb-3 {
    margin-bottom: 1.5rem;
}

.mt-2 {
    margin-top: 0.5rem;
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
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #fafafa;
    color: var(--dark);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    background-color: white;
    box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.1);
    transform: translateY(-1px);
}

.form-control.is-invalid {
    border-color: var(--danger);
    background-color: #fef2f2;
}

.invalid-feedback {
    color: var(--danger);
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

.form-text {
    color: var(--gray);
    font-size: 0.875rem;
    margin-top: 5px;
    padding: 8px 12px;
    background: rgba(45, 212, 191, 0.05);
    border-radius: 8px;
    border-left: 3px solid var(--primary);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

.photo-preview {
    margin-top: 15px;
    text-align: center;
}

.img-thumbnail {
    border: 3px solid;
    border-image: linear-gradient(135deg, var(--primary), var(--secondary)) 1;
    border-radius: 12px;
    padding: 8px;
    background: white;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.img-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow);
}

.btn {
    display: inline-block;
    padding: 14px 28px;
    font-size: 1rem;
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

.d-grid {
    display: grid;
}

.gap-2 {
    gap: 15px;
}

.file-input-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-input-wrapper input[type=file] {
    position: absolute;
    left: -9999px;
}

.file-input-label {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    border: 2px dashed #e2e8f0;
    border-radius: 10px;
    background-color: #fafafa;
    cursor: pointer;
    transition: all 0.3s ease;
    color: var(--gray);
}

.file-input-label:hover {
    border-color: var(--primary);
    background-color: rgba(45, 212, 191, 0.05);
    color: var(--primary);
}

.file-input-label::before {
    content: '👤';
    margin-right: 10px;
    font-size: 1.2rem;
}

.profile-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 50%;
    color: white;
    font-size: 1.2rem;
    margin-bottom: 15px;
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

    .form-section {
        padding: 20px;
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

.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
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
                    <div class="profile-icon">👤</div>
                    Modifier mon profil client
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('client.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Section Informations personnelles -->
                        <div class="form-section animate-fade-in delay-100">
                            <div class="section-title">Informations personnelles</div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Votre nom complet">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+33 6 12 34 56 78">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $user->address) }}" placeholder="Votre ville ou adresse complète">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Section Préférences -->
                        <div class="form-section animate-fade-in delay-200">
                            <div class="section-title">Préférences et besoins</div>
                            
                            <div class="mb-3">
                                <label for="preferences" class="form-label">Préférences de services</label>
                                <textarea class="form-control @error('preferences') is-invalid @enderror" id="preferences" name="preferences" rows="4" placeholder="Décrivez vos préférences concernant les services que vous recherchez...">{{ old('preferences', $profile->preferences) }}</textarea>
                                <div class="form-text">Indiquez vos préférences concernant les services que vous recherchez (budget, délais, style, etc.).</div>
                                @error('preferences')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Section Photo de profil -->
                        <div class="form-section animate-fade-in delay-300">
                            <div class="section-title">Photo de profil</div>
                            
                            <div class="mb-3">
                                <label for="photo" class="form-label">Choisir une photo</label>
                                <div class="file-input-wrapper">
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                                    <label for="photo" class="file-input-label">
                                        Choisir une photo de profil
                                    </label>
                                </div>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($profile->photo)
                                    <div class="photo-preview mt-2">
                                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="Photo de profil actuelle" class="img-thumbnail" style="max-width: 150px;">
                                        <p class="text-muted mt-2">Photo actuelle</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="d-grid gap-2 animate-fade-in delay-400">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <a href="{{ route('client.profile') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Amélioration de l'input file
document.getElementById('photo').addEventListener('change', function(e) {
    const label = document.querySelector('.file-input-label');
    const fileName = e.target.files[0]?.name;
    
    if (fileName) {
        label.innerHTML = `📷 ${fileName}`;
        label.style.color = 'var(--primary)';
        label.style.borderColor = 'var(--primary)';
        label.style.backgroundColor = 'rgba(45, 212, 191, 0.1)';
    } else {
        label.innerHTML = '👤 Choisir une photo de profil';
        label.style.color = 'var(--gray)';
        label.style.borderColor = '#e2e8f0';
        label.style.backgroundColor = '#fafafa';
    }
});

// Validation en temps réel
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('input', function() {
        if (this.classList.contains('is-invalid')) {
            this.classList.remove('is-invalid');
        }
        
        // Effet visuel pour les champs remplis
        if (this.value.trim()) {
            this.style.borderColor = 'var(--primary)';
            this.style.backgroundColor = 'rgba(45, 212, 191, 0.05)';
        } else {
            this.style.borderColor = '#e2e8f0';
            this.style.backgroundColor = '#fafafa';
        }
    });
    
    // État initial
    if (input.value.trim()) {
        input.style.borderColor = 'var(--primary)';
        input.style.backgroundColor = 'rgba(45, 212, 191, 0.05)';
    }
});

// Animation du formulaire lors de la soumission
document.querySelector('form').addEventListener('submit', function() {
    const submitBtn = this.querySelector('.btn-primary');
    submitBtn.innerHTML = '⏳ Enregistrement...';
    submitBtn.style.opacity = '0.7';
    submitBtn.disabled = true;
});

// Compteur de caractères pour les préférences
const preferencesTextarea = document.getElementById('preferences');
const maxLength = 500;

preferencesTextarea.addEventListener('input', function() {
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;
    
    // Créer ou mettre à jour le compteur
    let counter = this.parentNode.querySelector('.char-counter');
    if (!counter) {
        counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = `
            font-size: 0.8rem;
            color: var(--gray);
            text-align: right;
            margin-top: 5px;
        `;
        this.parentNode.appendChild(counter);
    }
    
    counter.textContent = `${currentLength} caractères`;
    
    if (remaining < 50) {
        counter.style.color = 'var(--warning)';
    } else {
        counter.style.color = 'var(--gray)';
    }
});
</script>
@endsection