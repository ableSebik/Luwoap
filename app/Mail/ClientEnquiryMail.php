<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $clientName;
    public $prop_id;

    /**
     * Create a new message instance.
     */
    public function __construct($clientName, $prop_id)
    {
        $this->clientName = $clientName;
        $this->prop_id = $prop_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Enquiry Recieved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.requestRecieved',
            text: 'requestRecieved-text'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
