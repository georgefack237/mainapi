<?php

namespace App\Http\Livewire\Prospection;

use App\Models\alert;
use App\Models\appointment;
use App\Models\contact;
use App\Models\nfcprofile;
use App\Models\product;
use App\Models\purchase;
use App\Models\Salecycle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Clients extends Component
{

    public $whereDate = '';
    public $search = '';
    public $type = '';
    public $observation = '';
    public $agentId;
    public $productId;
    public $fromDate;
    public $toDate;

    public $appointmentModal = false;
    public $modalTitle;
    public $appointment;
    public $title;
    public $Type;
    public $note;
    public $Observation;
    public $cost;
    public $appointmentId;

    public $date;
    public $showDate = true;
    public $cycleId;
    public $contactId;
    public $profileId;

    public function mount()
    {
        $this->fromDate = now()->subYears(3);
        $this->toDate = now()->addYears(3);
    }

    public function render()
    {

        $leads = Salecycle::select(['salecycles.*', 'contacts.name as contact_name', 'contacts.id as contact_id'])
            ->join('contacts', 'salecycles.contact_id', '=', 'contacts.id')
            ->when($this->observation, function ($query, $observation) {
                $query->whereHas('appointments', function ($query) use ($observation) {
                    $query->where('observation', 'like', '%' . $observation . '%');
                });
            })
            ->with(['appointments' => function ($query) {
                $query->where('observation', 'like', '%' . $this->observation . '%');
            }])
            ->where('salecycles.user_id', Auth::user()->id)
            ->where('salecycles.is_client', true)
            ->where('salecycles.status', 'like', '%' . $this->type . '%')
            ->where('salecycles.profile_id', 'like', '%' . $this->agentId . '%')
            ->where('salecycles.product_id', 'like', '%' . $this->productId . '%')
            ->where('contacts.name', 'like', '%' . $this->search . '%')
            ->whereBetween('salecycles.is_lead_date', [$this->fromDate, $this->toDate])
            ->orderBy('id', 'desc')
            ->get();

        $products = product::where('user_id',  Auth::user()->id)->get();
        $agents = nfcprofile::where('user_id',  Auth::user()->id)->get();

        return view('livewire.prospection.clients', compact(['leads', 'products', 'agents']));
    }

    public function resetFilter()
    {
        $this->reset();
        $this->fromDate = now()->subYears(3);
        $this->toDate = now()->addYears(3);
    }

    public function showAppointmentModal($id)
    {
        $appointment = appointment::find($id);
        $this->title = $appointment->title;
        $this->Type = $appointment->type;
        $this->note = $appointment->note;
        $this->Observation = $appointment->observation;
        $this->cost = $appointment->cost;
        $this->appointmentId = $id;

        $this->modalTitle = 'Modifier rendez-vous';
        $this->showDate = false;
        $this->appointmentModal = true;
    }

    public function showNewApointmentModal($id)
    {
        $this->reset();
        $this->fromDate = now()->subYears(3);
        $this->toDate = now()->addYears(3);

        $cycle = Salecycle::where('id', $id)->first();
        $this->cycleId = $id;
        $this->contactId = $cycle->contact_id;
        $this->profileId = $cycle->profile_id;

        $this->modalTitle = 'Ajouter un rendez-vous';
        $this->appointmentModal = true;
    }

    public function recordAppointment()
    {

        $rdv = new appointment();
        $rdv->user_id = Auth::user()->id;
        $rdv->salecycle_id = $this->cycleId;
        $rdv->profile_id = $this->profileId;
        $rdv->contact_id = $this->contactId;
        $rdv->title = $this->title;
        $rdv->start = $this->date;
        $rdv->type = $this->Type;
        $rdv->note = $this->note;
        $rdv->observation = $this->Observation;
        $rdv->cost = $this->cost;
        $rdv->save();

        $alert = new alert();
        $alert->title = 'Nouvaux Rendez-vous';
        $alert->description = "Un nouveau rendez-vous vient de d'enregistrer";
        $alert->icon = 'bi bi-calendar2-plus';
        $alert->user_id = Auth::user()->id;
        $alert->profile_id = $this->profileId;
        $alert->save();


        $this->reset();
        $this->fromDate = now()->subYears(3);
        $this->toDate = now()->addYears(3);

        $this->appointmentModal = false;
    }

    public function updateAppointment()
    {
        $appointment = appointment::find($this->appointmentId);
        $appointment->title = $this->title;
        $appointment->type = $this->Type;
        $appointment->note = $this->note;
        $appointment->observation = $this->Observation;
        $appointment->cost = $this->cost;
        $appointment->save();

        $this->appointmentModal = false;
    }

    public function allLeads()
    {
        $this->type = '';
    }

    public function processing()
    {
        $this->type = 'en cours';
    }

    public function validated()
    {
        $this->type = 'validé';
    }

    public function lost()
    {
        $this->type = 'perdu';
    }

    public function makeOpportunityLost($id)
    {
        $cycle = Salecycle::find($id);
        $cycle->status = 'perdu';
        $cycle->save();
    }

    public function makeClientt($id)
    {
        $cycle = Salecycle::find($id);
        $cycle->is_lead = false;
        $cycle->is_client = true;
        $cycle->is_cient_date = now();
        $cycle->save();
    }

    public function recordSale($id)
    {
        $cycle = Salecycle::find($id);
        // dd($cycle);

        $sale = new purchase();
        $sale->user_id = Auth::user()->id;
        $sale->profile_id = $cycle->profile_id;
        $sale->salecycle_id = $cycle->id;
        $sale->contact_id = $cycle->contact_id;
        $sale->product_id = $cycle->product_id;
        $sale->amount = $cycle->product->price;
        $sale->save();

        $cycle->is_opportunity = false;
        $cycle->is_client = true;
        $cycle->status = 'validé';
        $cycle->is_client_date = now();
        $cycle->save();

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
}


