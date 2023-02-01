<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;


class AdminController extends Controller
{


    public function store(Request $request){

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_super' => 'required']);




    if ($validator->fails()) {

       return response()->json([
        'Error' => 'Your information was not stored!',
      ]);
    }
    else {

    $newadmin = new Admin();

    $newadmin -> name = request('name');
    $newadmin -> email = request('email');
    $newadmin -> password = bcrypt(request('password'));
    $newadmin ->is_super = request('is_super');

    $newadmin -> save();


    return response()->json([
        'error' =>  $validator->errors()!,
    ]);

        return response()->json([
            'message'=> "Successfully registered."

        ]);

}

    }
}
