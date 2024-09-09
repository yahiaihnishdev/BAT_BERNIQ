<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class EmpDocument extends Model
{
    protected $table = 'emp_document';
    protected $primaryKey = 'document_id';

    protected $fillable = [
        'emp_id',
        'document_name',
        'document_path',
        'document_type',
        'document_active',
    ];

    // Define the relationship to the Employee model
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }
}
