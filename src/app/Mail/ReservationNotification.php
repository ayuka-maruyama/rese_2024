<?php

namespace App\Mail;


use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ReservationNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    // __constructでメールに必要な情報を渡すための記述（モデルの内容をプロパティに保持する）
    public $reservation;
    public $user;
    public $shop;

    public function __construct(Reservation $reservation, User $user, Shop $shop)
    {
        // メールに必要なデータを初期化するメソッド
        // 例: 予約情報を引数として受け取り、プロパティとして保持する場合はここで処理
        $this->reservation = $reservation;
        $this->user = $user;
        $this->shop = $shop;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // メール件名や差出人を設定する場所
        return new Envelope(
            subject: '予約情報のお知らせ',
            from: new Address(config('mail.from.address'), config('mail.from.name'))
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // メール本文を設定する場所（bladeファイルを作成して、その作成した内容を表示することも可能）
        return new Content(
            view: 'emails.reservation-notification',
            with: [
                'reservation' => $this->reservation,
                'user' => $this->user,
                'shop' => $this->shop,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // メールに添付ファイルを追加するためのメソッド（QRコードの画像を添付したりすることができる）
        // 例: 添付ファイルがない場合は空の配列を返す
        return [];
    }
}
