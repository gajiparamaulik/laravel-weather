<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\UserCity;
use Illuminate\Support\Facades\Auth;
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

            $ip = config('define.ip');
            $curLocation = Location::get($ip);
            
            array_push($selectedCity ,$curLocation->cityName);
            $country = Country::select('id', 'name')->get();
            
            return view('home', compact('country', 'selectedCity', 'indiaCity', 'curLocation'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage());
        }
    }
}
