<?php

use App\Events\ParkingSessionFinishedEvent;
use App\Models\ParkingSession;

use function Pest\Laravel\patch;

it('can update a parking session', function () {
    $session = ParkingSession::factory()->create([
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'ends_at' => '2025-01-01T10:00:00+00:00',
        'space_id' => 'a1b2c3',
    ]);

    patch(route('parking-sessions.update', $session), [
        'vrm' => 'TE12XYZ',
        'starts_at' => '2025-01-01T11:00:00+00:00',
        'ends_at' => '2025-01-01T12:00:00+00:00',
        'space_id' => 'd4e5f6',
    ])
        ->assertOk();

    $session->refresh();

    expect($session->vrm)->toBe('TE12XYZ')
        ->and($session->starts_at)->toBe('2025-01-01T11:00:00+00:00')
        ->and($session->ends_at)->toBe('2025-01-01T12:00:00+00:00')
        ->and($session->space_id)->toBe('d4e5f6');
});

it('fires an event if the session was finished', function () {
    Event::fake();
    $session = ParkingSession::factory()->create([
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'ends_at' => null,
        'space_id' => 'a1b2c3',
    ]);

    patch(route('parking-sessions.update', $session), [
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'ends_at' => '2025-01-01T10:00:00+00:00',
        'space_id' => 'a1b2c3',
    ])
        ->assertOk();

    Event::assertDispatched(ParkingSessionFinishedEvent::class);
});
