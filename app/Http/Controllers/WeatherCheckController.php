<?php

namespace App\Http\Controllers;

use App\Models\UserCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;
class WeatherCheckController extends Controller
{
    public function index()
    {
        try{
            $authId = Auth::user()->id;
            $selectedCity = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
            ->leftJoin('weather_reports', 'weather_reports.city_id', '=', 'user_cities.city_id')
            ->select('user_cities.id', 'user_cities.city_id', 'cities.name', 'user_cities.temp_limit', 'weather_reports.response', 'weather_reports.temp')
            ->where("user_cities.user_id", $authId)
            ->get()->toArray();
          
            return view('temp_limit', compact('selectedCity'));
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage());
        }
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
