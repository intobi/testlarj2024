<?php

namespace App\Listeners;

use App\Events\SubmissionSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSubmissionSaved
{
    /**
     * Handle the event.
     *
     * @param SubmissionSaved $event
     * @return void
     */
    public function handle(SubmissionSaved $event)
    {
        Log::info('Submission saved', [
            'name' => $event->submission->name,
            'email' => $event->submission->email,
        ]);
    }
}
