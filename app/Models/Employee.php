<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'employees';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'emp_id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'emp_num_id',
        'emp_name',
        'emp_username',
        'emp_password',
        'birth_date',
        'nid',
        'job_id',
        'dept_id',
        'basic_salary',
        'hire_date',
        'emp_active',
        // Add other fields as necessary
    ];

    // Hide sensitive fields when serializing the model
    protected $hidden = [
        'emp_password',
    ];

    /**
     * Relationship with Job model
     */
    public function job()
    {
        // Assuming `job_active` is the column in the `jobs` table that indicates active status
        return $this->belongsTo(Job::class, 'job_id')->where('job_active', 1);
    }

    /**
     * Relationship with Department model
     */
    public function department()
    {
        // Assuming `dept_active` is the column in the `departments` table that indicates active status
        return $this->belongsTo(Department::class, 'dept_id')->where('department_active', 1);
    }


    /**
     * Mutator to hash the password before saving
     */
    public function setEmpPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['emp_password'] = bcrypt($password);
        }
    }
}
