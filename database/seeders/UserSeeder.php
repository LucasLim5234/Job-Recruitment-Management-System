<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin1',
                'email' => 'admin1@gmail.com',
                'password' => '123456789',
                'role' => 'Admin',
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'password' => '123456789',
                'role' => 'Admin',
            ],
            [
                'name' => 'Admin3',
                'email' => 'admin3@gmail.com',
                'password' => '123456789',
                'role' => 'Admin',
            ],
            [
                'name' => 'Admin4',
                'email' => 'admin4@gmail.com',
                'password' => '123456789',
                'role' => 'Admin',
            ],
            [
                'name' => 'Admin5',
                'email' => 'admin5@gmail.com',
                'password' => '123456789',
                'role' => 'Admin',
            ],
            [
                'name' => 'Applicant1',
                'email' => 'applicant1@gmail.com',
                'password' => '123456789',
                'role' => 'Applicant',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
