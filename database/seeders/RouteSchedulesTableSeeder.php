<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RouteSchedule;

class RouteSchedulesTableSeeder extends Seeder
{
    public function run()
    {
        RouteSchedule::insert([
            // Рейс No11 прямой
            ['route_id' => 1, 'departure_time' => '08:00:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 1, 'departure_time' => '08:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 1, 'departure_time' => '09:00:00', 'created_at' => now(), 'updated_at' => now()],

            // Рейс No11 обратный
            ['route_id' => 2, 'departure_time' => '08:15:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 2, 'departure_time' => '08:45:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 2, 'departure_time' => '09:15:00', 'created_at' => now(), 'updated_at' => now()],

            // Рейс No21 прямой
            ['route_id' => 3, 'departure_time' => '07:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 3, 'departure_time' => '08:30:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 3, 'departure_time' => '09:30:00', 'created_at' => now(), 'updated_at' => now()],

            // Рейс No33 прямой
            ['route_id' => 4, 'departure_time' => '06:45:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 4, 'departure_time' => '07:45:00', 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 4, 'departure_time' => '08:45:00', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
