<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
     //criei o metodo com o $id = false para usar o mesmo metodo para todos os endereços e para um unico endereço
    //caso seja informado um id
    public function adresses($id = false)
    {
        if($id) {
            $address = Address::find($id);
            return response()->json([
                'result' => $address
            ]);
        } else {
            $adresses = Address::all();
            return response()->json([
                'result' => $adresses
            ]);
        }
    }
}
