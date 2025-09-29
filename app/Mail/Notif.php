<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use auth;


class Notif extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     
     public  $contact;
     
    public function __construct($notification, $user_ref)
    {
        $this->notification = $notification;
        $this->user_ref = $user_ref;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        return $this->subject('HR Management : '.$this->notification)->view('mail.notif', [ 'notification' => $this->notification, 'user_ref' => $this->user_ref ]);
    }
    
    
    
    
}
