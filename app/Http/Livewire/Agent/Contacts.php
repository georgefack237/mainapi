<?php

namespace App\Http\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;

class Contacts extends Component
{

    use WithPagination;

    public $whereDate = '';

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 50;

    public $addNoteModal = false;

    public $title;
    public $body;
    public $date;
    public $profileId;
    public $contactId;

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

    public function showAddNote($id)
    {
        $this->contactId = $id;
        $this->addNoteModal = true;
    }

    public function addNote ()
    {

        $note = new agent_note();
        // $nfc->slug = Str::slug ($this->firstName) . '-' . now()->format(format:'Ymd');
        $note->profile_id = Auth::user()->id;
        $note->contact_id = $this->contactId;
        $note->title = $this->title;
        $note->body = $this->body;
        $note->date = $this->date;
        $note->save();

        $this->reset();

        $this->addNoteModal = false;
    }

    public function saveContactBatch()
    {
        if(Auth::user()->user_type == 1)
        {
            $contacts = contact::where('name', 'like', '%'.$this->search.'%')
            ->where('created_at', '>', $this->whereDate)
            ->with('nfcprofile')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        } else {
            $contacts = contact::where('name', 'like', '%'.$this->search.'%')
            ->where('user_id', Auth::user()->id)
            ->orWhere('profile_id', Auth::user()->id)
            ->where('created_at', '>', $this->whereDate)
            ->with('nfcprofile')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        }

        $save = new SaveContact;
        $save->saveContactBatch2($contacts);
    }

    public function saveConatcts($id)
    {
        $save = new SaveContact;
        $save->phoneSave($id);
    }

    public function render()
    {

        $contacts = contact::addSelect(['lastNote' => agent_note::select('body')
            ->whereColumn('contact_id', 'contacts.id')
            ->latest()
            ->take(1)
        ])->where('name', 'like', '%'.$this->search.'%')
        ->where('created_at', '>', $this->whereDate)
        ->where('profile_id', Auth::user()->id)
        ->orderBy('id', 'desc')
        ->get();
        // $contacts = contact::where('name', 'like', '%'.$this->search.'%')
        // ->where('created_at', '>', $this->whereDate)
        // ->where('profile_id', Auth::user()->id)
        // ->with('notes')
        // ->orderBy('id', 'desc')
        // ->paginate($this->perPage);
        // dd($contacts);

        return view('profiles.dashboard.contacts', compact('contacts'))->layout('layouts.profile');
    }
}
