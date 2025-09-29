<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use auth;


class NotifSignature extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     
     public  $contact;
     
    public function __construct($v1, $v2, $codeClient)
    {
        $this->v1 = $v1;
        $this->v2 = $v2;
        $this->codeClient = $codeClient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        return $this->subject("New signature from formulaire Sales Management")->view('mail.notifSignature', [ 'v1' => $this->v1, 'v2' => $this->v2, 'codeClient' => $this->codeClient ]);
    }
    
    
    
    
}
