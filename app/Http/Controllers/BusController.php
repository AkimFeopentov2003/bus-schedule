<?php

namespace App\Http\Controllers;

use App\Models\Stop;
use App\Models\Bus;
use App\Models\Route;
use App\Models\RouteStop;
use App\Models\RouteSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BusController extends Controller
{
    // Получить все остановки
    public function showFindBus()
    {
        $stops = Stop::all(); // Загрузка всех остановок
        return view('find-bus', ['stops' => $stops]);
    }
    public function findBus(Request $request)
    {
        $departureStopId = $request->input('from');
        $arrivalStopId = $request->input('to');

        // Проверяем, что обе остановки указаны
        if (!$departureStopId || !$arrivalStopId) {
            return response()->json(['error' => 'Укажите обе остановки'], 400);
        }

        // Находим маршруты, проходящие через обе остановки
        $routes = RouteStop::where('stop_id', $departureStopId)
        ->whereHas('route.routeStops', function ($query) use ($arrivalStopId) {
            $query->where('stop_id', $arrivalStopId);
        })
        ->with('route.schedules', 'route')
        ->get();

        // Получаем текущее время
//        $currentTime = Carbon::now();
        $currentTime = Carbon::createFromTime(5, 25);
        $buses = [];


        foreach ($routes as $routeStop) {
            $route = $routeStop->route;
            $departureTime = $routeStop->travel_time;

            $arrivalStop = $route->routeStops->firstWhere('stop_id', $arrivalStopId);
            if ($arrivalStop->stop_order > $routeStop->stop_order) {
                $nextArrivals = $route->schedules
                    ->map(function ($schedule) use ($departureTime) {
                        return Carbon::parse($schedule->departure_time)
                            ->addMinutes($departureTime)
                            ->format('H:i');
                    })
                    ->sort(function ($time1, $time2) use ($currentTime) {
                        // Преобразуем время в объект Carbon для сравнения
                        $carbonTime1 = Carbon::parse($time1);
                        $carbonTime2 = Carbon::parse($time2);

                        // Вычисляем разницу времени
                        $diff1 = $carbonTime1->greaterThanOrEqualTo($currentTime)
                            ? $carbonTime1->diffInMinutes($currentTime)
                            : $carbonTime1->addDay()->diffInMinutes($currentTime);
                        $diff2 = $carbonTime2->greaterThanOrEqualTo($currentTime)
                            ? $carbonTime2->diffInMinutes($currentTime)
                            : $carbonTime2->addDay()->diffInMinutes($currentTime);

                        return $diff1 <=> $diff2;
                    });

                $buses[] = [
                    'route' => $route->name,
                    'next_arrivals' => $nextArrivals->take(3)->values()->toArray(), // Берём только 3 ближайших времени
                ];
            }
        }

        return response()->json(['buses' => $buses]);

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
//    public function findBus(Request $request)
//    {
//        $from = $request->input('from');
//        $to = $request->input('to');
//
//        $routes = RouteStop::where('stop_id', $from)
//            ->whereHas('routeStops', function ($query) use ($to) {
//                $query->where('stop_id', $to);
//            })
//            ->with(['route', 'routeStops'])
//            ->get();
//
//        return response()->json($routes);
//    }
}
