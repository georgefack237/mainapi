<?php

namespace App\Http\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;
use App\Models\appointment;

class Appointments extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 50;

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

    // public function mount()
    // {
    //     $this->whereDate = now()->format('Y-m-d');
    // }

    public function saveConatcts($id)
    {
        $save = new SaveContact;
        $save->phoneSave($id);
    }

    public function render()
    {

        $appointments = appointment::where('user_id', Auth::user()->id)->get();
        $contacts = contact::where('name', 'like', '%' . $this->search . '%')
            ->where('profile_id', Auth::user()->id)
            ->orderBy('name')
            ->get();
        // dd(now()->subDays(7)->format('d M Y'));
        // dd($contacts);

        return view('profiles.dashboard.appointments', compact(['contacts', 'appointments']))->layout('layouts.profile');
    }
}
