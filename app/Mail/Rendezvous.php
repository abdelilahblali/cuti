<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use auth;


class Rendezvous extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     
     public  $contact;
     
    public function __construct($contact)
    {
        $this->details = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        $dat = $req->input('dat');
        $obs = $req->input('obs');
        $client = Auth::user()->nom.' '.Auth::user()->pre;

        return $this->subject('MonProjetBali : Rendez-Vous')->view('mail.rendezvous', [ 'dat' => $dat, 'obs' => $obs , 'client' => $client ]);
    }
    
    
    
    
}
