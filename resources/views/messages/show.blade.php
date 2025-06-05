@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        @if($message->sender_id === Auth::id())
                            <span>Message envoyé à {{ $message->receiver->name }}</span>
                        @else
                            <span>Message reçu de {{ $message->sender->name }}</span>
                        @endif
                    </div>
                    <small>{{ $message->created_at->format('d/m/Y H:i') }}</small>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <p>{{ $message->content }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div>
                            @if($message->receiver_id === Auth::id())
                                <a href="{{ route('messages.reply', $message->id) }}" class="btn btn-primary">Répondre</a>
                            @endif
                        </div>
                        <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">Retour aux messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
