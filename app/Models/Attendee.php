<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'logDate',
        'logTime',
        'login',
        'logout',
        'duration',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'employeeId' => 'integer',
        'logDate' => 'date',
        'logTime' => 'string',
        'login' => 'timestamp',
        'logout' => 'timestamp',
        'duration' => 'timestamp',
    ];

    // public function employee(){
    //     return $this->belongsTo('App\Employee');
    // }
}
