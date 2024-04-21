<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address_line_1' => fake()->buildingNumber().' '.fake()->streetName(),
            'address_line_2' => fake()->lastName().fake()->randomElement([' House', ' Court', ' Place']),
            'town' => fake()->city(),
            'city' => fake()->city(),
            'postcode' => fake()->postcode(),
        ];
    }
}
