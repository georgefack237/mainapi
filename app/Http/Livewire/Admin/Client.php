<?php

namespace App\Http\Livewire\Admin;

use App\Models\nfcprofile as ModelsNfcprofile;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use JeroenDesloovere\VCard\VCard;

use Illuminate\Support\Str;
use Livewire\WithPagination;

class Client extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $client;
    public $agents;
    public $demo;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 5;

    public $createNfcModal = false;
    public $deleteNfcModal = false;

    public $userId;
    public $firstName;
    public $lastName;
    public $image;
    public $companyName;
    public $title;
    public $address;
    public $phone1;
    public $email;
    public $website;
    public $facebook;
    public $linkedin;
    public $twitter;

    public function showCreateNfc()
    {
        $this->createNfcModal = true;
    }

    public function showDeleteNfc()
    {
        $this->deleteNfcModal = true;
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


        $nfc = new ModelsNfcprofile;

        $nfc->slug = Str::slug ($this->firstName) . '-' . Str::slug ($this->lastName) . '-' . Str::slug ($this->companyName);
        // $nfc->slug = Str::slug ($this->firstName) . '-' . now()->format(format:'Ymd');
        $nfc->user_id = Auth::user()->id;
        $nfc->firstname = $this->firstName;
        $nfc->lastname = $this->lastName;
        $nfc->image = $image_name;
        $nfc->companyname = $this->companyName;
        $nfc->title = $this->title;
        $nfc->address = $this->address;
        $nfc->phone1 = $this->phone1;
        $nfc->email = $this->email;
        $nfc->website = $this->website;
        $nfc->facebook = $this->facebook;
        $nfc->linkedin = $this->linkedin;
        $nfc->twitter = $this->twitter;
        $nfc->save();

        $this->reset();

        $this->createNfcModal = false;
    }

    public function deleteProfile() {
        $nfc = ModelsNfcprofile::find($this->demo->id);
        $nfc->delete();

        $this->deleteNfcModal = false;
        $this->reset();

    }

    public function showDemo ($id) {
        $this->demo = ModelsNfcprofile::where('id', $id)->first();
    }

    public function mount($id)
    {
        $this->client = User::where('id', $id)->first();
        $this->agents = ModelsNfcprofile::where('user_id', $id)->orderBy('id', 'desc')->get();

    }

    public function render()
    {

        return view('livewire.admin.client')->layout('layouts.admin');
    }
}
