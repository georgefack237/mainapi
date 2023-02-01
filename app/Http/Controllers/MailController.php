<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter;
use App\Mail\notification;
use App\Models\newsletter as ModelsNewsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail($recipients, $subject, $title, $content, $image_name)
    {
        if (now()->hour < 12) {
            $greeting = 'Bonjour';
        } else {
            $greeting = 'Bonsoir';
        }

        foreach ($recipients as $recipient) {
            $name = $recipient->contact->name;
            $product = $recipient->product->name;
            Mail::to($recipient->contact->email)->send(new Newsletter($subject, $title, $content, $image_name, $name, $product));
            // return new Newsletter();
            $history = new ModelsNewsletter();
            $history->user_id = Auth::user()->id;
            $history->salecycle_id = $recipient->id;
            $history->product = $product;
            $history->recipient = $name;
            $history->recipient_email = $recipient->contact->email;
            $history->subject = $subject;
            $history->title = $title;
            $history->greeting = $greeting;
            $history->content = $content;
            $history->image = $image_name;
            $history->save();
        }
    }

    public function sendMailLawyers($recipients, $subject, $mailTitle, $content, $image_name, $logo)
    {
        $name = $recipients[0]->first_name;
        Mail::to('georgefack237@gmail.com')->send(new notification($subject, $mailTitle, $content, $image_name, $name, $logo));
    }

    
    public function sendMailLawyer($recipients, $subject, $mailTitle, $content, $image_name, $logo)
     {
         foreach ($recipients as $recipient) {
             $name = $recipient->first_name .' '. $recipient->last_name;
            dd($name);
            Mail::to($recipient->mail)->send(new notification($subject, $mailTitle, $content, $image_name, $name, $logo));
        }
    }
}
