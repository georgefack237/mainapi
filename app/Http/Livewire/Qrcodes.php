<?php

namespace App\Http\Livewire;

use App\Models\qrcode;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Qrcodes extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $firstName;
    public $lastName;
    public $companyName;
    public $title;
    public $address;
    public $phone1;
    public $phone2;
    public $email1;
    public $email2;
    public $website;

    public function createProfile ()
    {
        $qr = new qrcode();
        $qr->firstname = $this->firstName;
        $qr->laststname = $this->firstName;
        $qr->companyname = $this->companyName;
        $qr->title = $this->title;
        $qr->address = $this->address;
        $qr->phone1 = $this->phone1;
        $qr->phone2 = $this->phone2;
        $qr->email1 = $this->email1;
        $qr->email2 = $this->email2;
        $qr->website = $this->website;
        $qr->save();
    }

    public function render()
    {
        return view('livewire.qrcodes.qrcodes-list', [
            'profiles' => Qrcodes::all()
        ]);
    }
}
