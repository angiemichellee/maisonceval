<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * The shop's catalogs. To add one (e.g. Halloween), add an entry here,
     * add its products in MenuSeeder with 'catalog' => 'halloween',
     * and run: php artisan db:seed
     */
    public function run(): void
    {
        $catalogs = [
            [
                'name' => 'Everyday Menu',
                'slug' => 'everyday',
                'tagline' => 'Our signature cheesecakes, tarts and little treats, all year round.',
                'description' => 'The Maison Céval classics: Basque burnt cheesecakes, buttery pie tarts and little treats, baked to order every day.',
                'image' => 'images/products/iceberg-cheesecake.jpg',
                'color' => '#64501B',
                'is_seasonal' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Christmas Collection',
                'slug' => 'christmas',
                'tagline' => 'Holiday editions with a Merry Christmas topper, greeting card and ribbon.',
                'description' => 'Our most-loved cheesecakes and gift cups, dressed for the holidays. A little elegance for every table, and the easiest gift to give.',
                'image' => 'images/products/xmas-matcha-cheesecake.jpg',
                'color' => '#6B1C1A',
                'is_seasonal' => true,
                'sort_order' => 2,
            ],
            // Example for later:
            // [
            //     'name' => 'Halloween Collection',
            //     'slug' => 'halloween',
            //     'tagline' => 'Spooky-sweet treats for the season.',
            //     'image' => 'images/products/halloween-cover.jpg',
            //     'color' => '#B4541A',
            //     'is_seasonal' => true,
            //     'sort_order' => 3,
            // ],
        ];

        foreach ($catalogs as $catalog) {
            Catalog::updateOrCreate(['slug' => $catalog['slug']], $catalog + ['is_active' => true]);
        }
    }
}
