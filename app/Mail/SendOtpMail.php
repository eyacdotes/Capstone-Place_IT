<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        //
        $this->otp = $otp;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'User Verification',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.otp',
        );
    }

    public function attachments()
    {
        return [];
    }
    public function build()
    {
        return $this->view('emails.otp') // Ensure you have the right view here
                    ->subject('One-Time Passcode')
                    ->with(['otp' => $this->otp]);
    }
    
}
