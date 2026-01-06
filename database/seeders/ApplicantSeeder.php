<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Applicant::create([
            'user_id' => 6,
            'phone_number' => '010-1010101',
            'gender' => 'Female',
            'country' => 'Malaysia',
            'city' => 'Sarawak',
            'educations' => 'Bachelor of Electrical & Electronic Engineering with Honours',
            'industry' => 'E & E',
            'current_position' => 'Fresh Graduate',
            'experiences' => 'None',
            'skills' => 'Good communication skills',
        ]);
    }
}
