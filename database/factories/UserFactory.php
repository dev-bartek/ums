<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->name();
        $email = Str::replace(
            search: ' ',
            replace: '.',
            subject: Str::lower($name).'@ums.test'
        );

        return [
            'name' => $name,
            'email' => $email,
        ];
    }
}
