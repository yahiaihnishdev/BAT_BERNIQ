<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Define the primary key column
    protected $primaryKey = 'job_id';

    // Enable timestamps if needed
    public $timestamps = true;

    // Add fields to the fillable array to allow mass assignment
    protected $fillable = [
        'job_title',         // Field for department name
        'job_active', // Field for active status
    ];
}
