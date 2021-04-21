<?php

namespace App\Listeners;

use App\Events\BookinLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class BookinLogListener
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
     * @param  BookinLogEvent  $event
     * @return void
     */
    public function handle(BookinLogEvent $event)
    {
        Log::info($event->writeMessage());
    }
}
