<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('visits:prune')
    ->daily()
    ->timezone((string) config('visits.timezone', 'Asia/Jakarta'));

Schedule::command('activity:prune')
    ->dailyAt('01:15')
    ->timezone((string) config('activity.timezone', 'Asia/Jakarta'))
    ->withoutOverlapping(30);
