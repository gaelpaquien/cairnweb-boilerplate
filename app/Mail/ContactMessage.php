<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Statamic\Facades\GlobalSet;

class ContactMessage extends Mailable
{
    public function __construct(
        public readonly array $data,
    ) {}

    public function envelope(): Envelope
    {
        $prefix = GlobalSet::findByHandle('contact')?->inCurrentSite()?->get('email_subject_prefix') ?? '';

        $envelope = new Envelope(
            subject: trim("{$prefix} - {$this->data['first_name']} {$this->data['last_name']}", ' -'),
        );

        if (!empty($this->data['email'])) {
            $envelope->replyTo($this->data['email']);
        }

        return $envelope;
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.contact',
        );
    }
}
