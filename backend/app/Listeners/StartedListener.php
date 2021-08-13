<?php

namespace App\Listeners;

use App\Events\Started;
use App\Helpers\thirdPartyApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class StartedListener
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
     * @param  Started  $event
     * @return void
     */
    public function handle(Started $event)
    {
        Log::info('Started Listener!');
        ThirdPartyApi::thirdPart($event->started->id, $event->started->appId, 'Started');
    }
}
