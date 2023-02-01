<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\nfcprofile;
use App\Models\pageviews;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use JeroenDesloovere\VCard\VCard;
use Stevebauman\Location\Facades\Location;


class ShowNfcLink extends Component
{

    public $profile;

    public $QR;

    public function mount($slug)
    {
        $this->profile = nfcprofile::where('slug', $slug)->first();

        $userAgent = request()->userAgent();
        $ip = '154.72.162.47';
        $userData = Location::get($ip);

        // $pageview = new pageviews();
        // $pageview->page_id = $this->profile->id;
        // $pageview->page_slug = $this->profile->slug;
        // $pageview->ip_address = $ip;
        // $pageview->user_agent = $userAgent;
        // $pageview->country_name = $userData->countryName;
        // $pageview->region_name = $userData->regionName;
        // $pageview->city_name = $userData->cityName;
        // $pageview->latitude = $userData->latitude;
        // $pageview->longitude = $userData->longitude;
        // $pageview->save();
    }

    public function sendMessage()
    {

    }

    public function render()
    {
        // $data = request()->session()->all();
        // $data2 = request()->userAgent();
        // $ip = '154.72.162.47';
        // $userData = Location::get($ip);
        // $ip = $_SERVER['HTTP_MSISDN'];
        // dd($_SERVER['REMOTE_ADDR']);
        return view('livewire.nfc.nfc-link')
        ->layout('layouts.link');
    }

    // "HTTP_SEC_CH_UA" => ""Chromium";v="104", " Not A;Brand";v="99", "Google Chrome";v="104""
    // "HTTP_SEC_CH_UA_MOBILE" => "?0"
    // "HTTP_SEC_CH_UA_PLATFORM" => ""Windows""
}
