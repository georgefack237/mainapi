<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $title;
    public $content;
    public $image;

    public $name;
    public $product;
    public $greeting;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $title, $content, $image_name, $name, $product)
    {
        $this->subject = $subject;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image_name;
        $this->name = $name;
        $this->product = $product;
        if (now()->hour < 12) {
            $this->greeting = 'Bonjour';
        } else {
            $this->greeting = 'Bonsoir';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mail.newsletter')->from('info@altechs.africa')->subject($this->subject);
        return $this->markdown('mail.newsletter')->from(Auth::user()->email)->subject($this->subject);
    }
}
