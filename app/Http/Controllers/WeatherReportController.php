<?php

namespace App\Http\Controllers;

use App\Models\UserCity;
use Illuminate\Http\Request;

class WeatherReportController extends Controller
{
    public function index()
    {
        $getCityRecord = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
        ->select("cities.id", "cities.name")->distinct()->get();
        
        return view('weather_report', compact('getCityRecord'));
    }
}
