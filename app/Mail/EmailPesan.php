<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailPesan extends Mailable
{
    use Queueable, SerializesModels;
	protected $pesan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pesan)
    {
        $this->pesan = $pesan;
		
    }

    /**
     * Build the message.
     *
	 
     * @return $this
     */
    public function build()
    {
         return $this->view('email.email_pesan_vendor')->subject($this->pesan->{'judul'})
		
			->from(config("app.mail_form"))
			->with("data", $this->pesan)
			->attach(storage_path("app/public/".$this->pesan->{'path_pesan'}.""));          
        
    }
}
