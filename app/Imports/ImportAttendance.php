<?php

namespace App\Imports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportAttendance implements ToModel, WithStartRow
{

    public function model(array $column)
    {
        return new Attendee([
            'employeeId' => $column[0],
            'logDate' => $column[1],
            'logTime' => $column[2],
            'login' => $column[3],
            'logout' => $column[4],
            'duration' => $column[5],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
