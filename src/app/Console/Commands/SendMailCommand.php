<?php

namespace App\Console\Commands;

use App\Mail\ReservationNotification;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    protected $signature = 'app:send-mail-command';

    protected $description = '予約日の午前9時に予約確認メールを送信するコマンド';

    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $reservations = Reservation::whereDate('date', $today)->get();

        foreach ($reservations as $reservation) {
            $user = $reservation->user;
            $shop = $reservation->shop;

            if (!$user || !$shop) {
                $this->error('予約に関連するユーザーまたは店舗が見つかりませんでした。');
                continue;
            }

            Mail::to($user->email)->send(new ReservationNotification($reservation, $user, $shop));

            $this->info('メールを送信しました: ' . $user->email);
        }
    }
}
