<?php

namespace App\Http\Livewire\Agent;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;

class Notes extends Component
{

    use WithPagination;

    public $whereDate = '';

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 50;

    public $addNoteModal = false;

    public $contact;

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
        $note->profile_id = Auth::user()->id;
        $note->contact_id = $this->contactId;
        $note->title = $this->title;
        $note->body = $this->body;
        $note->date = $this->date;
        $note->save();

        $this->reset();

        $this->addNoteModal = false;
    }

    public function mount($id)
    {
        $this->contact = contact::where('id', $id)->first();
    }

    public function render()
    {

        // $contacts = contact::where('name', 'like', '%'.$this->search.'%')
        // ->where('created_at', '>', $this->whereDate)
        // ->where('profile_id', Auth::user()->id)
        // ->with('notes')
        // ->orderBy('id', 'desc')
        // ->paginate($this->perPage);

        $notes = agent_note::where('contact_id', $this->contact->id)->where('is_note', true)->get();
        $rdv = agent_note::where('contact_id', $this->contact->id)->where('is_note', false)->get();
        // dd($notes);

        return view('profiles.dashboard.notes', compact(['notes', 'rdv']))->layout('layouts.profile');
    }
}
