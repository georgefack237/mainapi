<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\contact;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\nfcprofile;
use App\Http\Controllers\SaveContact;
use App\Models\agent_note;
use App\Models\alert;
use App\Models\product;
use App\Models\Salecycle;
use Illuminate\Support\Str;

class Contacts extends Component
{

    use WithPagination;

    public $whereDate = '';

    public $newContactModal = false;
    public $name;
    public $title;
    public $email;
    public $phone;
    public $gender;

    public $fromDate;
    public $toDate;

    public $newNoteModal = false;
    public $contactId;

    public $newCycleModal = false;
    public $productId;
    public $products;

    public $note;

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

    public function saveConatctBatch()
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

    public function addContact()
    {
        $profileId = nfcprofile::where('user_id', Auth::user()->id)->where('master', true)->first();
        // dd($profileId->id);

        $contact = new contact;
        $contact->user_id = Auth::user()->id;
        $contact->profile_id = $profileId->id;
        $contact->name = $this->name;
        $contact->title = $this->title;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->gender = $this->gender;
        $contact->is_manual = false;
        $contact->has_cycle = false;
        $contact->save();

        $this->reset();
    }

    public function newNote($id)
    {
        $this->contactId = $id;
        $this->newNoteModal = true;
    }

    public function addNote()
    {
        $contact = contact::find($this->contactId);
        $contact->note = $this->note;
        $contact->save();
        $this->reset();
    }

    public function newCycle($id)
    {
        $this->contactId = $id;
        $this->newCycleModal = true;
    }

    public function createCycle()
    {

        $profileId = nfcprofile::where('user_id', Auth::user()->id)->where('master', true)->first();
        $contact = contact::where('id', $this->contactId)->first();
        $product = contact::where('id', $this->productId)->first();
        // dd($profileId->id);

        $cycle = new Salecycle;
        $cycle->user_id = Auth::user()->id;
        $cycle->profile_id = $profileId->id;
        $cycle->product_id = $this->productId;
        $cycle->contact_id = $this->contactId;
        $cycle->is_lead = true;
        $cycle->status = 'commercial';
        $cycle->is_lead_date = now();
        $cycle->save();

        $contact = contact::find($this->contactId);
        $contact->has_cycle = true;
        $contact->save();

        $alert = new alert();
        $alert->title = 'Nouvaux Cycle de vente';
        $alert->description = "Un nouveau cycle de vente vient d'être initié" . $contact->name . "sur le produit" . $product->name . "";
        $alert->icon = 'bi bi-bag-plus';
        $alert->user_id = Auth::user()->id;
        $alert->profile_id = $profileId->id;
        $alert->save();

        $this->newCycleModal = false;
    }

    public function mount()
    {
        $this->products = product::all();

        $this->fromDate = now()->subYears(3);
        $this->toDate = now()->addYears(3);
    }

    public function render()
    {

        $contacts = contact::addSelect(['lastNote' => agent_note::select('body')
            ->whereColumn('contact_id', 'contacts.id')
            ->latest()
            ->take(1)
        ])->where('name', 'like', '%'.$this->search.'%')
        ->where('created_at', '>', $this->whereDate)
        ->where('user_id', Auth::user()->id)
        ->whereBetween('created_at', [$this->fromDate, $this->toDate])
        ->with('nfcprofile')
        ->orderBy('id', 'desc')
        ->get();

        // if(Auth::user()->user_type == 1)
        // {
        //     $contacts = contact::where('name', 'like', '%'.$this->search.'%')
        //     ->where('created_at', '>', $this->whereDate)
        //     ->with('nfcprofile')
        //     ->orderBy('id', 'desc')
        //     ->paginate($this->perPage);
        // } else {
        //     $contacts = contact::where('name', 'like', '%'.$this->search.'%')
        //     ->where('user_id', Auth::user()->id)
        //     ->where('created_at', '>', $this->whereDate)
        //     ->with('nfcprofile')
        //     ->orderBy('id', 'desc')
        //     ->paginate($this->perPage);
        // }
        // dd(now()->subDays(7)->format('d M Y'));
        // dd($contacts);

        return view('livewire.test', compact('contacts'));
    }
}
