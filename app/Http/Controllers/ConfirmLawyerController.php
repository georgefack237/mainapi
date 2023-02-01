<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\Lawyer;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Support\Str;

class ConfirmLawyerController extends Controller
{
    public function addlawyer()
    {

        $firstName = 'Atangana Oloa';
        $lastName = 'Etienne';
        $address = 'Yaoundé';
        $phone = '+237 688 889 779';
        $matricule = '3212993CD';
        $matriculeKey = Str::slug($matricule) . '-' . Str::slug($firstName);
        $matriculeKeyHash = Crypt::encryptString($matriculeKey);

        $lawyer = new Lawyer();

        // $lawyer->slug = Str::slug ($this->firstName) . '-' . Str::slug ($this->lastName) . '-' . Str::slug ($this->companyName);
        // $lawyer->slug = Str::slug ($this->firstName) . '-' . now()->format(format:'Ymd');
        $lawyer->first_name = $firstName;
        $lawyer->last_name = $lastName;
        $lawyer->address = $address;
        $lawyer->phone = $phone;
        $lawyer->matricule = $matricule;
        $lawyer->matricule_key = $matriculeKey;
        $lawyer->matricule_key_hash = $matriculeKeyHash;
        $lawyer->save();

        return $matriculeKeyHash;
    }

    public function showconfirm($slug)
    {
        // $matriculeKey = Crypt::decryptString($slug);

        try {
            $matriculeKey = Crypt::decryptString($slug);
        } catch (DecryptException $e) {
            $data['button'] = false;
            $data['message'] = "Cette avocat ne figure pas dans le tableau de l'ordre* des avocats du Barreau du Cameroun";
            $data['icon'] = "fa fa-exclamation-circle fa-4x";
            $data['iconcolor'] = "text-danger";
            $data['profile'] = null;
            return view('lawyer-exists', $data)->layout('layouts.link');
        }

        $data['profile'] = Lawyer::where('matricule_key', $matriculeKey)->first();
        $data['button'] = true;
        $data['message'] = "Cette avocat est inscrit dans le tableau de l'ordre des avocats du Barreau du Cameroun";
        $data['icon'] = "fa fa-check-circle fa-4x";
        $data['iconcolor'] = "text-success";

        // dd($profile);
        // return $matriculeKey;
        return view('lawyer-exists', $data)->layout('layouts.link');
    }

    public function showlawyers()
    {
    }

    public function saveOld($id)
    {
        $data = Lawyer::where('id', $id)->first();

        $vcard = new VCard();

        // add personal data
        $vcard->addName($data->last_name, $data->first_name, null, null, null);

        // add work data
        $vcard->addJobtitle($data->title);
        $vcard->addRole(null);
        $vcard->addEmail($data->email, 'INTERNET;PREF');
        $vcard->addPhoneNumber($data->phone, 'PREF;WORK');
        $vcard->addAddress(null, null, null, $data->address, null, null, null);
        $vcard->addLabel(null);

        return $vcard->download();
    }

    public function save($id)
    {
        $data = Lawyer::where('id', $id)->first();

        $fileName = $data->first_name .'.vcf';
        header("Content-Type: text/x-vcard");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Connection: close");
        echo "BEGIN:VCARD\r\n";
        echo "VERSION:3.0\r\n";
        echo "REV:" . date("Y-m-d") . "T" . date("H:i:s") . "Z\r\n";
        echo "N;CHARSET=utf-8:" . $data->last_name . ";" . $data->first_name . ";;;\r\n";
        echo "FN;CHARSET=utf-8:" . $data->last_name . "\r\n";
        echo "TITLE;CHARSET=utf-8:" . $data->title . "\r\n";
        echo "ROLE;CHARSET=utf-8:\r\n";
        echo "EMAIL;INTERNET:\r\n";
        echo "TEL;PREF;WORK:" . $data->phone . "\r\n";
        echo "ADR;WORK;POSTAL;CHARSET=utf-8:;" . $data->address . ";;;;;\r\n";
        echo "LABEL;CHARSET=utf-8:\r\n";
        echo "END:VCARD\r\n";
    }
}
