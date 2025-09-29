<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class mailcontact extends Mailable
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
        $this->details=$contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        $contact=[
        $nom    =  $req->input('nom'),
        $pre   =  $req->input('pre'),
        $tel    = $req->input('tel'),
        $mail   = $req->input('mail'),
        $msg    = $req->input('msg')
         ];
         
             
        return $this->subject('Nouveau Email : EcomBladi')->view('mail.contact', ['nom' => $nom,'pre' => $pre,'tel' => $tel,'mail' => $mail,'msg' => $msg]);
    }
    
    
    
    
}
