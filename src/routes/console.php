<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:send-mail-command')->dailyAt('09:00');
