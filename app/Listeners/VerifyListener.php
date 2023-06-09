<?php

namespace App\Listeners;

use App\Events\GetVerifyEven;
use App\Jobs\SendVerifyMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VerifyListener
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(GetVerifyEven $event)
    {
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            #$event->user->sendEmailVerificationNotification();
            SendVerifyMail::dispatch($event)->delay(now()->addSeconds(8));
        }
    }
}
