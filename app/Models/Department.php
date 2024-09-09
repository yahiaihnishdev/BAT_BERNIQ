<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Define the primary key column
    protected $primaryKey = 'dept_id';

    // Enable timestamps if needed
    public $timestamps = true;

    // Add fields to the fillable array to allow mass assignment
    protected $fillable = [
        'dept_name',         // Field for department name
        'department_active', // Field for active status
    ];
}
