<?php

namespace App\Events;

use App\Models\ParkingSession;
use Illuminate\Foundation\Events\Dispatchable;

class ParkingSessionFinishedEvent
{
    use Dispatchable;

    public function __construct(public readonly ParkingSession $session)
    {
    }
}
