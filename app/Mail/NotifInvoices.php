<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use auth;


class NotifInvoices extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     
     public  $contact;
     
    public function __construct($msg, $page, $langue, $field)
    {
        $this->msg = $msg;
        $this->page = $page;
        $this->langue = $langue;
        $this->field = $field;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        return $this->subject($this->msg)->view('mail.notifInvoices', [ 'msg' => $this->msg, 'page' => $this->page, 'langue' => $this->langue, 'field' => $this->field ]);
    }
    
    
    
    
}
