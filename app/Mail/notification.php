<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class notification extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $title;
    public $content;
    public $image;
    public $logo;

    public $name;
    public $greeting;

    public function __construct($subject, $mailTitle, $content, $image_name, $name, $logo)
    {
        $this->subject = $subject;
        $this->title = $mailTitle;
        $this->content = $content;
        $this->image = $image_name;
        $this->logo = $logo;
        $this->name = $name;
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
        return $this->markdown('mail.notification')->from('herve.likeng@altechs.africa')->subject($this->subject);
    }
}
