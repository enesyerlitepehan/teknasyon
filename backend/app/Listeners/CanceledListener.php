<?php

namespace App\Listeners;

use App\Events\Canceled;
use App\Helpers\thirdPartyApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CanceledListener
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
     * @param  Canceled  $event
     * @return void
     */
    public function handle(Canceled $event)
    {
        Log::info('Canceled Listener!');
        ThirdPartyApi::thirdPart($event->cancelled->id, $event->cancelled->appId, 'Canceled');
    }
}
