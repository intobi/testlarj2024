<?php

namespace App\Jobs;

use App\Events\SubmissionSaved;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $submission = Submission::create([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'message' => $this->data['message'],
            ]);

            event(new SubmissionSaved($submission));
        } catch (\Exception $e) {
            Log::error('Failed to process submission', ['error' => $e->getMessage()]);

            throw $e;
        }
    }
}
