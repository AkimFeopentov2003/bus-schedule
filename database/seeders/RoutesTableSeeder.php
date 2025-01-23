<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;

class RoutesTableSeeder extends Seeder
{
    public function run()
    {
        Route::insert([
            ['name' => 'Рейс No11 до ул. Попова', 'bus_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Рейс No11 до ул. Пушкина', 'bus_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Рейс No21 до ул. Московская', 'bus_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Рейс No33 до ул. Первомайская', 'bus_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Рейс No44 до ул. Центральная', 'bus_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
