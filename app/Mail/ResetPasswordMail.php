<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $password;
    public function __construct($password)
    {
        $this->password = $password;
    }

    public function build()
    {
        return $this->markdown('emails.passwordReset')
                    ->subject('Reset Password Mail')
                    ->with([
                        'resetPassword' => $this->password,
                    ])
                    ->from('code.faiq786@gmail.com', 'Exkhata');
    }
}
