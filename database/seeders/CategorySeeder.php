<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Plombier',
                'description' => 'Services de plomberie et réparations',
                'icon' => 'fa-wrench',
            ],
            [
                'name' => 'Électricien',
                'description' => 'Services d\'électricité et installations',
                'icon' => 'fa-bolt',
            ],
            [
                'name' => 'Coiffeur',
                'description' => 'Services de coiffure à domicile',
                'icon' => 'fa-cut',
            ],
            [
                'name' => 'Jardinier',
                'description' => 'Entretien de jardins et espaces verts',
                'icon' => 'fa-leaf',
            ],
            [
                'name' => 'Peintre',
                'description' => 'Services de peinture intérieure et extérieure',
                'icon' => 'fa-paint-brush',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
