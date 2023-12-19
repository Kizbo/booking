<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeAvailability extends Model
{
    protected $table = 'employees_availability';
    protected $fillable = [
        'employee_id',
        'available_date',
        'available_start_time',
        'available_end_time'
    ];
    public $timestamp = true;

    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

