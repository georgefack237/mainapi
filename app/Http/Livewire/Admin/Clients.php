<?php

namespace App\Http\Livewire\Admin;

use App\Models\Package;
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

    public $whereDate = '';

    public $search = '';
    public $perPage = 10;

    public $createModal = false;
    public $deleteModal = false;

    public $name;
    public $email;
    public $website;
    public $specialization;
    public $country;
    public $package;
    public $createLimit;

    public function thisDay()
    {
        $this->whereDate = now()->format('Y-m-d');
    }

    public function thisWeek()
    {
        $this->whereDate = now()->subDays(7)->format('Y-m-d');
    }

    public function thisMonth()
    {
        $this->whereDate = now()->subDays(30)->format('Y-m-d');
    }

    public function thisYear()
    {
        $this->whereDate = now()->subYear()->format('Y-m-d');
    }

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

        if ($this->package==1) {
            $client = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'website' => $this->website,
                'specialization' => $this->specialization,
                'country' => $this->country,
                'package_id' => $this->package,
                'profile_limit' => $this->createLimit,
                'admin_id' =>  Auth::user()->id,
                'password' => Hash::make('12345678'),
            ]);
        } else {
            $client = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'website' => $this->website,
                'specialization' => $this->specialization,
                'country' => $this->country,
                'package_id' => $this->package,
                'profile_limit' => $this->createLimit,
                'admin_id' =>  Auth::user()->id,
                'password' => Hash::make('12345678'),
            ]);
        }


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
        $clients = User::where('name', 'like', '%'.$this->search.'%')
        ->orWhere('country', 'like', '%'.$this->search.'%')
        ->where('created_at', '>', $this->whereDate)
        ->with('package')
        ->orderBy('id', 'desc')
        ->paginate($this->perPage);

        $packages = Package::all();

        return view('livewire.clients', compact(['clients', 'packages']))->layout('layouts.admin');
    }
}
