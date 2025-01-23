<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('route_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade'); // Связь с рейсом
            $table->foreignId('stop_id')->constrained('stops')->onDelete('cascade'); // Связь с остановкой
            $table->integer('stop_order'); // Порядковый номер остановки
            $table->integer('travel_time'); // Время пути от начальной остановки (в минутах)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_stops');
    }
};
