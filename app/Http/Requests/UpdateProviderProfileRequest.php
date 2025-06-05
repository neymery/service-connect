<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProviderProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isProvider();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20|regex:/^[0-9\s\-\+$$$$]+$/',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'is_available' => 'boolean',
            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:2048', // 2MB max
                'dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000'
            ],
            'experience' => 'nullable|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'phone.regex' => 'Le format du numéro de téléphone n\'est pas valide.',
            'bio.max' => 'La biographie ne peut pas dépasser 1000 caractères.',
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WebP.',
            'photo.max' => 'L\'image ne peut pas dépasser 2 MB.',
            'photo.dimensions' => 'L\'image doit avoir une taille comprise entre 100x100 et 2000x2000 pixels.',
            'experience.max' => 'L\'expérience ne peut pas dépasser 100 caractères.',
        ];
    }
}
