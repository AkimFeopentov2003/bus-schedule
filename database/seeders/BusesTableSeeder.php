<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusesTableSeeder extends Seeder
{
    public function run()
    {
        Bus::insert([
            ['name' => 'Автобус No11', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Автобус No21', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Автобус No33', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Автобус No44', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Автобус No55', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
