<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class Device extends Model
{
    protected $fillable = [
        'uid',
        'appId',
        'language',
        'operation_system',
        'api_token',
        'subscription_state'
    ];

    protected $casts = [
        'uid' => 'integer'
    ];

    /**
     * Create a new device
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public static function create(array $attributes = [])
    {
        $create = static::query()->create($attributes);
        event(new \App\Events\Started($create));
        return $create;
    }

    /**
     * Get device by Id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public static function getDeviceByField($field,$uid)
    {
        return DB::table('devices')->where($field, $uid)->first();
    }

    /**
     * Remove Device
     * @param $id
     * @return int
     */
    public static function destroyDeviceById($id)
    {
        $device = static::query()->where('id', $id)->first();
        $remove = Device::find($id)->delete();
        event(new \App\Events\Canceled($device));
        return $remove;
    }

    public static function updateDevice($uid, $subscriptionState){
        $device = static::query()->where('uid', $uid)->first();
        $update = DB::table('devices')->where('uid', $uid)->update(['subscription_state' => $subscriptionState]);
        event(new \App\Events\Renewed($device));
        return $update;
    }

}
