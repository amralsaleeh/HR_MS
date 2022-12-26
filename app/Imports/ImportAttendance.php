<?php

namespace App\Imports;

use App\Models\Attendee;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportAttendance implements ToModel, WithStartRow
{

    public function model(array $column)
    {
        if(Carbon::parse($column[1])->isWeekday())
        {
            if( $column[2] != "" ){
                $login = substr($column[2], 0, 5);
                $logout = substr($column[2], -5);

                $duration = Carbon::parse($login)->diff(Carbon::parse($logout));
                $duration = $duration->h . ":" . $duration->i;

                if( $logout == $login ){
                    $logout = null;
                    $duration = null;
                }
            }
            else{
                $column[2] = null;
                $login = null;
                $logout = null;
                $duration = null;
            }

            return new Attendee([
                'employeeId' => $column[0],
                'logDate' => $column[1],
                'logTime' => $column[2],
                'login' => $login,
                'logout' => $logout,
                'duration' => $duration,
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
