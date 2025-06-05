@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Message original</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>De: {{ $originalMessage->sender->name }}</strong>
                        </div>
                        <small>{{ $originalMessage->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <p>{{ $originalMessage->content }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Répondre</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                        <div class="mb-3">
                            <label for="content" class="form-label">Votre réponse</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
