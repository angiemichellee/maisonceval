<?php

namespace Database\Factories;

use App\Models\Catalog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Makes fake catalogs for testing, e.g. in a seeder:
 *   Catalog::factory()->count(3)->create();
 */
class CatalogFactory extends Factory
{
    protected $model = Catalog::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->unique()->slug(2),
            'tagline' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'image' => null,
            'color' => $this->faker->hexColor(),
            'is_seasonal' => $this->faker->boolean(),
            'is_active' => true,
        ];
    }
}
