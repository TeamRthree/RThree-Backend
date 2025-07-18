<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EnquiryToClient extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;

    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function envelope(): Envelope
    {
        $services = $this->enquiry->selections ?? [];
    $primary = $services[0] ?? 'your enquiry';
    
    return new Envelope(
        subject: "Thanks for contacting RThree Creatives about " . ucfirst($primary),
    );
    }

    public function content(): Content
    {
         return new Content(
        view: 'emails.enquiry-to-client',
        text: 'emails.enquiry-to-client-plain',
        with: [
            'enquiry' => $this->enquiry,
        ],
    );
    }

    public function attachments(): array
    {
        return [];
    }
}
