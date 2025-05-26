<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailResendVendor extends Mailable
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

    public function build()
    {
        return $this->view('email.email_confirm_vendor')->subject('Pendaftaran Anda Berhasil')->from(config("app.mail_form"))->with("data", $this->user);     
        // return $this->view('email.email_confirm_vendor')->subject('Pendaftaran Anda Berhasil')->from(config("app.mail_form"))->with("data", $this->vendor);     
		
    }
}
