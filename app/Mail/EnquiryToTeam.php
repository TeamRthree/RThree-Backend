<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EnquiryToTeam extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;

    public function __construct($enquiry)
    {
        $this->enquiry = $enquiry;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📩 New Enquiry from ' . $this->enquiry->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.enquiry-to-team',
            text: 'emails.enquiry-to-team-text',
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