<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_id'; // Custom primary key
    public $incrementing = true;
    protected $fillable = ['job_title', 'job_active'];
}
