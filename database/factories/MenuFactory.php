<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Makes fake products for testing, e.g. in a seeder:
 *   Menu::factory()->count(10)->create();
 * (The real products are in MenuSeeder.)
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'catalog_id' => 1,
            'category_id' => mt_rand(1, 3),
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->unique()->slug(3),
            'price' => $this->faker->numberBetween(30, 210) * 1000,
            'description' => $this->faker->sentence(12),
            'image' => null,
            'variants' => null,
            'includes' => null,
            'is_available' => true,
        ];
    }
}
