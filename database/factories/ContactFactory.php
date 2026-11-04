<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Makes fake contact details for testing, e.g. in a seeder:
 *   Contact::factory()->create();
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'instagram' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'phoneNumber' => $this->faker->phoneNumber(),
            'whatsapp' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'opening_hours' => 'Mon–Sat, 09.00–18.00',
        ];
    }
}
