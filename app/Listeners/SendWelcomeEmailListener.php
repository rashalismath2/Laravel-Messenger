<?php

namespace App\Listeners;

use App\Events\SendNewWelcomeEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\WelcomeEmail;

class SendWelcomeEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendNewWelcomeEmailEvent  $event
     * @return void
     */
    public function handle(SendNewWelcomeEmailEvent $event)
    {
        Mail::to("Rashalismath@gmail.com")->send(new WelcomeEMail($event->user->name));
    }
}
