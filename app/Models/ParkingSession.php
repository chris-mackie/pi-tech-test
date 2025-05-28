<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property string $id
 * @property string $vrm
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property string $space_id
 */
class ParkingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'vrm',
        'starts_at',
        'ends_at',
        'space_id',
    ];
}
