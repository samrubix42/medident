<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class IntakeNotification extends Mailable
{
    /**
     * @param  list<array{label: string, value: string}>  $details
     */
    public function __construct(
        public string $heading,
        public string $intro,
        public array $details,
        public string $emailSubject,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.intake-notification',
            text: 'mail.intake-notification-text',
            with: [
                'heading' => $this->heading,
                'intro' => $this->intro,
                'details' => $this->details,
            ],
        );
    }
}
