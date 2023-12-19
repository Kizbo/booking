<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
        'customer_id',
        'employee_id',
        'service_id',
        'reservation_datetime'
    ];
    public $timestamps = true;

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function service() : BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

