<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RouteStop;

class RouteStopsTableSeeder extends Seeder
{
    public function run()
    {
        RouteStop::insert([
            // Рейс No11 прямой
            ['route_id' => 1, 'stop_id' => 1, 'stop_order' => 1, 'travel_time' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 1, 'stop_id' => 2, 'stop_order' => 2, 'travel_time' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 1, 'stop_id' => 3, 'stop_order' => 3, 'travel_time' => 20, 'created_at' => now(), 'updated_at' => now()],

            // Рейс No11 обратный
            ['route_id' => 2, 'stop_id' => 3, 'stop_order' => 1, 'travel_time' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 2, 'stop_id' => 2, 'stop_order' => 2, 'travel_time' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 2, 'stop_id' => 1, 'stop_order' => 3, 'travel_time' => 20, 'created_at' => now(), 'updated_at' => now()],

            // Рейс No21 прямой
            ['route_id' => 3, 'stop_id' => 4, 'stop_order' => 1, 'travel_time' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 3, 'stop_id' => 5, 'stop_order' => 2, 'travel_time' => 15, 'created_at' => now(), 'updated_at' => now()],

            // Рейс No33 прямой
            ['route_id' => 4, 'stop_id' => 6, 'stop_order' => 1, 'travel_time' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 4, 'stop_id' => 7, 'stop_order' => 2, 'travel_time' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['route_id' => 4, 'stop_id' => 8, 'stop_order' => 3, 'travel_time' => 35, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
