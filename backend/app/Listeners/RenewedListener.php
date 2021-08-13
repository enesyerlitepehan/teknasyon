<?php

namespace App\Listeners;

use App\Events\Renewed;
use Illuminate\Support\Facades\Log;
use App\Helpers\ThirdPartyApi;

class RenewedListener
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
     * @param  Renewed  $event
     * @return void
     */
    public function handle(Renewed $event)
    {
        Log::info('Renewed Listener!');
        error_log('event here: ' . json_encode($event, true));
        ThirdPartyApi::thirdPart($event->renewed->id, $event->renewed->appId, 'Renewed');
    }
}
