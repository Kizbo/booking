<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAvailability extends Model
{
    protected $fillable = [
        'user_id',
        'available_start_datetime',
        'available_end_datetime'
    ];

    protected $casts = [
        'available_start_datetime' => 'datetime',
        'available_end_datetime' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Reservation[]
     */
    public function reservations(): array
    {
        return Reservation::whereBelongsTo($this->user)
            ->whereBetween("reservation_datetime", [$this->available_start_datetime, $this->available_end_datetime])
            ->get();
    }
}

