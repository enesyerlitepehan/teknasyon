<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Helpers\AuthenticateForDevice;

class SyncDeviceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:device';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronization process for Device App Authentication ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $expireDevices = DB::table('devices')
            ->select('devices.id', 'purchases.receipt')
            ->join('purchases', 'purchases.device_id','=', 'devices.id')
            ->where('devices.subscription_state', 'active')
            ->where('purchases.expire_date', '<=', now())
            ->get();
        foreach($expireDevices as $expireDevice){
            Log::debug('expireDevice here: ');
            $response = json_decode(AuthenticateForDevice::authenticateForSchedule($expireDevice->receipt), true);
            //Rate-limit - If the status is false, it means rate limit.
            if($response['status'] === 'true'){
                DB::table('purchases')
                    ->where('receipt', $expireDevice->receipt)
                    ->update(['expire_date' => $response['expire_date']]);
            }

        }
        Log::debug('expireDevice here: ');
        return 0;
    }
}
