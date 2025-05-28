<?php

namespace Database\Factories;

use App\Models\ParkingSession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ParkingSessionFactory extends Factory
{
    protected $model = ParkingSession::class;

    public function definition(): array
    {
        return [
            'vrm' => $this->faker->word(),
            'starts_at' => Carbon::now(),
            'ends_at' => Carbon::now(),
            'space_id' => $this->faker->word(),
        ];
    }
}
