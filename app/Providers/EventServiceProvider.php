<?php

namespace App\Providers;

use App\Events\MatchCreated;
use App\Events\TeamCreated;
use App\Listeners\UpdateTeamStats;
use App\Listeners\AddRowToTeamStats;
use App\Listeners\SendTeamCreatedNotification;
use App\Listeners\SendMatchCreatedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        MatchCreated::class => [
            UpdateTeamStats::class,
            SendMatchCreatedNotification::class
        ],
        TeamCreated::class => [
            AddRowToTeamStats::class,
            SendTeamCreatedNotification::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
