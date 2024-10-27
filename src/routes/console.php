<?php

// use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\SendMailCommand;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// 毎日朝9時にcommandファイルで定義した内容を実行する
Schedule::command('app:send-mail-command')->dailyAt('09:20');
