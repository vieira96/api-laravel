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

        //criei as regras para validar o request
        $rules = [
            'email' => ['required', 'unique:users', 'email'],
            'name' => ['required'],
            'password' => ['required'],
            'state_name' => ['required'],
            'city_name' => ['required'],
            'street' => ['required'],
            'number' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        //se tiver algum erro, retorna o mesmo
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        }

        $user = new User();
        $user->email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $user->name = filter_var($request->input('name'), FILTER_SANITIZE_STRIPPED);
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);

        //pega o estado
        $new_state = new State();
        $new_state->name = filter_var(ucfirst($request->input('state_name')), FILTER_SANITIZE_STRIPPED);

        //verifica se existe um estado, se nao, cria um novo e adiciona no id do estado do usuario
        if($state = State::where('name', $new_state->name)->first()) {
            $user->state_id = $state->id;
        } else {
            $new_state->save();
            $user->state_id = $new_state->id;
        }
        
        //pega a cidade
        $new_city = new City();
        $new_city->name = filter_var(ucfirst($request->input('city_name')), FILTER_SANITIZE_STRIPPED);

        //verifica se existe uma cidade, se sim, adiciona ao id da cidade do usuário
        //poderia ser feito com o campo de select, mas  como n sei a logca do front, resolvi fazer assim
        if($city = City::where('name', $new_city->name)->first()) {
            $user->city_id = $city->id;
        } else {
            $new_city->save();
            $user->city_id = $new_city->id;
        }
        $new_address = new Address();

        //criei o novo endereço
        $new_address->street = filter_var($request->input('street'), FILTER_SANITIZE_STRIPPED);
        $new_address->number = filter_var($request->input('number'), FILTER_SANITIZE_STRIPPED);
        $new_address->save();

        //salvei o id do endereço no usuario
        $user->address_id = $new_address->id;

        $user->save();
        
        return response()->json([
            'result' => "Novo usuário cadastrado com sucesso."
        ]);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'name' => ['required'],
            'password' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        }
        
        $user = User::find($id);
        if($user){
            $user->name = filter_var($request->input('name'), FILTER_SANITIZE_STRIPPED);
            $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
            $user->save();

            return response()->json([
                'result' => 'Usuário atualizado com sucesso'
            ]);

        } else {

            return response()->json([
                'error' => "Nenhum usuário encontrado com esse ID"
            ]);
        }
    }

    public function read($id)
    {
        $user =  User::find($id);
        if($user){
            return response()->json([
                'result' => $user
            ]);
        } else {
            return response()->json([
                'error' => "Nenhum usuário encontrado com esse ID"
            ]);
        }
    }

    public function delete($id)
    {
        $user =  User::find($id);
        if($user){
            $user->delete();
            return response()->json([
                'result' => "Usuário deletado com sucesso"
            ]);
        } else {
            return response()->json([
                'error' => "Nenhum usuário encontrado com esse ID"
            ]);
        }
    }

    

    
}
