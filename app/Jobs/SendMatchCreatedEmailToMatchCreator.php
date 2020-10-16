<?php

namespace App\Jobs;

use App\Events\MatchCreated;
use App\Mail\MatchAdded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMatchCreatedEmailToMatchCreator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    /**
     * Create a new job instance.
     *
     * @param  MatchCreated  $event
     * @return void
     */
    public function __construct(MatchCreated $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->event->email)
            ->send(new MatchAdded($this->event->match));
    }
}
