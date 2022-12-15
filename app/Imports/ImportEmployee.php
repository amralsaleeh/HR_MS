<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportEmployee implements ToModel, WithStartRow
{

    public function model(array $column)
    {
        return new Employee([
            'id' => $column[0],
            'fullName' => $column[1],
            'firstName' => $column[2],
            'lastName' => $column[3],
            'fatherName' => $column[4],
            'motherName' => $column[5],
            'birthAndPlace' => $column[6],
            'nationalNumber' => $column[7],
            'degree' => $column[8],
            'gender' => $column[9],
            'phoneNumber' => $column[10],
            'positionId' => $column[11],
            'startDate' => $column[12],
            'address' => $column[13],
            'earlyPositionId' => $column[14],
            'departmentId' => $column[15],
            'centerId' => $column[16],
            'quitDate' => $column[17],
            'notes' => $column[18],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
