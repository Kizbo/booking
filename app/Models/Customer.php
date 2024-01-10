<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Customer extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email'
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Reservation::class);
    }
}
