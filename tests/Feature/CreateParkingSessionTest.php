<?php

use App\Models\ParkingSession;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

it('can create a parking session', function () {
    post(route('parking-sessions.store'), [
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'space_id' => 'a1b2c3',
    ])
        ->assertCreated();

    assertDatabaseHas(ParkingSession::class, [
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'space_id' => 'a1b2c3',
    ]);
});

it('requires a vrm', function () {
    post(route('parking-sessions.store'), [
        'vrm' => null,
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'space_id' => 'a1b2c3',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['vrm']);
});

it('requires a starts at', function () {
    post(route('parking-sessions.store'), [
        'vrm' => null,
        'starts_at' => null,
        'space_id' => 'a1b2c3',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['starts_at']);
});

it('requires a space ID', function () {
    post(route('parking-sessions.store'), [
        'vrm' => 'TE12ABC',
        'starts_at' => '2025-01-01T09:00:00+00:00',
        'space_id' => null,
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['space_id']);
});
