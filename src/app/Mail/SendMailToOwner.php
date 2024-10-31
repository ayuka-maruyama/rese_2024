<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SendMailToOwner extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subjectLine;
    public $bodyContent;

    public function __construct($user, $subjectLine, $bodyContent)
    {
        $this->user = $user;
        $this->subjectLine = $subjectLine;
        $this->bodyContent = $bodyContent;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    // メールに表示するviewの設定箇所
    public function content(): Content
    {
        return new Content(
            view: 'emails.send-mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
