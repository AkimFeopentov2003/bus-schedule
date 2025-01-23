<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stop;

class StopsTableSeeder extends Seeder
{
    public function run()
    {
        Stop::insert([
            ['name' => 'ул. Пушкина', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Ленина', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Попова', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Садовая', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Московская', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Центральная', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Куйбышева', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ул. Первомайская', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
