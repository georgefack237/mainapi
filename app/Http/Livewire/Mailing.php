<?php

namespace App\Http\Livewire;

use App\Http\Controllers\MailController;
use App\Models\contact;
use App\Models\newsletter;
use App\Models\product;
use App\Models\Salecycle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Mailing extends Component
{
    use WithFileUploads;

    public $loader = false;
    public $search = '';

    public $subject;
    public $title;
    public $content;
    public $image;
    public $writeMail = false;
    public $showMail = false;

    public $mail;

    public $recipients;

    // Send Mail Filters
    public $productId;
    public $lead = false;
    public $prospect = false;
    public $opportunity = false;
    public $client = false;

    // Mail history Filters
    public $is_lead = false;
    public $is_prospect = false;
    public $is_opportunity = false;
    public $is_client = false;

    public $bg = 'white';

    protected $listener = ['showEditor' => 'renderEditor'];

    public function mount()
    {
        $this->renderEditor();
        // $this->mail = newsletter::find(24);
    }

    public function render()
    {
        // dd($this->mail);
        $this->renderEditor();
        $this->dispatchBrowserEvent('newMail');
        $products = product::where('user_id',  Auth::user()->id)->get();

        $mails = newsletter::select(['newsletters.*', 'salecycles.is_lead', 'salecycles.is_prospect', 'salecycles.is_opportunity', 'salecycles.is_client'])
        ->join('salecycles', 'newsletters.salecycle_id', '=', 'salecycles.id')
        ->where('newsletters.user_id',  Auth::user()->id)->orderBy('id', 'desc')
        ->where('salecycles.is_lead',  'like', '%' . $this->is_lead . '%')
        ->Where('salecycles.is_prospect',  'like', '%' . $this->is_prospect . '%')
        ->Where('salecycles.is_opportunity',  'like', '%' . $this->is_opportunity . '%')
        ->Where('salecycles.is_client',  'like', '%' . $this->is_client . '%')
        ->Where('recipient',  'like', '%' . $this->search . '%')
        ->get();

        $this->recipients = Salecycle::select(['salecycles.*', 'contacts.name as contact_name', 'contacts.email'])
        ->join('contacts', 'salecycles.contact_id', '=', 'contacts.id')
        ->where('salecycles.user_id', Auth::user()->id)
        ->where('salecycles.product_id', 'like', '%' . $this->productId . '%')
        ->where('salecycles.is_lead', $this->lead)
        ->Where('salecycles.is_prospect', $this->prospect)
        ->Where('salecycles.is_opportunity', $this->opportunity)
        ->Where('salecycles.is_client', $this->client)
        ->orderBy('id', 'desc')
        ->get();

        $contacts = contact::select('name', 'email')
            ->where('user_id', Auth::user()->id)
            ->where('email', '!=', '')
            ->get();

        return view('livewire.mailing', compact(['contacts', 'products', 'mails']));
    }

    public function getMail($id)
    {
        $this->mail = newsletter::find($id);
        $this->showMail = true;
    }

    public function newMail()
    {
        $this->dispatchBrowserEvent('newMail');
        $this->bg = 'white';
        $this->writeMail = true;
    }

    public function sendMail()
    {
        // dd($this->content);
        if($this->image != null) {
            $this->validate([
                'image' => 'image|max:1024', // 1MB Max
            ]);

            $image_name = $this->image->getClientOriginalName();
            $this->image->storeAs('public/img/nfc/adverts', $image_name);
        }
        else {
            $image_name = 'default.jpg';
        }
        // dd($image_name);
        // $this->loader = true;

        $sendmails = new MailController;
        $sendmails->sendMail($this->recipients, $this->subject, $this->title, $this->content, $image_name);

        $this->reset();
        // $this->loader = false;
    }

    public function leads()
    {
        $this->lead = true;
        $this->prospect = false;
        $this->opportunity = false;
        $this->client = false;
    }

    public function prospects()
    {
        $this->lead = false;
        $this->prospect = true;
        $this->opportunity = false;
        $this->client = false;
    }

    public function opportunities()
    {
        $this->lead = false;
        $this->prospect = false;
        $this->opportunity = true;
        $this->client = false;
    }

    public function clients()
    {
        $this->lead = false;
        $this->prospect = false;
        $this->opportunity = false;
        $this->client = true;
    }

    public function is_leads()
    {
        $this->is_lead = true;
        $this->is_prospect = false;
        $this->is_opportunity = false;
        $this->is_client = false;
    }

    public function is_prospects()
    {
        $this->is_lead = false;
        $this->is_prospect = true;
        $this->is_opportunity = false;
        $this->is_client = false;
    }

    public function is_opportunities()
    {
        $this->is_lead = false;
        $this->is_prospect = false;
        $this->is_opportunity = true;
        $this->is_client = false;
    }

    public function is_clients()
    {
        $this->is_lead = false;
        $this->is_prospect = false;
        $this->is_opportunity = false;
        $this->is_client = true;
    }

    public function renderEditor()
    {
       return $this->dispatchBrowserEvent('newMail');
    }
}
