<?php

namespace Database\Seeders;

use App\Models\ClientProfile;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Créer un client de démonstration
        $client = User::create([
            'name' => 'Client Demo',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
            'phone' => '0123456789',
            'address' => '123 Rue Client, Ville',
        ]);

        ClientProfile::create([
            'user_id' => $client->id,
        ]);

        // Créer quelques prestataires de démonstration
        $categories = [1, 2, 3, 4, 5]; // IDs des catégories créées par CategorySeeder

        foreach ($categories as $index => $categoryId) {
            $provider = User::create([
                'name' => 'Prestataire ' . ($index + 1),
                'email' => 'provider' . ($index + 1) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'prestataire',
                'phone' => '098765432' . $index,
                'address' => ($index + 1) . '45 Rue Prestataire, Ville',
            ]);

            ProviderProfile::create([
                'user_id' => $provider->id,
                'category_id' => $categoryId,
                'bio' => 'Prestataire professionnel avec plusieurs années d\'expérience.',
                'is_available' => true,
                'experience' => rand(1, 10) . ' ans',
            ]);
        }
    }
}
