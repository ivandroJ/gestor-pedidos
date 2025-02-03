<?php

use App\Actions\Pedidos\SendNotificationPendentPedidosAction;
use App\Jobs\Pedidos\SendNotificationMailJob;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

/* Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
 */


Schedule::call(function () {
    $action = new SendNotificationPendentPedidosAction();
    $action->execute();
})->dailyAt('07:00');
