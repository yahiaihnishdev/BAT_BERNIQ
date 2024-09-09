<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    // Define the table if it's not the plural form of the model name
    protected $table = 'learn_user_types';

    // Primary key column
    protected $primaryKey = 'user_type_id';

    // Specify which fields are mass-assignable
    protected $fillable = ['user_type_name', 'user_type_active'];

    // Disable auto-increment if `job_id` is not auto-incremented
    public $incrementing = false;

    // Define any relationships, if necessary
}
