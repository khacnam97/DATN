<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Accept;

class AcceptCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Accept $accept)
    {
     $this->accept = $accept;
 }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->view('email.accept');
    }
}
