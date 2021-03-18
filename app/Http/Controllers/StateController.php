<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;

use Illuminate\Http\Request;

class StateController extends Controller
{
     //criei o metodo com o $id = false para usar o mesmo metodo para todos os estados e para um unico estado
    //caso seja informado um id
    public function states($id = false)
    {
        if($id) {
            $state = State::find($id);
            return response()->json([
                'result' => $state
            ]);
        } else {
            $states = State::all();
            return response()->json([
                'result' => $states
            ]);
        }
    }

    //pego a quantidade de usuarios cadastrados por cada estado
    public function countUsersPerState() {
        $states = State::all();
        foreach($states as $state) {
            $count = User::where('state_id', $state->id)->count();
            $results[] = "Tem " . $count ." usuários cadastrados na cidade " . $state->name;
        }
        return response()->json([
            'results' => $results
        ]);
    }
}
