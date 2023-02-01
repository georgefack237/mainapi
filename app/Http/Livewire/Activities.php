<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\pageviews;
use Livewire\Component;
use Livewire\WithPagination;

class Activities extends Component
{

    use WithPagination;

    public $whereDate = '';

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 5;

    public function thisDay()
    {
        $this->whereDate = now()->format('Y-m-d');
    }

    public function thisWeek()
    {
        $this->whereDate = now()->subDays(7);
    }

    public function thisMonth()
    {
        $this->whereDate = now()->subDays(30);
    }

    public function thisYear()
    {
        $this->whereDate = now()->subYear();
    }

    public function findArchive()
    {
        $this->whereDate = now()->subDays(30);
    }

    // public function mount()
    // {
    //     $this->whereDate = now()->format('Y-m-d');
    // }

    public function render()
    {
        if(Auth::user()->user_type == 1)
        {
            $activities = pageviews::with('nfcprofile')
            ->where('created_at', '>', $this->whereDate)
            ->get();
        } else {
            $activities = pageviews::with('nfcprofile')
            ->where('user_id', Auth::user()->id)
            ->where('created_at', '>', $this->whereDate)
            ->get();
        }

        $archives = pageviews::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        ->groupBy('year', 'month')
        ->orderByRaw('min(created_at) asc')
        ->get()
        ->groupBy('year');
        // dd(now()->subDays(7)->format('d M Y'));
        // dd($_SERVER);
        // dd($archives);

        return view('livewire.activities', compact(['activities', 'archives']));
    }
}
