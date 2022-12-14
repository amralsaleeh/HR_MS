<?php

namespace App\Imports;

use App\Models\Attendee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportAttendance implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        return new Attendee([
            'employeeId' => $row[0],
            'logDate' => $row[1],
            'logTime' => $row[2],
            'logIn' => $row[3],
            'logOut' => $row[4],
            'duration' => $row[5],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
