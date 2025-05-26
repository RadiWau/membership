<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInfoRegisMember extends Mailable
{
    use Queueable, SerializesModels;
	protected $user_data;

    public function __construct($data_regis)
    {
        $this->data_regis   = $data_regis;

    }

    /**
     * Build the message.
     *

     * @return $this
     */
    public function build()
    {
        return $this->view('email.mail-after-register')->subject('Registrasi Berhasil')->from(config("app.mail_form"))->with(['data_regis'=>$this->data_regis]);

    }
}
