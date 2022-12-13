<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeId',
        'name',
        'logDate',
        'logTime',
        'logIn',
        'logOut',
        'duration',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'employeeId' => 'integer',
        'name' => 'string',
        'logDate' => 'date',
        'logTime' => 'string',
        'logIn' => 'timestamp',
        'logOut' => 'timestamp',
        'duration' => 'timestamp',
    ];

    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
