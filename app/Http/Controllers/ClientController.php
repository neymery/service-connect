<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateClientProfileRequest;
use App\Models\ClientProfile;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user->isClient()) {
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        $profile = $user->profile;
        
        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ClientProfile::create([
                'user_id' => $user->id
            ]);
        }
        
        return view('clients.edit', compact('user', 'profile'));
    }

    public function update(UpdateClientProfileRequest $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ClientProfile::create([
                'user_id' => $user->id
            ]);
        }

        // Mettre à jour les informations utilisateur
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Gérer l'upload de photo
        $photoPath = $profile->photo;
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo
            $this->imageUploadService->deleteImage($photoPath);
            
            // Uploader la nouvelle photo
            $photoPath = $this->imageUploadService->uploadAndResize(
                $request->file('photo'),
                'client-photos',
                300,
                300
            );
        }

        // Mettre à jour le profil
        $profile->update([
            'photo' => $photoPath,
            'preferences' => $request->preferences,
        ]);

        return redirect()->route('client.profile')->with('success', 'Profil mis à jour avec succès');
    }

    public function profile()
    {
        $user = Auth::user();
        if (!$user->isClient()) {
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        $profile = $user->profile;
        
        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ClientProfile::create([
                'user_id' => $user->id
            ]);
        }
        
        return view('clients.profile', compact('user', 'profile'));
    }
}
