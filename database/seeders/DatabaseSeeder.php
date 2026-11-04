<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database: run all seeders together.
     *
     *   php artisan db:seed
     *
     * The order matters: products (MenuSeeder) need the catalogs and categories first.
     */
    public function run(): void
    {
        $this->call([
            CatalogSeeder::class,
            CategorySeeder::class,
            MenuSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
