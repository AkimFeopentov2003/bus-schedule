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
        $from = Stop::where('id', $departureStopId)->value('name');
        $to = Stop::where('id', $arrivalStopId)->value('name');
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
        $currentTime = Carbon::now();
//        $currentTime = Carbon::createFromTime(5, 25);
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
                    'routeId' => $route->id,
                    'route' => $route->name,
                    'next_arrivals' => $nextArrivals->take(3)->values()->toArray(), // Берём только 3 ближайших времени
                    'stops' => [
                        ['id' => $departureStopId, 'name' => $from],
                        ['id' => $arrivalStopId, 'name' => $to],
                    ]
                ];
            }
        }

        return response()->json([
            'fromId' => $departureStopId,
            'toId' => $arrivalStopId,
            'from' => $from,
            'to' => $to,
            'buses' => $buses]);

    }
        public function getStops(Request $request)
    {
        $routeId = $request->input('routeId');
        $stops = $request->input('stops');
        $selectedStopIds = is_array($stops) ? array_column($stops, 'id') : [];
        $fromStopId = $request->input('from');
        $toStopId = $request->input('to');
        $fromStopOrder = RouteStop::where('route_id', $routeId)
            ->where('stop_id', $fromStopId)
            ->value('stop_order');

        $toStopOrder = RouteStop::where('route_id', $routeId)
            ->where('stop_id', $toStopId)
            ->value('stop_order');

        // Получаем все остановки, удовлетворяющие условиям
        $unselectedStops = RouteStop::join('stops', 'route_stops.stop_id', '=', 'stops.id')
            ->where('route_stops.route_id', $routeId)
            ->whereNotIn('route_stops.stop_id', $selectedStopIds)
            ->where('route_stops.stop_order', '>', $fromStopOrder)
            ->where('route_stops.stop_order', '<', $toStopOrder)
            ->orderBy('route_stops.stop_order')
            ->get(['route_stops.stop_id', 'stops.name']);

        return response()->json([
            'stops' => $unselectedStops,
        ]);
    }

    public function addStop(Request $request)
    {
        $routeId = $request->input('routeId');
        $stops = $request->input('stops');
        $selectedStopId = $request->input('selectedStopId');
        if (in_array($selectedStopId, $stops)) {
            return response()->json(['error' => 'selectedStopId found in stops'], 400);
        }
        $routeStop = RouteStop::where('route_id', $routeId)
            ->where('stop_id', $selectedStopId)
            ->first();

        if (!$routeStop) {
            return response()->json(['error' => 'selectedStopId not found in RouteStop for this route'], 404);
        }
        $selectedStopName = Stop::where('id', $selectedStopId)->value('name');
        $newStop = [
            'id' => $selectedStopId,
            'name' => $selectedStopName,
        ];
        $stops[] = $newStop;

        return response()->json([
            'stops' => $stops,
        ]);

    }
}
