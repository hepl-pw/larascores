<?php

namespace App\Jobs;

use App\Events\TeamCreated;
use App\Mail\TeamAdded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTeamCreatedEmailToTeamCreator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $event;

    /**
     * Create a new job instance.
     *
     * @param  TeamCreated  $event
     */
    public function __construct(TeamCreated $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle()
    {
        Mail::to($this->event->email)
            ->send(new TeamAdded($this->event->team));
    }
}
