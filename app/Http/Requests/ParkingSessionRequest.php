<?php

namespace App\Http\Requests;

use DateTimeInterface;
use Illuminate\Foundation\Http\FormRequest;

class ParkingSessionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'vrm' => [
                'required',
                'string',
            ],
            'starts_at' => [
                'required',
                'date_format:' . DateTimeInterface::ATOM,
            ],
            'ends_at' => [
                'date_format:' . DateTimeInterface::ATOM,
                'after:starts_at',
            ],
            'space_id' => [
                'required',
                'string',
            ],
        ];
    }
}
