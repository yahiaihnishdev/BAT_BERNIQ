<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'dept_id';
    public $timestamps = true; // Enable timestamps

    protected $data = [
        'dept_name',
        'department_active',
    ];
}
