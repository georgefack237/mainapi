<?php

namespace App\Http\Livewire;

use App\Http\Controllers\MailController;
use App\Models\Lawyer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;
use Livewire\WithPagination;

class LawyersController extends Component
{
    use WithFileUploads;
    use WithPagination;

    // For sending mails
    public $subject;
    public $mailTitle;
    public $mail_image;
    public $content;
    public $recipients;
    // For sending mails

    public $demo;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 8;

    public $createNfcModal = false;
    public $deleteNfcModal = false;

    public $newMailModal = false;

    public $firstName;
    public $lastName;
    public $image;
    public $title;
    public $address;
    public $phone;
    public $email;
    public $matricule;
    // public $inscriptionDate;

    public function showCreateNfc()
    {
        $this->createNfcModal = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createProfile ()
    {

        if($this->image != null) {
            $this->validate([
                'image' => 'image|max:1024', // 1MB Max
            ]);

            $image_name = $this->image->getClientOriginalName();
            $this->image->storeAs('public/img/nfc/profile', $image_name);
        }
        else {
            $image_name = 'default.jpg';
        }

        $matriculeKey = Str::slug($this->matricule) . '-' . Str::slug($this->firstName);
        $matriculeKeyHash = Crypt::encryptString($matriculeKey);

        $lawyer = new Lawyer();

        $lawyer->first_name = $this->firstName;
        $lawyer->last_name = $this->lastName;
        $lawyer->image = $image_name;
        $lawyer->title = $this->title;
        $lawyer->address = $this->address;
        $lawyer->phone = $this->phone;
        $lawyer->mail = $this->email;
        $lawyer->matricule = $this->matricule;
        $lawyer->matricule_key = $matriculeKey;
        $lawyer->matricule_key_hash = $matriculeKeyHash;
        $lawyer->save();

        $this->reset();

        $this->createNfcModal = false;
    }





    public function showDemo ($id) {
        $this->demo = Lawyer::find($id);
        // dd($id);
    }

    public function newMail()
    {

        $this->newMailModal = true;
    }

    public function sendMail()
    {
        // dd($this->mail_image);
        if($this->mail_image != null) {
            $this->validate([
                'mail_image' => 'image|max:1024', // 1MB Max
            ]);

            $image_name = $this->mail_image->getClientOriginalName();
            $this->mail_image->storeAs('public/img/barreau', $image_name);
        }
        else {
            $image_name = 'default.jpg';
        }
        // dd($image_name);

        $logo = '';

        $sendmails = new MailController;
        $sendmails->sendMailLawyers($this->recipients, $this->subject, $this->mailTitle, $this->content, $image_name, $logo);

        $this->newMailModal = false;
        $this->reset();
    }

    public function render()
    {
        $this->recipients = Lawyer::where('mail', '!=', '')->get();
        $profiling = Lawyer::where('first_name', 'like', '%'.$this->search.'%')->orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.lawyers', compact([ 'profiling' ]))->layout('layouts.link');
    }
}
