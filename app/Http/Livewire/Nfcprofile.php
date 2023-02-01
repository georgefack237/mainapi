<?php

namespace App\Http\Livewire;

use App\Http\Controllers\MailController;
use App\Models\nfcprofile as ModelsNfcprofile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JeroenDesloovere\VCard\VCard;

use Illuminate\Support\Str;
use Livewire\WithPagination;

class Nfcprofile extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $info;
    public $viewInfo = false;
    public $viewEdit = false;

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

    public $newPassword;

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

    public function showInfo ($id) {
        $this->info = ModelsNfcprofile::where('id', $id)->with('sales')->first();
        $this->viewInfo = true;
    }

    public function editInfo () {

        $this->firstName = $this->info->firstname;
        $this->lastName = $this->info->lastname;
        $this->companyName = $this->info->companyname;
        $this->title = $this->info->title;
        $this->address = $this->info->address;
        $this->phone1 = $this->info->phone1;
        $this->email = $this->info->email;
        $this->website = $this->info->website;
        $this->facebook = $this->info->facebook;
        $this->linkedin = $this->info->linkedin;
        $this->twitter = $this->info->twitter;

        $this->viewInfo = false;
        $this->viewEdit = true;
    }

    public function updateProfile ()
    {

        // $slug = Str::slug ($this->firstName) . '-' . Str::slug ($this->lastName) . '-' . Str::slug ($this->companyName);

        ModelsNfcprofile::find($this->info->id)->update([
            // 'slug' => $slug,
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
        $this->viewEdit = false;
        $this->viewInfo = true;
    }

    public function updatePassword ()
    {

        // $slug = Str::slug ($this->firstName) . '-' . Str::slug ($this->lastName) . '-' . Str::slug ($this->companyName);

        ModelsNfcprofile::find($this->info->id)->update([
            'password' => Hash::make($this->newPassword)
        ]);

        // $this->reset();
        $this->viewEdit = false;
        $this->viewInfo = true;
    }

    public function render()
    {
        if(Auth::user()->user_type == 1)
        {
            $profiles = ModelsNfcprofile::where('firstname', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        } else {
            $profiles = ModelsNfcprofile::where('firstname', 'like', '%'.$this->search.'%')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        }

        return view('livewire.nfc.nfcprofile', [
            'profiles' => $profiles,
        ]);
    }
}
