<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Insert the product categories into the categories table.
     *
     *   php artisan db:seed --class=CategorySeeder
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Cheesecakes',
            'slug' => 'cheesecakes',
            'description' => 'Basque-style burnt cheesecakes: caramelised outside, impossibly creamy inside.',
        ]);

        Category::create([
            'name' => 'Tarts',
            'slug' => 'tarts',
            'description' => 'Buttery pie crusts filled with silky cream cheese and seasonal toppings.',
        ]);

        Category::create([
            'name' => 'Little Treats',
            'slug' => 'little-treats',
            'description' => 'Single portions, cups and cookies for gifting or a sweet moment for yourself.',
        ]);
    }
}
