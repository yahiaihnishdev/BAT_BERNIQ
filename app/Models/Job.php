<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // Define the table if it's not the plural form of the model name
    protected $table = 'jobs';

    // Primary key column
    protected $primaryKey = 'job_id';

    // Specify which fields are mass-assignable
    protected $fillable = ['job_title', 'job_active'];

    // Disable auto-increment if `job_id` is not auto-incremented
    public $incrementing = false;

    // Define any relationships, if necessary
}
