<?php

namespace App\Http\Controllers;


use App\Mail\SendMail;
use App\Models\UserCity;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCityController extends Controller
{

    public function storeCity(Request $request)
    {
        $request->validate([
            'city' => 'required',
        ]);

        $authId = Auth::user()->id;
        $cityArr = $request->city;
        $recArr = [];
        foreach($cityArr as $val){
            array_push($recArr, ["user_id" => $authId, "city_id" => $val]);
        }

        $check = UserCity::where("user_id", $authId)->count();
        if($check > 0){
            UserCity::where("user_id", $authId)->delete();
        }
        
            UserCity::insert($recArr);
        
        return redirect()->back()->with('success', 'City Add Successfully.!!');
    }

    public function MailSend()
    {
        $mailData = [
            'title' => 'Mail from Weather App.',
            'body' => 'Weather App Details.'
        ];
         
        Mail::to('maulikaarrsol@gmail.com')->send(new SendMail($mailData));
           
        dd("Weather App Email is sent successfully.");
    }
}
