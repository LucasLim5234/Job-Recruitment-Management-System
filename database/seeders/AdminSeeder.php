<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'user_id' => 1,
                'department' => 'Marketing',
                'position' => 'Digital Marketing Manager',
                'company_name' => 'GreenEarth Solutions',
                'company_location' => '123 Green Lane, Los Angeles, CA, USA',
                'company_detail' => 'GreenEarth Solutions is a leading environmental consultancy firm that helps businesses reduce their carbon footprint and optimize energy consumption through innovative technologies and services.',
                'company_main_business' => 'Information Technology',
                'company_website' => 'https://www.upm.edu.my/',
            ],
            [
                'user_id' => 2,
                'department' => 'Research & Development',
                'position' => 'Biotech Research Scientist',
                'company_name' => 'BioTech Innovations',
                'company_location' => '789 Health Avenue, San Francisco, CA, USA',
                'company_detail' => 'BioTech Innovations is a cutting-edge biotechnology company specializing in gene therapy and drug development for the treatment of genetic disorders. The company invests heavily in research and development to bring breakthrough treatments to market.',
                'company_main_business' => 'Healthcare',
                'company_website' => 'https://www.utm.my/',
            ],
            [
                'user_id' => 3,
                'department' => 'Engineering',
                'position' => 'Senior Mechanical Engineer',
                'company_name' => 'Apex Manufacturing Ltd.',
                'company_location' => '456 Industrial Park, New York, USA',
                'company_detail' => 'Apex Manufacturing specializes in the design and production of precision mechanical components for the aerospace and automotive industries. The company focuses on providing innovative solutions and high-quality products.',
                'company_main_business' => 'Construction',
                'company_website' => 'https://www.um.edu.my/',
            ],
            [
                'user_id' => 4,
                'department' => 'IT Services',
                'position' => 'Cloud Solutions Architect',
                'company_name' => 'TechWave Solutions',
                'company_location' => '12 Silicon Valley Road, Mountain View, CA, USA',
                'company_detail' => 'TechWave Solutions is a global IT services company providing cloud computing, big data analytics, and AI-driven solutions to businesses of all sizes. The company aims to empower organizations to transform their operations through technology.',
                'company_main_business' => 'Information Technology',
                'company_website' => 'https://www.usm.my/en/',
            ],
            [
                'user_id' => 5,
                'department' => 'Finance',
                'position' => 'Financial Analyst',
                'company_name' => 'Global Finance Group',
                'company_location' => '102 Market Street, London, UK',
                'company_detail' => 'Global Finance Group is a multinational financial services company offering investment banking, asset management, and financial consulting to both individuals and corporations worldwide. They specialize in emerging markets and high-risk investments.',
                'company_main_business' => 'Finance',
                'company_website' => 'https://www.ukm.my/portalukm/',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
