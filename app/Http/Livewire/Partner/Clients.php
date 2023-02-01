<?php

namespace App\Http\Livewire\Partner;

use App\Models\Package;
use App\Models\Partner;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Clients extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 5;

    public $createModal = false;
    public $deleteModal = false;

    public $name;
    public $email;
    public $website;
    public $specialization;
    public $country;
    public $package;

    public function showCreate()
    {
        $this->createModal = true;
    }

    public function showDelete()
    {
        $this->deleteModal = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create ()
    {

        $client = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'website' => $this->website,
            'specialization' => $this->specialization,
            'country' => $this->country,
            'package_id' => $this->package,
            'partner_id' =>  Auth::user()->id,
            'password' => Hash::make('12345678'),
        ]);

        Partner::find(Auth::user()->id)->update([
            'create_limit' => Auth::user()->create_limit - 1
        ]);

        $this->reset();

        $this->createModal = false;
    }

    public function deleteProfile($id) {
        $client = User::find($id);
        $client->delete();

        $this->deleteModal = false;
        $this->reset();
    }

    public function render()
    {
        $clients = User::with('package')->where('partner_id', Auth::user()->id)->get();
        $packages = Package::all();

        return view('livewire.partner.clients', compact(['clients', 'packages']))->layout('layouts.partner');
    }
}
