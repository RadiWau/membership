<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailForgetUser extends Mailable
{
    use Queueable, SerializesModels;
	protected $user;
	protected $rand_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $rand_code)
    {
        $this->user     	 = $user;
        $this->rand_code     = $rand_code;
		
    }

    public function build()
    {
        return $this->view('email.mail-link-forgot-password')->subject('Resset Password')->from(config("app.mail_form"))->with(["user"=>$this->user,"rand_code"=>$this->rand_code]);
		
    }
}
