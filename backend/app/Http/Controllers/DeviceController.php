<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Device;
use Illuminate\Support\Facades\Log;

class DeviceController extends Controller
{
    protected $model;

    /**
     * Get All Device
     * @return Device[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function index(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Device::all();
    }

    /**
     * Add new device
     * @param Request $request
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|array
    {
        Log::info('DeviceController Store Started.');
        $subscriptionState = ['active', 'inactive'];

        $validator = Validator::make($request->all(), [
            'uid' => 'required|unique:devices'
        ]);

        if ($validator->fails()) {
            $deviceParameter = Device::getDeviceByField('uid', $request->uid);
            return [
                'register' => 'OK',
                'api_token' => $deviceParameter->api_token
            ];
        }
        $clientToken = sha1(time());
        $request->request->add(
            ['api_token' => $clientToken, 'subscription_state' => $subscriptionState[array_rand($subscriptionState)]],
        );
        return Device::create($request->all());
    }

    /**
     * Update device
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request): mixed
    {
        Log::info('DeviceController Update Started.');
        //$post = Device::getDeviceByField('uid', $request->uid);
        return Device::updateDevice($request->uid, $request->subscription_date);
    }

    /**
     * Remove device
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        Log::info('DeviceController Destroy Started.');
        return Device::destroyDeviceById($id);
    }

}
