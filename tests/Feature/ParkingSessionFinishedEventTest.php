<?php

use App\Jobs\GetPermitJob;
use App\Models\ParkingSession;
use Illuminate\Support\Facades\Http;

it('updates permit_id when ParkingSessionFinishedEvent is triggered', function () {
    $session = ParkingSession::factory()->create([
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'ends_at' => '2025-01-01T10:00:00+00:00',
        'space_id' => 'a1b2c3',
    ]);

    Http::fake([
        'https://permits.test.com/*' => Http::response([
            'data' => [
                'permit_id' => 'd4e5f6',
            ],
        ], 200),
    ]);

    GetPermitJob::dispatchSync($session->id);

    $session->refresh();

    expect($session->permit_id)->toBe('d4e5f6');
});
