<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientEnquiryMail extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $clientName;
  public $prop_id;
  public $slug;


  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Enquiry submitted successfully',
    );
  }

  /**
   * Create a new message instance.
   */
  public function __construct($clientName, $prop_id, $slug)
  {
    $this->clientName = $clientName;
    $this->prop_id = $prop_id;
    $this->slug = $slug;
  }

  /**
   * Build the message.
   */
  public function build()
  {
    return $this->view('email.requestReceived')
      ->with([
        'clientName' => $this->clientName,
        'prop_id' => $this->prop_id,
        'slug' => $this->slug,
      ]);
  }
}
