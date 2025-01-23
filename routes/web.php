<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\BusController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/find-bus', function () {
    return view('find-bus');
});
//Route::get('/find-bus', [BusController::class, 'findBus']);
