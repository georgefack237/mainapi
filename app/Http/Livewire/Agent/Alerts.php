<?php

namespace App\Http\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;
use App\Models\alert;

class Alerts extends Component
{

    use WithPagination;

    public $whereDate = '';

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

    public function render()
    {

        $alerts = alert::where('title', 'like', '%'.$this->search.'%')
        ->where('created_at', '>', $this->whereDate)
        ->where('profile_id', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();

        // $alerts = alert::where('user_id', Auth::user()->id)->with('profile')->get();
        // dd($contacts);

        return view('profiles.dashboard.alerts', compact('alerts'))->layout('layouts.profile');
    }
}
