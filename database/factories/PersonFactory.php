<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'document_number' => fake()->unique()->cpf(false),
            'birth' => fake()->date(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumberCleared,
            'address_id' => Address::factory(),
        ];
    }
}
