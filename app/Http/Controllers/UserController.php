<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function register(Request $request){

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'website' => 'required',
            'specialization' => 'required',
            'country' => 'required',
            'package_id' => 'nullable',
            'profile_limit' => 'nullable',
            'admin_id' => 'required',
            'partner_id' => 'nullable'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'website' => $fields['website'],
            'specialization' => $fields['specialization'],
            'country' =>$fields['country'],
            'package_id' => $fields['package_id'],
            'profile_limit' => $fields['profile_limit'],
            'admin_id' => $fields['admin_id'],
            'partner_id' => $fields['partner_id']

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }


    public function nfcprofiles(int $userId){
        return User::find($userId)->nfcprofiles;
    }
}

