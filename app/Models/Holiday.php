<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Holiday extends Model
{
    protected $table = 'holidays'; // Your table name

    protected $primaryKey = 'holiday_id';

    protected $fillable = [
        'holiday_name',
        'holiday_from',
        'holiday_to',
        'emp_id',
        'holiday_active',
        'days',
    ];

    // Cast dates as Carbon instances
    protected $casts = [
        'holiday_from' => 'date',
        'holiday_to' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
