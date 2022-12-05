<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nationalnumber',
        'fullname',
        'firstname',
        'lastname',
        'fathername',
        'mothername',
        'birthdate',
        'gender',
        'isactive',
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
