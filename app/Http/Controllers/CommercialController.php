<?php

namespace App\Http\Controllers;

use App\Models\nfcprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommercialController extends Controller
{
    public function Login()
    {
        return view('comm-login');
    }

    public function Auth(Request $request)
    {
        $email = $request->email;
        $login = nfcprofile::where('email', $email)->first();
        // dd($login);
        if($login) {
            $slug = $login->slug;
            // dd($slug);
            return Redirect('/admin/commercial/'.$slug);
        }
    }
}
