<?php

namespace App\Http\Livewire\Admin;

use App\Models\Partner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Partners extends Component
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
    public $phone;
    public $country;
    public $city;
    public $address;
    public $createLimit;

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

    public function createItem ()
    {

        $Partner = Partner::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'create_limit' => $this->createLimit,
            'password' => Hash::make('12345678'),
        ]);

        $this->reset();

        $this->createModal = false;
    }

    public function deleteProfile($id) {
        $Partner = Partner::find($id);
        $Partner->delete();

        $this->deleteModal = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.partners', [
            'partners' => Partner::all(),
        ])->layout('layouts.admin');
    }
}
