<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\Partner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Commercials extends Component
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
    public $role;
    public $password;
    public $isAdmin;

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
        $this->isAdmin = $this->role == 'Admin' ? true : false;
        // dd($this->isAdmin);
        $admin = Admin::create([
            'name' => $this->name,
            'email' => $this->email,
            'is_super' => $this->isAdmin,
            'password' => Hash::make($this->password),
        ]);

        $this->reset();

        $this->createModal = false;
    }

    public function deleteProfile($id) {
        $Partner = Admin::find($id);
        $Partner->delete();

        $this->deleteModal = false;
        $this->reset();
    }

    public function render()
    {
        $admins = Admin::where('is_super', true)->get();
        $agents = Admin::where('is_super', false)->get();

        return view('livewire.commercials', compact(['admins', 'agents']))->layout('layouts.admin');
    }
}
