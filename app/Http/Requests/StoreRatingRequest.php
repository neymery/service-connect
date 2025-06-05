<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRatingRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() && auth()->user()->isClient();
    }

    public function rules()
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => 'Veuillez sélectionner une note.',
            'rating.min' => 'La note doit être comprise entre 1 et 5.',
            'rating.max' => 'La note doit être comprise entre 1 et 5.',
            'comment.max' => 'Le commentaire ne peut pas dépasser 500 caractères.',
        ];
    }
}
