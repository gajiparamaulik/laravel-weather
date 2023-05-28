<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\State;

class ApiController extends Controller
{
    public function getState($id)
    {
        $state = State::select('id', 'name')->where('country_id', $id)->get();
        return response()->json(['success' => true, 'state' => $state]);
    }
    
    public function getCity($id)
    {
        $city = City::select('id', 'name')->where('state_id', $id)->get();
        return response()->json(['success' => true, 'city' => $city]);
    }
}
