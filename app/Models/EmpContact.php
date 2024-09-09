<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpContact extends Model
{
    protected $table = 'emp_contacts';
    protected $primaryKey = 'emp_con_id';

    protected $fillable = [
        'emp_id',
        'emp_phone',
        'emp_email',
        'emp_address',
        'emer_call1',
        'emer_call2',
        'emer_name1',
        'emer_name2',
        'person_active',
    ];

    // Define the relationship to the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }
}
