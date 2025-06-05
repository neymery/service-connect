@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $existingRating ? 'Modifier votre évaluation' : 'Évaluer' }} {{ $provider->name }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ratings.store', $provider->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="rating" class="form-label">Note</label>
                            <div class="rating-input">
                                <div class="btn-group" role="group" aria-label="Rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" class="btn-check" name="rating" id="rating{{ $i }}" value="{{ $i }}" {{ (old('rating', $existingRating->rating ?? 0) == $i) ? 'checked' : '' }} required>
                                        <label class="btn btn-outline-warning" for="rating{{ $i }}">{{ $i }}</label>
                                    @endfor
                                </div>
                            </div>
                            @error('rating')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Commentaire</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="4">{{ old('comment', $existingRating->comment ?? '') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">{{ $existingRating ? 'Mettre à jour' : 'Soumettre' }} l'évaluation</button>
                            <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rating-input .btn-group {
        width: 100%;
    }
    
    .rating-input .btn {
        flex: 1;
    }
    
    .btn-check:checked + .btn-outline-warning {
        background-color: #ffc107;
        color: #000;
    }
</style>
@endsection
