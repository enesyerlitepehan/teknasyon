<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;

class AuthenticateForDevice
{
    public static function authenticate($receipt)
    {
        Log::info('# Authenticate started');
        Http::fake(function (Request $request) {
            $date = now('-6')->format('Y-m-d H:i:s');
            if ($request['receipt'] % 2 === 0) {
                return Http::response(['status' => 'true', 'expire_date' => $date], 200, ['Headers']);
            } else {
                return Http::response(['status' => 'false'], 200, ['Headers']);
            }
        });

        return Http::get('ios-or-android-authenticate-api', [
            'receipt' => $receipt]);
    }

    public static function authenticateForSchedule($receipt)
    {
        Log::info('# AuthenticateForSchedule started');
        Http::fake(function (Request $request) {
            $date = now('-6')->format('Y-m-d H:i:s');
            if (substr($request['receipt'], -2) % 6 === 0) {
                return Http::response(['status' => 'false'], 200, ['Headers']);
            } else {
                return Http::response(['status' => 'true', 'expire_date' => $date], 200, ['Headers']);
            }
        });

        return Http::get('ios-or-android-authenticate-api', [
            'receipt' => $receipt]);
    }

}
