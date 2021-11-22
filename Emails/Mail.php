<?php

namespace Modules\Ledger\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var User
     */
    protected $user;
    protected $file_path;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $file_path="")
    {
        $this->user = $user;
        $this->file_path = $file_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->markdown('Ledger::mail.notification')->subject($this->user->email_subject)->with('user', $this->user);
    }
}
