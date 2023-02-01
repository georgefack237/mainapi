<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function contacts()
    {

        $contacts = contact::where('profile_id', Auth::user()->id)->get();

        return view('profiles.dashboard.contacts', [
            'contacts' => $contacts,
        ]);
    }
}
