<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\User;
use App\Notifications\NewUserRegistration;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUserRegistrationEmail
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //Notification class implements ShouldQueue for queueable mail send.
        Notification::send($event->user, new NewUserRegistration($event->user));
    }
}
