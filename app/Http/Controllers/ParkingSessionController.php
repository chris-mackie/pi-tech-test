<?php

namespace App\Http\Controllers;

use App\Events\ParkingSessionFinishedEvent;
use App\Http\Requests\ParkingSessionRequest;
use App\Http\Resources\ParkingSessionResource;
use App\Models\ParkingSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ParkingSessionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = ParkingSession::query();

        if ($request->has('vrm')) {
            $query->where('vrm', $request->query('vrm'));
        }

        $sessions = $query->get();

        return ParkingSessionResource::collection($sessions);
    }

    public function store(ParkingSessionRequest $request): JsonResource
    {
        $session = ParkingSession::create([
            'vrm' => $request->vrm,
            'starts_at' => $request->starts_at,
            'space_id' => $request->space_id,
        ]);

        return ParkingSessionResource::make($session);
    }

    public function update(ParkingSession $session, ParkingSessionRequest $request): JsonResource
    {
        $session->update([
            'vrm' => $request->vrm,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'space_id' => $request->space_id,
        ]);

        if ($session->ends_at) {
            event(new ParkingSessionFinishedEvent($session));
        }

        return ParkingSessionResource::make($session);
    }
}
