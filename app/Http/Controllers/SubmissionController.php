<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Jobs\ProcessSubmission;
use App\Models\Submission;
use Illuminate\Http\JsonResponse;

class SubmissionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SubmissionRequest $request
     * @return JsonResponse
     */
    public function submit(SubmissionRequest $request)
    {
        try {
            ProcessSubmission::dispatch($request->validated());

            return response()->json(['message' => 'Submission received and is being processed'], 202);
        } catch (\Exception $e) {
            Log::error('Failed to dispatch job', ['error' => $e->getMessage()]);

            return response()->json(['error' => 'Failed to process submission'], 500);
        }
    }
}
