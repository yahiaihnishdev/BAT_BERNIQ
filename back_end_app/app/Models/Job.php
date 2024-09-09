<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_id';
    public $timestamps = true; // Enable timestamps

    protected $fillable = [
        'job_title',
        'job_active',
    ];
}
