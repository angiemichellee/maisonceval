<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Cheesecakes',
                'slug' => 'cheesecakes',
                'description' => 'Basque-style burnt cheesecakes: caramelised outside, impossibly creamy inside.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Tarts',
                'slug' => 'tarts',
                'description' => 'Buttery pie crusts filled with silky cream cheese and seasonal toppings.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Little Treats',
                'slug' => 'little-treats',
                'description' => 'Single portions, cups and cookies for gifting or a sweet moment for yourself.',
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
