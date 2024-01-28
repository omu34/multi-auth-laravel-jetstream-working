<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeJobView extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_job_id',
        'view_name'
    ];
}
