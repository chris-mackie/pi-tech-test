<?php

use App\Models\ParkingSession;

it('returns a list of parking sessions', function () {
    ParkingSession::factory()->count(3)->create();

    $response = $this->getJson(route('parking-sessions.index'));

    $response->assertOk()
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'vrm',
                    'starts_at',
                    'ends_at',
                    'space_id',
                ],
            ],
        ]);
});

it('filters parking sessions by vrm', function () {
    ParkingSession::factory()->create(['vrm' => 'ABC123']);
    ParkingSession::factory()->create(['vrm' => 'XYZ789']);

    $response = $this->getJson(route('parking-sessions.index', ['vrm' => 'ABC123']));

    $response->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonFragment(['vrm' => 'ABC123']);
});
