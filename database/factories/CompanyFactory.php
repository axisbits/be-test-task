<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'name' => \fake()->company(),
            'email' => \fake()->unique()->safeEmail(),
            'phone' => \fake()->phoneNumber(),
            'address' => \fake()->address(),
            'city' => \fake()->city(),
            'state' => \fake()->randomElement(['CA', 'NY', 'TX', 'FL', 'IL', 'PA', 'OH']),
        ];
    }
}
