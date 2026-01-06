<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'admin_id' => 1,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
            [
                'admin_id' => 2,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
            [
                'admin_id' => 3,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
            [
                'admin_id' => 1,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
            [
                'admin_id' => 4,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
            [
                'admin_id' => 1,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
            [
                'admin_id' => 5,
                'location' => fake()->city(),
                'position' => fake()->jobTitle(),
                'mode' => fake()->randomElement(['Full Time', 'Part Time']),
                'salary' => fake()->numberBetween(2000, 5000) . ' - ' . fake()->numberBetween(5001, 8000),
                'description' => fake()->paragraphs(3, true),
                'responsibility' => fake()->paragraphs(4, true),
                'benefit' => fake()->paragraphs(5, true),
            ],
        ];
        foreach ($jobs as $job) {
            $job = Job::create($job);
            $requirements = [
                'PHP',
                'Bootstrap',
                'Strong communication skills',
            ];

            $weights = [60, 30, 10];

            foreach ($requirements as $index => $requirement) {
                $job->jobRequirements()->create([
                    'description' => $requirement,
                    'weight' => $weights[$index],
                ]);
            };
        }
    }
}
