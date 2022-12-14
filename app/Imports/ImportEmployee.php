<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportEmployee implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        return new Employee([
            'id' => $row[0],
            'fullName' => $row[1],
            'firstName' => $row[2],
            'lastName' => $row[3],
            'fatherName' => $row[4],
            'motherName' => $row[5],
            'birthAndPlace' => $row[6],
            'nationalNumber' => $row[7],
            'degree' => $row[8],
            'gender' => $row[9],
            'phoneNumber' => $row[10],
            'positionId' => $row[11],
            'startDate' => $row[12],
            'address' => $row[13],
            'earlyPositionId' => $row[14],
            'departmentId' => $row[15],
            'centerId' => $row[16],
            'quitDate' => $row[17],
            'notes' => $row[18],

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
