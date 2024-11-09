<?php

namespace App\Mail;


use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ReservationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $user;
    public $shop;

    public function __construct(Reservation $reservation, User $user, Shop $shop)
    {
        $this->reservation = $reservation;
        $this->user = $user;
        $this->shop = $shop;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '予約情報のお知らせ',
            from: new Address(config('mail.from.address'), config('mail.from.name'))
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation-notification',
            with: [
                'reservation' => $this->reservation,
                'user' => $this->user,
                'shop' => $this->shop,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
