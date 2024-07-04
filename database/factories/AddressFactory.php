<?php

namespace Database\Factories;

use App\Enums\State;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetName,
            'city' => fake()->city,
            'state' => fake()->randomElement(State::toArray()),
        ];
    }
}
