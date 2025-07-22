<?php

namespace App\Http\Resources;

use App\Models\ParkingSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ParkingSession */
class ParkingSessionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->_id,
            'vrm' => $this->vrm,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'space_id' => $this->space_id,
            'permit_id' => $this->permit_id ?: null,
        ];
    }
}
