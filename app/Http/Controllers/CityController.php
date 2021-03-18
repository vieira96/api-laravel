<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;


class CityController extends Controller
{
    //criei o metodo com o $id = false para usar o mesmo metodo para todas as cidades e para uma unica cidade
    //caso seja informado um id
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

    //pego a quantidade de usuarios cadastrados por cada cidade
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
