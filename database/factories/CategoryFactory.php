<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Makes fake categories for testing, e.g. in a seeder:
 *   Category::factory()->count(3)->create();
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(1),
            'description' => $this->faker->sentence(),
        ];
    }
}
