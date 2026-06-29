<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientEnquiryMail extends Mailable
{
  use SerializesModels;

  public $clientName;
  public $prop_id;

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
  public function __construct($clientName, $prop_id)
  {
    $this->clientName = $clientName;
    $this->prop_id = $prop_id;
  }

  /**
   * Build the message.
   */
  public function build()
  {
    return $this->view('email.clientContactNotification')
      ->with([
        'clientName' => $this->clientName,
        'prop_id' => $this->prop_id,
      ]);
  }
}
