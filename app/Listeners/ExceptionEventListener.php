<?php

namespace App\Listeners;

use App\Events\ExceptionEvent;
use App\Mail\ExceptionHandlerEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ExceptionEventListener implements ShouldQueue
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
    public function handle(ExceptionEvent $event): void
    {
        $email = new ExceptionHandlerEmail(
            $event->when,
            $event->error,
            $event->message
        );

        $destination = "bugreport@top100filmes.com.br";

        $when = now()->addSeconds(10);
        Mail::to($destination)->later($when, $email);
    }
}
