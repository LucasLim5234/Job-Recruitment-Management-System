<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'admin_id' => 1,
            'location' => fake()->city(),
            'position' => fake()->jobTitle(),
            'mode' => fake()->randomElement(['Full Time', 'Part Time']),
            'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
            'description' => fake()->paragraphs(3, true),
            'responsibility' => fake()->paragraphs(4, true),
            'benefit' => fake()->paragraphs(5, true),
        ];
    }
}
