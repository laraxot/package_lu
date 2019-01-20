<?php

namespace XRA\LU\Listeners;

use XRA\LU\Events\TestEvent;

class TestListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserSavingEvent $event
     * @return mixed
     */
    public function handle(TestEvent $event)
    {
        echo 'echo?';
        app('log')->info($event->msg);
    }
}

//https://pineco.de/keep-the-code-clean-with-laravel-events/
/*
public function handle(Created $event)
    {
         Mail::to($event->user)->send(new WelcomeEmail($event->user));
    }


*/