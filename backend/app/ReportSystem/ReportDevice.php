<?php

use Illuminate\Support\Facades\DB;

class ReportDevice
{
    public static function index(): \Illuminate\Database\Eloquent\Collection|array
    {
        $reportDevice = DB::select("
        SELECT  appId,
                DATEDIFF(updated_at, created_at) AS day,
                operation_system,
                subscription_state,
                IF(DATEDIFF(updated_at, created_at) = 0, 'not renewed subscription',
                    'renewed subscription')          AS subscription_renewed
        FROM devices;
        ");
        return $reportDevice;
    }
}
