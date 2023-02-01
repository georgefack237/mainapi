<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function getEvents()
    {
        $rdv = appointment::select('title', 'start')
        ->where('user_id', Auth::user()->id)
        // ->orderBy('id', 'desc')
        ->get();

        return response()->json($rdv);
    }
}
