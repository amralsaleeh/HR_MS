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
            'name' => $row[1],
            'logDate' => $row[2],
            'logTime' => $row[3],
            'logIn' => $row[4],
            'logOut' => $row[5],
            'duration' => $row[6],
        ]);
    }


    public function startRow(): int
    {
        return 2;
    }
}
