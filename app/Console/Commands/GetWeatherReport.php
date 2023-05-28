<?php

namespace App\Console\Commands;

use App\Models\UserCity;
use App\Models\WeatherReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetWeatherReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report-fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getCityRecord = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
        ->select("cities.id", "cities.name")->distinct()->get();

        $collectData = $getCityRecord->pluck('name')->toArray();

        $storeData =[];
        $weatherApi = "a98ec63f8e1c7a4f6ff2b6089294bc77";
        foreach($getCityRecord as $city){
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q='. $city->name .'&appid=' . $weatherApi);
            $temperature = $response->json();
            $tempCity = $getCityRecord->where('name', $city->name)->first();
            $tempCity->response = $temperature;
            $tempCity->temp = $temperature['main']['temp'] - 273.15;
            array_push($storeData,array(
                "city_id" => $city->id,
                "response"  => json_encode($tempCity->response),
                "temp"    => $tempCity->temp
            ));
        }

        WeatherReport::query()->truncate(); 

        WeatherReport::insert($storeData);
    
        return Command::SUCCESS;
    }
}
