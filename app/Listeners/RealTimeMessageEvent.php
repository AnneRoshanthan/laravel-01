<?php

namespace App\Listeners;

use App\Events\RealTimeMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RealTimeMessageEvent
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
    public function handle(RealTimeMessage $event)
    {
        $message = $event->message;
        Log::info($message);
    }
}
