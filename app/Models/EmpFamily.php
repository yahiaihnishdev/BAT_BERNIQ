<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpFamily extends Model
{
    protected $table = 'emp_family';
    protected $primaryKey = 'emp_fam_id';

    protected $fillable = [
        'emp_id',
        'person_name',
        'person_rel',
        'person_birth_date',
        'person_age',
        'person_phone',
        'person_active',
    ];

    // Define the relationship to the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }
}
