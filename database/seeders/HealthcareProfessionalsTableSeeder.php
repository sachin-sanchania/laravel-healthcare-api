<?php

namespace Database\Seeders;

use App\Models\HealthcareProfessional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class HealthcareProfessionalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        HealthcareProfessional::truncate();
        Schema::enableForeignKeyConstraints();

        $professionals = [
            [
                'name' => 'Dr. Smith',
                'speciality' => 'Cardiology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Johnson',
                'speciality' => 'Pediatrics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Williams',
                'speciality' => 'Dermatology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Brown',
                'speciality' => 'Orthopedics',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Lee',
                'speciality' => 'Neurology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        HealthcareProfessional::insert($professionals);
    }
}
