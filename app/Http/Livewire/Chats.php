<?php

namespace App\Http\Livewire;

use App\Http\Controllers\MailController;
use App\Models\contact;
use App\Models\newsletter;
use App\Models\nfcprofile;
use App\Models\product;
use App\Models\Salecycle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chats extends Component
{
    public $loader = false;
    public $search = '';

    public $subject;
    public $title;
    public $content;
    public $constraint;
    public $writeMail = false;
    public $showMail = false;

    public $mail;

    public $recipients;

    // Filters
    public $productId;
    public $lead = false;
    public $prospect = false;
    public $opportunity = false;
    public $client = false;

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
        $mails = newsletter::where('user_id',  Auth::user()->id)->orderBy('id', 'desc')->get();

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

            $profiles = nfcprofile::where('firstname', 'like', '%' . $this->search . '%')
                ->where('user_id', Auth::user()->id)
                ->orderBy('id', 'desc')->get();

        return view('livewire.chats', compact(['contacts', 'products', 'mails', 'profiles']));
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
        // dd($this->recipients);
        // $this->loader = true;

        $sendmails = new MailController;
        $sendmails->sendMail($this->recipients, $this->subject, $this->title, $this->content);

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

    public function renderEditor()
    {
        return $this->dispatchBrowserEvent('newMail');
    }
}
