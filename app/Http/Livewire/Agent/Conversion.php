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
use App\Models\product;
use App\Models\purchase;

class Conversion extends Component
{

    use WithPagination;

    public $whereDate = '';
    public $isClient = '';

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 50;

    public $saleModal = false;
    public $appointmentModal = false;

    public $name;
    public $amount;
    public $description;
    public $product;
    public $contactId;
    public $profileId;

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

    public function showSaleModal($id)
    {
        $contact = contact::where('id', $id)->first();
        $this->contactId = $contact->id;
        $this->profileId = $contact->profile_id;
        $this->saleModal = true;
    }

    public function showApointmentModal()
    {
        $this->appointmentModal = true;
    }

    public function recordSale()
    {

        $sale = new purchase();
        $sale->user_id = Auth::user()->id;
        $sale->profile_id = $this->profileId;
        $sale->contact_id = $this->contactId;
        $sale->product_id = $this->product;
        $sale->amount = $this->amount;
        $sale->description = $this->description;
        $sale->save();

        contact::find($this->contactId)->update([
            'is_client' => true,
            'converted_at' => now()
        ]);

        $alert = new alert();
        $alert->title = 'Nouvelle Achat';
        $alert->description = 'lorem Ipsum dolor vient de faire un nouvel achat';
        $alert->icon = 'bi bi-cart-plus';
        $alert->user_id = Auth::user()->id;
        $alert->profile_id = $this->profileId;
        $alert->save();


        $this->reset();

        $this->saleModal = false;
    }

    public function isClient()
    {
        $this->isClient = 1;
    }

    public function isProspect()
    {
        $this->isClient = 0;
    }

    public function render()
    {

        $contacts = contact::where('name', 'like', '%' . $this->search . '%')
            ->where('created_at', '>', $this->whereDate)
            // ->where('is_client', $this->isClient)
            ->where('profile_id', Auth::user()->id)
            ->with('nfcprofile', 'appointments', 'purchases')
            ->orderBy('id', 'desc')
            ->get();

        $products = product::where('user_id', Auth::user()->id)->get();

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

        return view('profiles.dashboard.conversion', compact('contacts', 'products'))->layout('layouts.profile');
    }
}
