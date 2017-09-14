<?php

namespace App\Tracker\Messaging;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DashboardEmailLink extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var
     */
    public $msg;

    /**
     * Create a new message instance.
     *
     * @param $message
     */
    public function __construct($message)
    {
        $this->msg = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->from('chrismichaels84@gmail.com')
            ->subject('Your Recovery Status Tracker Link')
            ->view('email.dashboard.link');
    }
}
