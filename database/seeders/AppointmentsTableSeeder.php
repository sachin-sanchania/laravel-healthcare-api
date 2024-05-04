<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $appointments = [];

        for ($i = 0; $i < 10; $i++) {
            $start_time = $faker->dateTimeBetween('now', '+1 month');
            $end_time = (clone $start_time)->modify('+1 hour');

            $appointments[] = [
                'user_id' => $faker->numberBetween(1, 5),
                'healthcare_professional_id' => $faker->numberBetween(1, 5),
                'appointment_start_time' => $start_time,
                'appointment_end_time' => $end_time,
                'status' => $faker->randomElement(['booked', 'completed', 'cancelled']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Appointment::insert($appointments);

    }
}
