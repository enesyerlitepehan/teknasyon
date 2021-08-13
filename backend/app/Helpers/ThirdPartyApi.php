<?php

namespace App\Helpers;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class thirdPartyApi
{
    public static function thirdPart($deviceId, $appId, $eventType)
    {
        Log::info('# ThirdPart started');
        Http::fake(function (Request $request) {
            return Http::response(['status' => 'true'], 200, ['Headers']);
        });

        return Http::post('ios-or-android-authenticate-api', [
            'device_id' => $deviceId,
            'app_id' => $appId,
            'event_type' => $eventType
            ]);
    }
}
