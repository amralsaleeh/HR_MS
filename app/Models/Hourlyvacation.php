<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hourlyvacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeid',
        'requestdate',
        'vacationdate',
        'from',
        'to',
        'duration',
        'type',
        'reason',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
