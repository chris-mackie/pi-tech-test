<?php

namespace App\Jobs;

use App\Models\ParkingSession;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetPermitJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $sessionId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $session = ParkingSession::find($this->sessionId);
        if (! $session) {
            Log::error('GetPermitJob: ParkingSession not found', ['sessionId' => $this->sessionId]);
            return;
        }

        $response = Http::get('https://permits.test.com/', [
            'vrm' => $session->vrm,
            'starts_at' => $session->starts_at,
            'ends_at' => $session->ends_at,
            'space_id' => $session->space_id,
        ]);

        if ($response->ok() && isset($response['data']['permit_id'])) {
            $session->update([
                'permit_id' => $response['data']['permit_id'],
            ]);
        }
    }
}
