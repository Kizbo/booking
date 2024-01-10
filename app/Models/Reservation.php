<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reservation extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'service_id',
        'reservation_datetime'
    ];

    protected $casts = [
        'reservation_datetime' => 'datetime'
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

