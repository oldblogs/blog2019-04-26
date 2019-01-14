<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Clarkeash\Doorman\Facades\Doorman;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param Clarkeash\Doorman\Models\Invite $invitation
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from_mail = config('mail.from.address', 'info@example.com');
        $from_name = config('mail.from.name', 'blog');

        return $this->from($from_mail, $from_name)
                    ->view('emails.invitation');
    }
}
