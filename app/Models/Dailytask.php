<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailytask extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeid',
        'requestdate',
        'from',
        'to',
        'duration',
        'isauthorization',
        'type',
        'reason',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
