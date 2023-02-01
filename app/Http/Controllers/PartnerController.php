<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;


class PartnerController extends Controller
{
    

    public function store(Request $request){
      
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'create_limit' => 'required']);

    if ($validator->fails()) {

       return response()->json([
        'Error' => 'Your information was not stored!',
      ]);       
    }
    else {

    $newpartner = new Partner();

    $newpartner -> name = request('name');
    $newpartner -> email = request('email');
    $newpartner -> password = bcrypt(request('password'));
    $newpartner ->phone = request('phone');
    $newpartner -> country = request('country');
    $newpartner -> city =  request('city');
    $newpartner -> address =  request('address');
    $newpartner -> create_limit =  request('create_limit');
    $newpartner -> save();


    return response()->json([
        '2' => 'Your information stored successfuly!',
    ]);

        return response()->json([
            'message'=> "Successfully registered."

        ]);
    
}

    }
}
