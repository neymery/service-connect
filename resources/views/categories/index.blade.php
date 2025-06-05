@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Catégories de services</h1>
    
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas {{ $category->icon }} fa-3x mb-3"></i>
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Voir les prestataires</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
