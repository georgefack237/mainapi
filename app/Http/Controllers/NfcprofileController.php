<?php

namespace App\Http\Controllers;
use App\Models\nfcprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NfcProfileController extends Controller
{



    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id'  => 'required',
            'firstname'  => 'required',
            'lastname'  => 'required',
            'image'  => 'required',
            'companyname'  => 'required',
            'title'  => 'required',
            'address'  => 'required',
            'phone1'  => 'required',
            'email'  => 'required|email',
            'password'  => 'required',
            'website'  => 'required',
            'facebook'  => 'required',
            'twitter'  => 'nullable',
            'linkedin'  => 'nullable'
        ]);

    if ($validator->fails()) {

       return response()->json([
        'error' => $validator->errors()
      ]);
    }
    else {

    $newprofile = new nfcprofile();


    $newprofile -> slug = Str::slug (request('firstname')) . '-' . Str::slug (request('lastname')) . '-' . Str::slug (request('companyname'));
    $newprofile -> user_id = request('user_id');
    $newprofile ->firstname = request('firstname');
    $newprofile -> lastname = request('lastname');
    $newprofile -> image =  request('image');
    $newprofile ->companyname =  request('companyname');
    $newprofile -> title =  request('title');
    $newprofile -> address=  request('address');
    $newprofile -> phone1 =  request('phone1');
    $newprofile -> email =  request('email');
    $newprofile -> password = bcrypt(request('password'));
    $newprofile -> website =  request('website');
    $newprofile -> facebook =  request('facebook');
    $newprofile -> twitter =  request('twitter');
    $newprofile -> linkedin =  request('linkedin');

    $newprofile -> save();


    return response()->json([
        'success' => 'Your information stored successfuly!',
    ]);



}

    }



    public function update(Request $request, $id){

        $fields = $request->validate( [
            'user_id'  => 'required',
            'firstname'  => 'required',
            'lastname'  => 'required',
            'image'  => 'required',
            'companyname'  => 'required',
            'title'  => 'required',
            'address'  => 'required',
            'phone1'  => 'required',
            'email'  => 'required|email',
            'password'  => 'required',
            'website'  => 'required',
            'facebook'  => 'required',
            'twitter'  => 'nullable',
            'linkedin'  => 'nullable'
        ]);


        $newprofile = new nfcprofile();


        $newprofile -> slug = Str::slug ($fields['firstname']) . '-' . Str::slug (request('lastname')) . '-' . Str::slug (request('companyname'));
        $newprofile -> user_id =$fields['user_id'];
        $newprofile ->firstname = $fields['firstname'];
        $newprofile -> lastname = $fields['lastname'];
        $newprofile -> image =  $fields['image'];
        $newprofile ->companyname = $fields['companyname'];
        $newprofile -> title = $fields['title'];
        $newprofile -> address= $fields['address'];
        $newprofile -> phone1 = $fields['phone1'];
        $newprofile -> password = bcrypt($fields['password']);
        $newprofile -> website =  $fields['website'];
        $newprofile -> facebook =  $fields['facebook'];
        $newprofile -> twitter =  $fields['twitter'];
        $newprofile -> linkedin =  $fields['linkedin'];

        $profile = nfcprofile::find($id);
        $profile->update($newprofile);

            return response()->json([
                'success' => 'Your information updated successfully!',
            ]);





    }









}
