<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\nfcprofile;
use App\Models\Package;
use App\Models\pageviews;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Charts\Client\ActivityChart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function client()
    {
        // $data['package'] = Package::where('id', Auth::user()->package_id)->first();
        // $data['provider'] = Partner::where('id', Auth::user()->partner_id)->orWhere('id', Auth::user()->admin_id)->get();

        $package = Package::where('id', Auth::user()->package_id)->first();
        $provider = Partner::where('id', Auth::user()->partner_id)->orWhere('id', Auth::user()->admin_id)->first();
        $profiles = nfcprofile::where('user_id', Auth::user()->id)->with('pageviews')->limit(4)->get();
        $activities = pageviews::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->limit(5)->get();
        $contacts = contact::where('user_id', Auth::user()->id)->orderBy('id', 'asc')->limit(6)->get();

        // return $activityStat = pageviews::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        // ->where('user_id', Auth::user()->id)
        // ->groupBy('year', 'month')
        // ->orderByRaw('min(created_at) asc')
        // ->get()
        // ->groupBy('year');

        // return $activityStat = pageviews::pluck('id', 'created_at');
        // dd($activityStat);

        $activityStat = pageviews::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->where('user_id', Auth::user()->id)
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->pluck('count', 'month_name');

        $labels = $activityStat->keys();
        $data = $activityStat->values();

        $aChart = new ActivityChart;
        $aChart->labels($labels);

        $aChart->dataset('My dataset', 'line', $data);

        return view('dashboard', compact(['package', 'provider', 'activities', 'profiles', 'contacts', 'aChart']));
    }

    public function admin()
    {

        $packages = Package::all();
        $partners = Partner::all();
        $clients = User::all();

        $activityStat = pageviews::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                    ->where('user_id', Auth::user()->id)
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("month_name"))
                    ->pluck('count', 'month_name');

        $labels = $activityStat->keys();
        $data = $activityStat->values();

        $aChart = new ActivityChart;
        $aChart->labels($labels);

        $aChart->dataset('My dataset', 'line', $data);

        return view('admin.dashboard.index', compact(['packages', 'partners', 'clients']));
    }

    public function partner()
    {

        $packages = Package::with('users')->get();
        $clients = User::where('partner_id', Auth::user()->partner_id)->with('package')->get();

        return view('dashboard', compact(['package', 'provider', 'activities', 'profiles', 'contacts', 'aChart']));
    }
}
