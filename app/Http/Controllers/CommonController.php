<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;

class CommonController extends Controller
{
    public function welcomeData()
    {
        $ip = config('define.ip');
        $location = Location::get($ip);
        $weatherApi = config('define.weather_api_key');
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q='. $location->cityName .'&appid=' . $weatherApi);
        $location = $response->json();
        return view('welcome', compact('location'));
    }
}
