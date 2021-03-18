<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function cities($id = false)
    {
        if($id) {
            $city = City::find($id);
            return response()->json([
                'result' => $city
            ]);
        } else {
            $cities = City::all();
            return response()->json([
                'result' => $cities
            ]);
        }
    }

    public function countUsersPerCity() {
        $cities = City::all();
        foreach($cities as $city) {
            $count = User::where('city_id', $city->id)->count();
            $results[] = "Tem " . $count ." usuários cadastrados na cidade " . $city->name;
        }
        return response()->json([
            'results' => $results
        ]);
    }
}
