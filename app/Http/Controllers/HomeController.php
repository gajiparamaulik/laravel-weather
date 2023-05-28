<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\UserCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $authId = Auth::user()->id;
            $selectedCity = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
            ->select("cities.name")
            ->where("user_cities.user_id", $authId)->pluck('cities.name')->toArray();

            $indiaCity = City::select('id', 'name')->where('country_id', 101)->get();

            $ip = '27.7.89.10'; // Please Add your IpAddress
            // $ip = \Request::ip();
            $curLocation = Location::get($ip);

            array_push($selectedCity ,$curLocation->cityName);
            $country = Country::select('id', 'name')->get();
            return view('home', compact('country', 'selectedCity', 'indiaCity', 'curLocation'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage());
        }
    }

    public function welcomeData()
    {
        $ip = '27.7.89.10';
        $location = Location::get($ip);
       
        $weatherApi = "a98ec63f8e1c7a4f6ff2b6089294bc77";
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q='. $location->cityName .'&appid=' . $weatherApi);
        $report = $response->json();
        return view('welcome');
    }

}
