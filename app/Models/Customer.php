<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number'
    ];
    public $timestamps = true;

    public function reservations() : HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}

