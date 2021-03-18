<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
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
