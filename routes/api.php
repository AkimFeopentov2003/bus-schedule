<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/find-bus', [BusController::class, 'showFindBus']);

Route::post('/find-bus', function () {
    return response()->json(['message' => 'Bus route found']);
});
