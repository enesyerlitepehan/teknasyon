<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use App\Helpers\AuthenticateForDevice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Create Purchase
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request): array
    {
        Log::info('PurchaseController Store Started.');
        if (!empty($request->receipt)) {
            $responseAuthenticate = AuthenticateForDevice::authenticate($request->receipt);
            if ($responseAuthenticate['status'] === 'true') {
                $deviceParameter = DB::table('devices')->where('api_token', $request->api_token)->pluck('id')->first();
                $responseAuthenticate = json_decode($responseAuthenticate, true);
                $responseAuthenticate['device_id'] = $deviceParameter;
                $responseAuthenticate['app_id'] = $request->app_id;
                $responseAuthenticate['receipt'] = $request->receipt;
                Purchase::create($responseAuthenticate);
                return ['purchase' => 'OK', 'message' => 'Purchase completed.'];
            } else {
                return ['purchase' => 'FAILED', 'message' => 'An unknown error occurred '];
            }
        } else {
            return ['status' => 'false', 'message' => 'Receipt parameter missing.'];
        }
    }
}
