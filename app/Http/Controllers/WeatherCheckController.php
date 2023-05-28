<?php

namespace App\Http\Controllers;

use App\Models\UserCity;
use App\Models\WeatherReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

class WeatherCheckController extends Controller
{
    public function index()
    {
        $authId = Auth::user()->id;
        $selectedCity = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
        ->leftJoin('weather_reports', 'weather_reports.city_id', '=', 'user_cities.city_id')
        ->select('user_cities.id', 'user_cities.city_id', 'cities.name', 'user_cities.temp_limit', 'weather_reports.response', 'weather_reports.temp')
        ->where("user_cities.user_id", $authId)->get()->toArray();


        // $selectedCity = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
        // ->select("user_cities.id", "cities.name", "user_cities.temp_limit")
        // ->where("user_cities.user_id", $authId)->get();
        
        // $collectData = $selectedCity->pluck('name')->toArray();
        
        // $ip = '27.4.92.35';
        // $location = Location::get($ip);
        
        // $weatherApi = "a98ec63f8e1c7a4f6ff2b6089294bc77";
        // foreach($collectData as $city){
        //     $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q='. $city .'&appid=' . $weatherApi);
        //     $temperature = $response->json();
        //     $tempCity = $selectedCity->where('name', $city)->first();
        //     $tempCity->report = $temperature;

        // }
        

        
        return view('temp_limit', compact('selectedCity'));
    }

    public function storeTempLimit(Request $request)
    {
        $getLimit = $request->temp;
        
        foreach ($getLimit as $data) {
            $request = UserCity::find($data['id']);
            $request->temp_limit = $data['temp_limit'];
            $request->save();
        }
        return redirect()->back()->with('success', 'Temperature Update Successfully.!');
    }
}
