<?php

namespace App\Mail;

use App\Models\ClientRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewClientRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The client request instance.
     *
     * @var \App\Models\ClientRequest
     */
    public $clientRequest;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\ClientRequest  $clientRequest
     * @return void
     */
    public function __construct(ClientRequest $clientRequest)
    {
        $this->clientRequest = $clientRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(env('APP_ADMIN_EMAIL'))
            ->from(env('MAIL_FROM_ADDRESS'))
            ->view('emails.client_request');
    }
}
