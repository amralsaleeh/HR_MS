<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fullName',
        'nationalNumber',
        'firstName',
        'fatherName',
        'lastName',
        'motherName',
        'degree',
        'address',
        'phoneNumber',
        'birthAndPlace',
        'gender',
        'startDate',
        'quitDate',
        'isActive',
        'notes',
        'earlyPositionId',
        'positionId',
        'departmentId',
        'centerId',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'fullName' => 'string',
        'nationalNumber' => 'string',
        'firstName' => 'string',
        'fatherName' => 'string',
        'lastName' => 'string',
        'motherName' => 'string',
        'degree' => 'string',
        'address' => 'string',
        'phoneNumber' => 'string',
        'birthAndPlace' => 'string',
        'gender' => 'integer',
        'startDate' => 'date',
        'quitDate' => 'date',
        'isActive' => 'integer',
        'notes' => 'string',
        'earlyPositionId' => 'integer',
        'positionId' => 'integer',
        'departmentId' => 'integer',
        'centerId' => 'integer',
    ];

}
