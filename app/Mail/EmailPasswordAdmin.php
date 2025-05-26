<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPasswordAdmin extends Mailable
{
    use Queueable, SerializesModels;
	protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
		
    }

    /**
     * Build the message.
     *
	 
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email_password')->subject('Pedaftaran Sukses')->from(config("app.mail_form"))->with("data", $this->user);       
		
    }
}
