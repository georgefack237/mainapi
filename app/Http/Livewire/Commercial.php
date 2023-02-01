<?php

namespace App\Http\Livewire;

use App\Models\contact;
use App\Models\nfcprofile;
use App\Models\pageviews;
use JeroenDesloovere\VCard\VCard;
use Livewire\Component;

class Commercial extends Component
{
    public $profile;

    public $updateNfcModal = false;

    public $firstName;
    public $lastName;
    public $image;
    public $companyName;
    public $title;
    public $address;
    public $phone1;
    public $phone2;
    public $email;
    public $email2;
    public $website;
    public $facebook;
    public $linkedin;
    public $twitter;

    public function showUpdateNfc()
    {
        $this->updateNfcModal = true;

        $this->firstName = $this->profile->firstname;
        $this->lastName = $this->profile->lastname;
        $this->companyName = $this->profile->companyname;
        $this->title = $this->profile->title;
        $this->address = $this->profile->address;
        $this->phone1 = $this->profile->phone1;
        $this->phone2 = $this->profile->phone2;
        $this->email = $this->profile->email;
        $this->email2 = $this->profile->email2;
        $this->website = $this->profile->website;
        $this->facebook = $this->profile->facebook;
        $this->linkedin = $this->profile->linkedin;
        $this->twitter = $this->profile->twitter;
    }

    public function updateProfile ()
    {

        nfcprofile::find($this->profile->id)->update([
            'firstname' => $this->firstName,
            'lastname' => $this->lastName,
            'companyname' => $this->companyName,
            'title' => $this->title,
            'address' => $this->address,
            'phone1' => $this->phone1,
            'email' => $this->email,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter
        ]);

        // $this->reset();

        $this->updateNfcModal = false;
    }

    public function mount($slug)
    {
        $this->profile = nfcprofile::where('slug', $slug)->with(['pageviews', 'contacts'])->first();

        $vcard = new VCard();

        $vcard->addName($this->profile->lastname, $this->profile->firstname, null, null, null);
        $vcard->addCompany($this->profile->companyname);
        $vcard->addJobtitle($this->profile->title);
        $vcard->addRole(null);
        $vcard->addEmail($this->profile->email);
        $vcard->addPhoneNumber($this->profile->phone1, 'PREF;WORK');
        $vcard->addPhoneNumber($this->profile->phone2, 'WORK');
        $vcard->addAddress(null, null, null, $this->profile->address, null, null, null);
        $vcard->addLabel(null);
        $vcard->addURL($this->profile->website);

        $this->vCard = $vcard->getOutput();
    }

    public function render()
    {
        $activities = pageviews::where('page_id', $this->profile->id)->with('nfcprofile')->get();
        $contacts = contact::where('profile_id', $this->profile->id)->with(['user', 'nfcprofile'])->get();
        return view('livewire.commercial', compact(['activities', 'contacts']))->layout('layouts.link');
    }
}
