<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Database\Factories\JobFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ApplicantSeeder::class);
        $this->call(JobRequirementSeeder::class);
    }
}
