<?php

namespace App\Console\Commands;

use App\Mail\Ordered;
use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Mail\ReservationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // コマンドを実行するときの名前を指定している
    protected $signature = 'app:send-mail-command';

    /**
     * The console command description.
     *
     * @var string
     */
    // コマンドの説明を定義することができる
    protected $description = '予約日の午前9時に予約確認メールを送信するコマンド';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ここにコマンドが実行されたときに動作する内容を定義する
        // 今日の予約を取得
        $today = Carbon::today()->toDateString();
        $reservations = Reservation::whereDate('date', $today)->get();

        foreach ($reservations as $reservation) {
            $user = $reservation->user;  // ユーザー情報を取得
            $shop = $reservation->shop;  // 店舗情報を取得

            // ユーザーや店舗が存在するか確認
            if (!$user || !$shop) {
                $this->error('予約に関連するユーザーまたは店舗が見つかりませんでした。');
                continue;  // 次の予約に進む
            }

            // メール送信
            Mail::to($user->email)->send(new ReservationNotification($reservation, $user, $shop));

            $this->info('メールを送信しました: ' . $user->email);
        }
    }
}
