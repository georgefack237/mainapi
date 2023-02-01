<?php

namespace App\Http\Livewire;

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

    public $whereDate = '';

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 50;

    public $rdvModal = false;

    public function showRdvModal()
    {
        $this->rdvModal = true;
    }

    public function saveConatcts($id)
    {
        $save = new SaveContact;
        $save->phoneSave($id);
    }

    public function render()
    {

        $rdv = appointment::select('title', 'start')
        ->where('user_id', Auth::user()->id)
        // ->orderBy('id', 'desc')
        ->get();
        // $appointments = json_encode($rdv);
        $appointments = response()->json($rdv);

        // dd($appointments);

        return view('livewire.appointments', compact('appointments'));
    }
}
