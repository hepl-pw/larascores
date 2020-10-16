<?php

namespace App\Listeners;

use App\Events\TeamCreated;
use App\Jobs\SendTeamCreatedEmailToTeamCreator;

class SendTeamCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TeamCreated  $event
     * @return void
     */
    public function handle(TeamCreated $event)
    {
        SendTeamCreatedEmailToTeamCreator::dispatch($event);
    }
}
