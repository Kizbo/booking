<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'service_name',
        'service_description',
        'service_duration',
        'service_price',
    ];
    public $timestamps = true;

    public function reservations() : HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function employees() : BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employees_services');
    }
}

