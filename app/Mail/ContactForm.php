<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *
     * @var type
     */
    public $user;

    /**
     *
     * @var string
     */
    public $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $user, string $text )
    {
        $this->user = $user;
        $this->text = $text;
        $this->subject('Wiadomość z formularza kontaktu');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact-form');
    }
}
