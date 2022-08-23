<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
     public function getCities(string $city) {
        
        $cities = City::where('province_id', $city)->get();
        
        return $cities;

    }
}
