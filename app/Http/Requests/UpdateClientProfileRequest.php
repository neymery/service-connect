<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isClient();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20|regex:/^[0-9\s\-\+$$$$]+$/',
            'address' => 'nullable|string|max:255',
            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048', // 2MB max
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
            ],
            'preferences' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'phone.regex' => 'Le format du numéro de téléphone n\'est pas valide.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WebP.',
            'photo.max' => 'L\'image ne peut pas dépasser 2 MB.',
            'photo.dimensions' => 'L\'image doit avoir une taille comprise entre 100x100 et 2000x2000 pixels.',
            'preferences.max' => 'Les préférences ne peuvent pas dépasser 500 caractères.',
        ];
    }
}
