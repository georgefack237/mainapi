<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;
use App\Models\nfcprofile;
use App\Models\pageviews;
use App\Models\contact;
// use App\Models\SaveButtonPressed;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class SaveContact extends Controller
{

    public $profile;

    public function saveContact(Request $request)
    {

        // dd($request);

        $this->profile = nfcprofile::where('id', $request->id)->first();

        $userAgent = request()->userAgent();
        // $ip = '154.72.162.47';
        $ip = $_SERVER['REMOTE_ADDR'];
        // dd($ip);
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        // $browser = $_SERVER['HTTP_SEC_CH_UA']?$_SERVER['HTTP_SEC_CH_UA']:'';
        // $platform = $_SERVER['HTTP_SEC_CH_UA_PLATFORM']?$_SERVER['HTTP_SEC_CH_UA_PLATFORM']:'';
        // $mobile = $_SERVER['HTTP_SEC_CH_UA_MOBILE']?$_SERVER['HTTP_SEC_CH_UA_MOBILE']:'';
        $userData = Location::get($ip);

        $recordsave = new pageviews();
        $recordsave->page_id = $this->profile->id;
        $recordsave->user_id = $this->profile->user_id;
        $recordsave->page_slug = $this->profile->slug;
        $recordsave->ip_address = $ip;
        $recordsave->user_agent = $user_agent;
        // $recordsave->browser = $browser;
        // $recordsave->platform = $platform;
        // $recordsave->mobile = $mobile;
        $recordsave->country_name = $userData->countryName;
        $recordsave->region_name = $userData->regionName;
        $recordsave->city_name = $userData->cityName;
        $recordsave->latitude = $userData->latitude;
        $recordsave->longitude = $userData->longitude;
        $recordsave->save();

        $contact = new contact();
        $contact->profile_id = $this->profile->id;
        $contact->user_id = $this->profile->user_id;
        $contact->name = $request->name;
        $contact->title = $request->title;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->gender = $request->gender;
        $contact->is_manual = false;
        $contact->has_cycle = false;
        $contact->save();

        $vcard = new VCard();

        // add personal data
        $vcard->addName($this->profile->lastname, $this->profile->firstname, null, null, null);

        // add work data
        $vcard->addCompany($this->profile->companyname);
        $vcard->addJobtitle($this->profile->title);
        $vcard->addRole(null);
        $vcard->addEmail($this->profile->email, 'INTERNET;PREF');
        $vcard->addPhoneNumber($this->profile->phone1, 'PREF;WORK');
        $vcard->addAddress(null, null, null, $this->profile->address, null, null, null);
        $vcard->addLabel(null);
        $vcard->addURL($this->profile->website);

        // $vcard->addPhoto(__DIR__ . '/landscape.jpeg');

        // return vcard as a download
        return $vcard->download();
    }

    // public function saveContactBatch($contacts)
    // {
    //     $filenName = 'contacts.vcf';
    //     header("Content-type: text/x-vcard");
    //     header("Content-Disposition: attachment; filename=$filenName");
    //     header("Connection: close");
    //     foreach ($contacts as $item) {
    //         echo "BEGIN:VCARD\r\n";
    //         echo "VERSION:3.0\r\n";
    //         echo "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";
    //         echo "N;CHARSET=utf-8:" . $item->name . ";Client;;;\r\n";
    //         echo "FN;CHARSET=utf-8: Client" . $item->name . "\r\n";
    //         echo "TITLE;CHARSET=utf-8:" . $item->title . "\r\n";
    //         echo "ROLE;CHARSET=utf-8:\r\n";
    //         echo "EMAIL;INTERNET:\r\n";
    //         echo "TEL;PREF;WORK:" . $item->phone . "\r\n";
    //         echo "ADR;WORK;POSTAL;CHARSET=utf-8:;;;;;;\r\n";
    //         echo "LABEL;CHARSET=utf-8:\r\n";
    //         echo "END:VCARD\r\n";
    //     }
        // fputs()
        // $output = fopen("php://output", "w");
        // dd($contacts);
        // return $string;
    // }

    public function saveContactBatch(Request $request)
    {
        if($request->date == null) {
            $contacts = contact::where('user_id', Auth::user()->id)->get();
        } else {
            // dd($request->date);
            if(Auth::user()->user_type == 1)
            {
                $contacts = contact::where('created_at', '>', $request->date)->get();
            } else {
                $contacts = contact::where('user_id', Auth::user()->id)
                ->where('created_at', '>', $request->date)
                ->get();
            }
        }

        // dd($contacts);

        $filenName = 'contacts.vcf';
        header('Content-Description: Download vCard');
        header("Content-Type: text/x-vcard");
        header("Content-Disposition: attachment; filename=$filenName");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header("Connection: close");
        foreach ($contacts as $item) {
            echo "BEGIN:VCARD\r\n";
            echo "VERSION:3.0\r\n";
            echo "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";
            echo "N;CHARSET=utf-8:" . $item->name . ";Client;;;\r\n";
            echo "FN;CHARSET=utf-8: Client" . $item->name . "\r\n";
            echo "TITLE;CHARSET=utf-8:" . $item->title . "\r\n";
            echo "ROLE;CHARSET=utf-8:\r\n";
            echo "EMAIL;INTERNET:\r\n";
            echo "TEL;PREF;WORK:" . $item->phone . "\r\n";
            echo "ADR;WORK;POSTAL;CHARSET=utf-8:;;;;;;\r\n";
            echo "LABEL;CHARSET=utf-8:\r\n";
            echo "END:VCARD\r\n";
        }
        ob_clean();
        flush();
        echo $filenName; //echo the content
        exit;
        // $output = fopen("php://output", "w");
        // dd($contacts);
        // return $string;
    }

    public function phoneSave($id)
    {
        $data = contact::where('id', $id)->first();

        // $filenName = $data->name;
        // header("Content-Type: text/x-vcard");
        // header("Content-Disposition: attachment; filename=$filenName");
        // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        // header("Connection: close");
        // echo "BEGIN:VCARD\r\n";
        // echo "VERSION:3.0\r\n";
        // echo "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";
        // echo "N;CHARSET=utf-8:" . $data->name . ";Client;;;\r\n";
        // echo "FN;CHARSET=utf-8: Client" . $data->name . "\r\n";
        // echo "TITLE;CHARSET=utf-8:" . $data->title . "\r\n";
        // echo "ROLE;CHARSET=utf-8:\r\n";
        // echo "EMAIL;INTERNET:\r\n";
        // echo "TEL;PREF;WORK:" . $data->phone . "\r\n";
        // echo "ADR;WORK;POSTAL;CHARSET=utf-8:;;;;;;\r\n";
        // echo "LABEL;CHARSET=utf-8:\r\n";
        // echo "END:VCARD\r\n";

        $vcard = new VCard();

        // add personal data
        $vcard->addName($data->name, '- Client', null, null, null);

        // add work data
        $vcard->addJobtitle($data->title);
        $vcard->addRole(null);
        $vcard->addEmail(null);
        $vcard->addPhoneNumber($data->phone, 'PREF;WORK');
        $vcard->addAddress(null, null, null, null, null, null, null);
        $vcard->addLabel(null);

        return $vcard->download();
    }
}
