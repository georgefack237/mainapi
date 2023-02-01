<?php

namespace App\Http\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;
use App\Models\purchase;

class Products extends Component
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

        $sales = purchase::where('description', 'like', '%'.$this->search.'%')
        ->where('created_at', '>', $this->whereDate)
        ->where('profile_id', Auth::user()->id)
        // ->with('profile')
        ->orderBy('id', 'desc')
        ->get();

        return view('profiles.dashboard.products', compact('sales'))->layout('layouts.profile');
    }
}
