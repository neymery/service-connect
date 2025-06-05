<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProviderProfileRequest;
use App\Models\Category;
use App\Models\ProviderProfile;
use App\Models\User;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index(Request $request)
    {
        $query = User::where('role', 'prestataire')
            ->join('provider_profiles', 'users.id', '=', 'provider_profiles.user_id')
            ->leftJoin('categories', 'provider_profiles.category_id', '=', 'categories.id')
            ->select('users.*', 'provider_profiles.*', 'categories.name as category_name');

        // Filtres
        if ($request->has('available') && $request->available == 1) {
            $query->where('provider_profiles.is_available', 1);
        }

        if ($request->has('category_id') && $request->category_id) {
            $query->where('provider_profiles.category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('provider_profiles.bio', 'like', "%{$search}%");
            });
        }

        // Pagination avec conservation des paramètres de recherche
        $providers = $query->paginate(12)->appends($request->query());
        $categories = Category::all();

        return view('providers.index', compact('providers', 'categories'));
    }

    public function show($id)
    {
        $provider = User::where('role', 'prestataire')->findOrFail($id);
        $profile = $provider->profile;
        
        if (!$profile) {
            // Créer un profil par défaut si il n'existe pas
            $profile = ProviderProfile::create([
                'user_id' => $provider->id,
                'is_available' => true
            ]);
        }
        
        $ratings = $provider->receivedRatings()->with('client')->paginate(10);
        
        return view('providers.show', compact('provider', 'profile', 'ratings'));
    }

    public function edit()
    {
        $user = Auth::user();
        if (!$user->isProvider()) {
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        $profile = $user->profile;
        
        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ProviderProfile::create([
                'user_id' => $user->id,
                'is_available' => true
            ]);
        }
        
        $categories = Category::all();
        
        return view('providers.edit', compact('user', 'profile', 'categories'));
    }

    public function update(UpdateProviderProfileRequest $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ProviderProfile::create([
                'user_id' => $user->id,
                'is_available' => true
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
                'provider-photos',
                400,
                400
            );
        }

        // Mettre à jour le profil
        $profile->update([
            'bio' => $request->bio,
            'category_id' => $request->category_id,
            'is_available' => $request->has('is_available'),
            'photo' => $photoPath,
            'experience' => $request->experience,
        ]);

        return redirect()->route('provider.profile')->with('success', 'Profil mis à jour avec succès');
    }

    public function profile()
    {
        $user = Auth::user();
        if (!$user->isProvider()) {
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        $profile = $user->profile;
        
        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ProviderProfile::create([
                'user_id' => $user->id,
                'is_available' => true
            ]);
        }
        
        return view('providers.profile', compact('user', 'profile'));
    }

    public function toggleAvailability()
    {
        $user = Auth::user();
        if (!$user->isProvider()) {
            return redirect()->route('home')->with('error', 'Accès non autorisé');
        }

        $profile = $user->profile;
        
        // Créer un profil si il n'existe pas
        if (!$profile) {
            $profile = ProviderProfile::create([
                'user_id' => $user->id,
                'is_available' => true
            ]);
        }
        
        $profile->is_available = !$profile->is_available;
        $profile->save();

        return redirect()->back()->with('success', 'Disponibilité mise à jour');
    }
}
