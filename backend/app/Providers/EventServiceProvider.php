<?php

namespace App\Providers;

use App\Events\Started;
use App\Events\Canceled;
use App\Events\Renewed;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\StartedListener;
use App\Listeners\CanceledListener;
use App\Listeners\RenewedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Started::class => [
            StartedListener::class],
        Canceled::class => [
            CanceledListener::class],
        Renewed::class => [
            RenewedListener::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
