<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use Illuminate\Http\Request;

class LawyerApiController extends Controller
{


    public function index(){
        return Lawyer::all();
    }


 
    public function register(Request $request){

        $fields = $request->validate([


            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'title' => 'required|string',
            'image' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'mail' => 'required|string',
            'matricule' => 'required|string',
            'matricule_key' => 'required|string',
            'matricule_key_hash' => 'required|string'
        ]);

        $lawyer = Lawyer::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'title' => bcrypt($fields['title']),
            'image' => $fields['image'],
            'address' => $fields['address'],
            'phone' =>$fields['phone'],
            'mail' => $fields['mail'],
            'matricule' => $fields['matricule'],
            'matricule_key' => $fields['matricule_key'],
            'matricule_key_hash' => $fields['matricule_key_hash']

        ]);

       // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'message' => 'Created Successfully!'
        ];

        return response($response, 201);

    }


    
}
