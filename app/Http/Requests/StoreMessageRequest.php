<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class StoreMessageRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'receiver_id' => [
                'required',
                'exists:users,id',
                'different:' . auth()->id(),
                function ($attribute, $value, $fail) {
                    $receiver = User::find($value);
                    if (!$receiver) {
                        $fail('Le destinataire sélectionné n\'existe pas.');
                        return;
                    }
                    
                    $user = auth()->user();
                    
                    // Vérifier les règles métier
                    if ($user->isClient() && $receiver->role !== 'prestataire') {
                        $fail('Un client ne peut envoyer des messages qu\'aux prestataires.');
                    }
                    
                    if ($user->isProvider() && $receiver->role !== 'client') {
                        $fail('Un prestataire ne peut envoyer des messages qu\'aux clients.');
                    }
                    
                    // Vérifier que le prestataire est disponible (optionnel)
                    if ($receiver->role === 'prestataire' && $receiver->profile && !$receiver->profile->is_available) {
                        // Avertissement mais pas d'erreur bloquante
                    }
                }
            ],
            'content' => [
                'required',
                'string',
                'min:1',
                'max:1000',
                function ($attribute, $value, $fail) {
                    // Vérifier le contenu pour éviter le spam
                    $content = trim($value);
                    
                    // Vérifier les caractères répétitifs
                    if (preg_match('/(.)\1{10,}/', $content)) {
                        $fail('Le message contient trop de caractères répétitifs.');
                    }
                    
                    // Vérifier les liens suspects (basique)
                    if (preg_match('/https?:\/\/[^\s]+/i', $content)) {
                        // Permettre mais logger pour surveillance
                        \Log::info('Message avec lien envoyé', [
                            'user_id' => auth()->id(),
                            'content' => $content
                        ]);
                    }
                }
            ],
        ];
    }

    public function messages()
    {
        return [
            'receiver_id.required' => 'Veuillez sélectionner un destinataire.',
            'receiver_id.exists' => 'Le destinataire sélectionné n\'existe pas.',
            'receiver_id.different' => 'Vous ne pouvez pas vous envoyer un message à vous-même.',
            'content.required' => 'Le message ne peut pas être vide.',
            'content.min' => 'Le message doit contenir au moins 1 caractère.',
            'content.max' => 'Le message ne peut pas dépasser 1000 caractères.',
        ];
    }

    protected function prepareForValidation()
    {
        // Nettoyer le contenu du message
        if ($this->has('content')) {
            $this->merge([
                'content' => trim($this->input('content'))
            ]);
        }
    }
}
