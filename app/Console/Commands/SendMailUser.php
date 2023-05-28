<?php

namespace App\Console\Commands;

use App\Models\UserCity;
use App\Models\WeatherReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-mail';

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

        $getWeatherData = WeatherReport::leftJoin('cities', 'cities.id', '=', 'weather_reports.city_id')
        ->select('weather_reports.city_id', 'cities.name', 'weather_reports.temp', 'weather_reports.response')->get();
        
        foreach($getWeatherData as $weather){
            
            $getUser = UserCity::leftJoin('cities', 'cities.id', '=', 'user_cities.city_id')
            ->leftJoin('users', 'users.id', '=', 'user_cities.user_id')
            ->select("cities.id", "cities.name", 'users.name', 'users.email')
            ->where('user_cities.city_id',$weather->city_id)
            ->where('user_cities.temp_limit','<=',$weather->temp)
            ->whereNotNull('user_cities.temp_limit')
            ->get();
            $userEmails = $getUser->pluck('email');
            // dd($userEmails);
            $mailData = [
                'title' => $weather->name." city  temprature is more than " .$weather->temp."c",
                'body' => 'current Weather is '
            ];
             
            Mail::to($userEmails)->send(new SendMail($mailData));
            
        }

        return Command::SUCCESS;
    }
}
