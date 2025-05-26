<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAktifasiVendor extends Mailable
{
    use Queueable, SerializesModels;
	protected $user;
	protected $user_data;
    
    public function __construct($user, $user_data)
    {
        $this->user = $user;
        $this->user_data = $user_data;
		
    }

    /**
     * Build the message.
     *
	 
     * @return $this
     */
    public function build()
    {
        return $this->view('email.mail-link-activation')->subject('Form Activation')->from(config("app.mail_form"))->with(['email'=>$this->user, 'user_data'=>$this->user_data]);     
        
    }
}
