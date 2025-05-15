<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    public function handle(Verified $event)
    {
        Mail::to($event->user->email)->send(new \App\Mail\WelcomeEmail($event->user));
    }
}
