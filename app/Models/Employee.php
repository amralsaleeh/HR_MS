<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'nationalnumber',
        'fullname',
        'birthdate',
        'positionid',
        'departmentid',
        'centerid',
        'startdate',
        'phonenumber',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
