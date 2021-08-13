<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'device_id',
        'status',
        'expire_date',
        'app_id',
        'receipt'
    ];

    /**
     * Create Purchase
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public static function create(array $attributes = []): Model|\Illuminate\Database\Eloquent\Builder
    {
        return static::query()->create($attributes);
    }

}
