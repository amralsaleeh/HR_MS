<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attendee;
use App\Models\Employee;
use App\Models\Dailytask;
use App\Models\Hourlytask;
use Livewire\WithPagination;
use App\Models\Dailyvacation;
use App\Models\Hourlyvacation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DiscountList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $firstDate = '2022/11/1';
    public $secondDate = '2022/11/31';


    public $mustBeCheckedCases;
    public $unexplainedRows;
    public $employee;

    public function render()
    {
        $this->mustBeCheckedCases = DB::table('attendees')
            ->join('employees', 'employees.id', '=', 'attendees.employeeId')
            ->select('employeeId', DB::raw("(COUNT(*)) as mustVerifiedCases"))
            ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
            ->whereNull('logTime')
            ->orWhere('duration', '<=', '6:25:00')
            ->groupBy('employeeId')
            ->get();

        foreach($this->mustBeCheckedCases as $mustBeCheckedCase) {
            $mustBeCheckedCase->excuse = 0;
            $mustBeCheckedCase->unExcuse = 0;
            $mustBeCheckedCase->discountsDays = 0;
            $mustBeCheckedCase->discountsHours = 0;
        }

        // Start justification check //
        $this->unexplainedRows = DB::table('employees')
            ->join('attendees', 'attendees.employeeId', '=', 'employees.id')
            // ->select('attendees.id', 'attendees.employeeId', 'employees.fullName')
            ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
            ->whereNull('logTime')
            ->orWhere('duration', '<=', '6:25:00')
            // ->whereNull('isExcuse')
            ->get();

        foreach($this->unexplainedRows as $unexplainedRow)
        {
            $employeeDailyVacations = Dailyvacation::where('employeeId', '=', $unexplainedRow->employeeId)
                    ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
                    ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
                    ->get();
            $employeeDailyTasks = Dailytask::where('employeeId', '=', $unexplainedRow->employeeId)
                ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
                ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
                ->get();

            $employeeHourlyVacations = Hourlyvacation::where('employeeId', '=', $unexplainedRow->employeeId)
                ->whereBetween('vacationDate', [$this->firstDate,$this->secondDate])
                ->get();
            $employeeHourlyTasks = Hourlytask::where('employeeId', '=', $unexplainedRow->employeeId)
                ->whereBetween('taskDate', [$this->firstDate,$this->secondDate])
                ->get();

            if($unexplainedRow->duration == null)
            {
                foreach($employeeDailyVacations as $employeeDailyVacation)
                {
                    if ($unexplainedRow->logDate >= $employeeDailyVacation->from && $unexplainedRow->logDate <= $employeeDailyVacation->to)
                    {
                        $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->excuse++;
                        Attendee::where('id' , '=', $unexplainedRow->id)->update(['isExcuse' => 1]);
                    }
                    else
                    {
                        $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->discountsDays++;
                    }
                }

                foreach($employeeDailyTasks as $employeeDailyTask)
                {
                    if ($unexplainedRow->logDate >= $employeeDailyTask->from && $unexplainedRow->logDate <= $employeeDailyTask->to)
                    {
                        $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->excuse++;
                        Attendee::where('id' , '=', $unexplainedRow->id)->update(['isExcuse' => 1]);
                    }
                    else
                    {
                        $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->discountsDays++;
                    }
                }

                if($employeeDailyVacations->isEmpty() && $employeeDailyTasks->isEmpty())
                {
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->unExcuse++;
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->discountsDays++;
                }
            }
            elseif($unexplainedRow->duration <= '6:25:00')
            {
                $totalRemainingTime = Carbon::parse('6:30:00')->secondsSinceMidnight() - Carbon::parse($unexplainedRow->duration)->secondsSinceMidnight();

                foreach($employeeHourlyVacations as $employeeHourlyVacation)
                {
                    if ($unexplainedRow->logDate == $employeeHourlyVacation->vacationDate)
                    {
                        $totalRemainingTime -= Carbon::parse($employeeHourlyVacation->duration)->secondsSinceMidnight();
                    }
                    // else
                    // {
                    //     $totalRemainingTime -= Carbon::parse($unexplainedRow->duration)->diffInSeconds(Carbon::parse('6:30:00'));
                    // }
                }

                foreach($employeeHourlyTasks as $employeeHourlyTask)
                {
                    if ($unexplainedRow->logDate == $employeeHourlyTask->taskDate)
                    {
                        $totalRemainingTime -= Carbon::parse($employeeHourlyTask->duration)->secondsSinceMidnight();
                    }
                    // else
                    // {
                    //     $totalRemainingTime -= Carbon::parse($unexplainedRow->duration)->diffInSeconds(Carbon::parse('6:30:00'));
                    // }
                }

                if($employeeHourlyVacations->isEmpty() && $employeeHourlyTasks->isEmpty())
                {
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->unExcuse++;
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->discountsHours += $totalRemainingTime;
                }
                elseif($totalRemainingTime > 0)
                {
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->unExcuse++;
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->discountsHours += $totalRemainingTime;
                }
                else
                {
                    $this->mustBeCheckedCases->where('employeeId', $unexplainedRow->employeeId)->first()->excuse++;
                }
            }
        }

        foreach($this->mustBeCheckedCases as $mustBeCheckedCase)
        {
            if($mustBeCheckedCase->discountsHours % 9000 == 0)
            {
                $this->mustBeCheckedCases->where('employeeId', $mustBeCheckedCase->employeeId)->first()->discountsDays += intdiv($mustBeCheckedCase->discountsHours, 9000);
                Employee::where('id' , '=', $mustBeCheckedCase->employeeId)->update(['secondsAccumulator' => 0]);
            }
            elseif($mustBeCheckedCase->discountsHours % 9000 >= 1)
            {
                $this->mustBeCheckedCases->where('employeeId', $mustBeCheckedCase->employeeId)->first()->discountsDays += intdiv($mustBeCheckedCase->discountsHours, 9000);
                Employee::where('id' , '=', $mustBeCheckedCase->employeeId)->update(['secondsAccumulator' => $mustBeCheckedCase->discountsHours % 9000]);
            }
            else
            {
                Employee::where('id' , '=', $mustBeCheckedCase->employeeId)->update(['secondsAccumulator' => $mustBeCheckedCase->discountsHours % 9000]);
            }

            $this->mustBeCheckedCases->where('employeeId', $mustBeCheckedCase->employeeId)->first()->discountsHours = Employee::where('id', $mustBeCheckedCase->employeeId)->get(['secondsAccumulator'])[0]->secondsAccumulator;
        }

        // End justification check //

        return view('livewire.admin.discount-list', [

        ]);
    }

    public function get_name_by_id($id)
    {
        $this->employee = Employee::find($id);
        return $this->employee->fullName;
    }
}
