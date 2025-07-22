<?php

namespace App\Events;

use App\Jobs\GetPermitJob;
use App\Models\ParkingSession;
use Illuminate\Foundation\Events\Dispatchable;

class ParkingSessionFinishedEvent
{
    use Dispatchable;

    public function __construct(public readonly ParkingSession $session)
    {
    }

    public function handle()
    {
        // Dispatch the GetPermitJob to handle permit retrieval and update session with permit ID
        GetPermitJob::dispatch($this->session->id);
    }
}
