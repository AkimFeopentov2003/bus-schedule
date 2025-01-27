<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/find-bus', [BusController::class, 'showFindBus']);
Route::post('/api/find-bus', [BusController::class, 'findBus']);
Route::post('/api/get-stops', [BusController::class, 'getStops']);

