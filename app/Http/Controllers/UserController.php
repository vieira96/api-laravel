<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request)
    {

        $rules = [
            'email' => ['required', 'unique:users'],
            'name' => ['required'],
            'password' => ['required'],
            'state_name' => ['required'],
            'city_name' => ['required'],
            'street' => ['required'],
            'number' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->error()->first()
            ]);
        }

        $user = new User();
        $user->email = filter_input($request->input('email'), FILTER_SANITIZE_EMAIL);
        $user->name = filter_input($request->input('name'), FILTER_SANITIZE_STRIPPED);
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);

        $new_state = new State();
        $new_state->name = filter_input(ucfirst($request->input('state_name')), FILTER_SANITIZE_STRIPPED);

        if($state = State::where('name', $new_state->name)->count()) {
            $user->state_id = $state->id;
        } else {
            $new_state->save();
            $user->state_id = $new_state->id;
        }

        $new_city = new State();
        $new_city->name = filter_input(ucfirst($request->input('city_name')), FILTER_SANITIZE_STRIPPED);

        if($city = City::where('name', $new_city->name)->count()) {
            $user->city_id = $city->id;
        } else {
            $new_city->save();
            $user->city_id = $new_city->id;
        }

        $new_address = new Address();
        $new_address->street = filter_input($request->input('street'), FILTER_SANITIZE_STRIPPED);
        $new_address->number = filter_input($request->input('number'), FILTER_SANITIZE_STRIPPED);
        $new_address->save();

        $user->address_id = $new_address->id;

        $user->save();
        
        return response()->json([
            'result' => "Novo usuário cadastrado com sucesso."
        ])
    }
}
