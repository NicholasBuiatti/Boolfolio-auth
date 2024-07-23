<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewLeadMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $lead;
    public function __construct($lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        //RITORNO UN OGGETTO CHE DEFINISCE IL MESSAGGIO DI E A CHI VIENE INVIATO
        return new Envelope(
            subject: 'New Lead Message',
            replyTo: $this->lead->email,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        //FA VEDERE NELLA VIEW CREATA L'EMAIL
        return new Content(
            markdown: 'make:mail',
            view: 'mail.NewLeadMessage'
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
