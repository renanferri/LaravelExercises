<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $person = Person::factory()->create();
        
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'whatsapp' => fake()->phoneNumber(),
            'person_id' => $person->id
        ];
    }
}
