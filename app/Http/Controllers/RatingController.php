<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:ratings')->only(['store']);
    }

    public function create($providerId)
    {
        $provider = User::where('role', 'prestataire')->findOrFail($providerId);
        
        // Vérifier si l'utilisateur a déjà noté ce prestataire
        $existingRating = Rating::where('client_id', Auth::id())
            ->where('provider_id', $providerId)
            ->first();
        
        return view('ratings.create', compact('provider', 'existingRating'));
    }

    public function store(StoreRatingRequest $request, $providerId)
    {
        $provider = User::where('role', 'prestataire')->findOrFail($providerId);
        
        // Mettre à jour ou créer une évaluation
        Rating::updateOrCreate(
            [
                'client_id' => Auth::id(),
                'provider_id' => $providerId,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return redirect()->route('providers.show', $providerId)->with('success', 'Évaluation enregistrée avec succès');
    }
}
