<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['name', 'bus_id'];

    public function routeStops()
    {
        return $this->hasMany(RouteStop::class);
    }

    public function schedules()
    {
        return $this->hasMany(RouteSchedule::class);
    }
}
