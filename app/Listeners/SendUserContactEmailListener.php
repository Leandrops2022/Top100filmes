<?php

namespace App\Listeners;

use App\Events\SendUserContactEMail;
use App\Mail\UserSiteContactEMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserContactEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendUserContactEMail $event): void
    {
        $email = new UserSiteContactEMail(
            $event->name,
            $event->age,
            $event->contactType,
            $event->message
        );

        $destination = "$event->contactType@top100filmes.com.br";

        $when = now()->addSeconds(5);
        Mail::to($destination)->later($when, $email);
    }
}
