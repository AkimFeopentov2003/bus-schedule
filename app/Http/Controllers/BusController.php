<?php

namespace App\Http\Controllers;

use App\Models\Stop;
use App\Models\Bus;
use App\Models\Route;
use App\Models\RouteStop;
use App\Models\RouteSchedule;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Получить все остановки
    public function showFindBus()
    {
        $stops = Stop::all(); // Загрузка всех остановок
        return view('find-bus', ['stops' => $stops]);
    }
    public function getStops()
    {
        $stops = Stop::all();
        return response()->json($stops);
    }

    // Получить все автобусы
    public function getBuses()
    {
        $buses = Bus::all();
        return response()->json($buses);
    }

    // Получить маршруты с остановками
    public function getRoutesWithStops()
    {
        $routes = Route::with('stops')->get();
        return response()->json($routes);
    }

    // Получить расписание для заданного маршрута
    public function getSchedule($routeId)
    {
        $schedules = RouteSchedule::where('route_id', $routeId)->get();
        return response()->json($schedules);
    }

    // Найти маршруты между остановками
    public function findBus(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $routes = RouteStop::where('stop_id', $from)
            ->whereHas('routeStops', function ($query) use ($to) {
                $query->where('stop_id', $to);
            })
            ->with(['route', 'routeStops'])
            ->get();

        return response()->json($routes);
    }
}
