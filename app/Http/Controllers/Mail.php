<?php

namespace App\Http\Controllers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use  App\Mail\mailcontact;



class Mail extends Controller
{
    
	// public function sendEmail(){
	// 	$details=[
	// 		'titile'=>'mail from',
	// 		'body'=>'yeees'

	// 	];
	// 	\ Mail::to('contact@ecombladi.com')->send(new mailcontact($details) );

	// 	session()->flash('Valide',"Votre message a été envoyé avec succès");
	// 	return redirect("contacteznous"); 

	// }

}
