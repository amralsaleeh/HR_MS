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

    public $firstDate = '2022/12/1';
    public $secondDate = '2022/12/31';

    public $employee;
    public $unexplainedRows;
    public $mustBeCheckedCases;
    public $totalDiscounts;

    public function render()
    {
        $this->mustBeCheckedCases = DB::table('attendees')
            ->join('employees', 'employees.id', '=', 'attendees.employeeId')
            ->select('employeeId', DB::raw("(COUNT(*)) as mustVerifiedCases"), DB::raw("SUM(isExcuse) as IsExcuseCount"))
            ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
            ->whereNull('logTime')
            ->orWhere('duration', '<=', '6:25:00')
            ->groupBy('employeeId')
            ->get();

        foreach($this->mustBeCheckedCases as $mustBeCheckedCase) {
            $mustBeCheckedCase->discountsDays = 0;
            $mustBeCheckedCase->discountsHours = 0;
        }

        // $this->mustBeCheckedCases->where('employeeId', '222')->first()->discountsDays=9999;

        $this->unexplainedRows = DB::table('employees')
            ->join('attendees', 'attendees.employeeId', '=', 'employees.id')
            // ->select('attendees.id', 'attendees.employeeId', 'employees.fullName')
            ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
            ->whereNull('logTime')
            ->orWhere('duration', '<=', '6:25:00')
            // ->whereNull('isExcuse')
            ->get();

        return view('livewire.admin.discount-list', [

        ]);
    }

    public function get_name_by_id($id)
    {
        $this->employee = Employee::find($id);
        return $this->employee->fullName;
    }

    // public function justification_check()
    // {
    //     // $mustBeCheckedCases = DB::table('attendees')
    //     //     ->join('employees', 'employees.id', '=', 'attendees.employeeId')
    //     //     ->select('employeeId', DB::raw("(COUNT(*)) as mustVerifiedCases"), DB::raw("SUM(isExcuse) as IsExcuseCount"))
    //     //     ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
    //     //     ->whereNull('logTime')
    //     //     ->orWhere('duration', '<=', '6:25:00')
    //     //     ->groupBy('employeeId')
    //     //     ->get();

    //     // $unexplainedRows = DB::table('employees')
    //     //     ->join('attendees', 'attendees.employeeId', '=', 'employees.id')
    //     //     // ->select('attendees.id', 'attendees.employeeId', 'employees.fullName')
    //     //     ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
    //     //     ->whereNull('logTime')
    //     //     ->orWhere('duration', '<=', '6:25:00')
    //     //     // ->whereNull('isExcuse')
    //     //     ->get();


    //     // $unexplainedDurations = DB::table('employees')
    //     //     ->join('attendees', 'attendees.employeeId', '=', 'employees.id')
    //     //     // ->select('attendees.id', 'attendees.employeeId', 'employees.fullName')
    //     //     ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
    //     //     ->where('duration', '<=', '6:25:00')
    //     //     ->whereNull('isExcuse')
    //     //     ->get();

    //     // dd($unexplainedRows);

    //     // $test = $unexplainedRows->merge($unexplainedDurations);

    //     // dd($test);

    //     // Days check
    //     // foreach($unexplainedRows as $unexplainedDay)
    //     // {
    //     //     $employeeDailyVacations = Dailyvacation::where('employeeId', '=', $unexplainedDay->employeeId)
    //     //         ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
    //     //         ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
    //     //         ->get();

    //     //     $employeeDailyTasks = Dailytask::where('employeeId', '=', $unexplainedDay->employeeId)
    //     //         ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
    //     //         ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
    //     //         ->get();

    //     //     foreach($employeeDailyVacations as $employeeDailyVacation)
    //     //     {
    //     //         if ($unexplainedDay->logDate >= $employeeDailyVacation->from && $unexplainedDay->logDate <= $employeeDailyVacation->to)
    //     //         {
    //     //             $updated = Attendee::where('id' , '=', $unexplainedDay->id)->update(['isExcuse' => 1]);
    //     //         }
    //     //     }

    //     //     foreach($employeeDailyTasks as $employeeDailyTask)
    //     //     {
    //     //         if ($unexplainedDay->logDate >= $employeeDailyTask->from && $unexplainedDay->logDate <= $employeeDailyTask->to)
    //     //         {
    //     //             $updated = Attendee::where('id' , '=', $unexplainedDay->id)->update(['isExcuse' => 1]);
    //     //         }
    //     //     }
    //     // }

    //     // Duration check
    //     foreach($unexplainedDurations as $unexplainedDuration)
    //     {
    //         $employeeHourlyVacations = Hourlyvacation::where('employeeId', '=', $unexplainedDuration->employeeId)
    //             ->whereBetween('vacationDate', [$this->firstDate,$this->secondDate])
    //             ->get();

    //         $employeeHourlyTasks = Hourlytask::where('employeeId', '=', $unexplainedDuration->employeeId)
    //             ->whereBetween('taskDate', [$this->firstDate,$this->secondDate])
    //             ->get();

    //         foreach($employeeHourlyVacations as $employeeHourlyVacation)
    //         {
    //             if ($unexplainedDuration->logDate == $employeeHourlyVacation->vacationDate)
    //                 {
    //                     $updated = Attendee::where('id' , '=', $unexplainedDuration->id)->update(['isExcuse' => 1]);
    //                 }
    //         }

    //         foreach($employeeHourlyTasks as $employeeHourlyTask)
    //         {
    //             if ($unexplainedDuration->logDate == $employeeHourlyTask->taskDate)
    //             {
    //                 $updated = Attendee::where('id' , '=', $unexplainedDuration->id)->update(['isExcuse' => 1]);
    //             }
    //         }
    //     }
    // }

    // public function test()
    // {
    //     $this->totalDiscounts = DB::table('attendees')
    //         ->join('employees', 'employees.id', '=', 'attendees.employeeId')
    //         ->select('employeeId', DB::raw("(COUNT(*)) as mustVerifiedCases"), DB::raw("SUM(isExcuse) as IsExcuseCount"))
    //         ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
    //         ->whereNull('logTime')
    //         ->orWhere('duration', '<=', '6:25:00')
    //         ->groupBy('employeeId')
    //         ->get();

    //     foreach($this->totalDiscounts as $totalDiscount) {
    //         $totalDiscount->discountsDays = 0;
    //         $totalDiscount->discountsHours = 0;
    //     }

    //     foreach($this->mustBeCheckedCases as $mustBeCheckedCase)
    //     {
    //         for($i=1; $i <= $mustBeCheckedCase['mustVerifiedCases']; $i++)
    //         {
    //             $employeeDailyVacations = Dailyvacation::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
    //                 ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
    //                 ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
    //                 ->get();
    //             $employeeDailyTasks = Dailytask::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
    //                 ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
    //                 ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
    //                 ->get();

    //             $employeeHourlyVacations = Hourlyvacation::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
    //                 ->whereBetween('vacationDate', [$this->firstDate,$this->secondDate])
    //                 ->get();
    //             $employeeHourlyTasks = Hourlytask::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
    //                 ->whereBetween('taskDate', [$this->firstDate,$this->secondDate])
    //                 ->get();

    //             // $discountsDays = 0;
    //             // $discountsHours = 0;

    //             // $totalDuration = 0;

    //             foreach($this->unexplainedRows as $unexplainedRow)
    //             {
    //                 if($mustBeCheckedCase['employeeId'] == $unexplainedRow['employeeId'])
    //                 {
    //                     if($unexplainedRow['duration'] == null)
    //                     {
    //                         foreach($employeeDailyVacations as $employeeDailyVacation)
    //                         {
    //                             if ($unexplainedRow['logDate'] >= $employeeDailyVacation['from'] && $unexplainedRow['logDate'] <= $employeeDailyVacation['to'])
    //                             {
    //                                 $updated = Attendee::where('id' , '=', $unexplainedRow['id'])->update(['isExcuse' => 1]);
    //                             }
    //                             else
    //                             {
    //                                 $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays++;
    //                             }
    //                         }

    //                         foreach($employeeDailyTasks as $employeeDailyTask)
    //                         {
    //                             if ($unexplainedRow['logDate'] >= $employeeDailyTask['from'] && $unexplainedRow['logDate'] <= $employeeDailyTask['to'])
    //                             {
    //                                 $updated = Attendee::where('id' , '=', $unexplainedRow['id'])->update(['isExcuse' => 1]);
    //                             }
    //                             else
    //                             {
    //                                 $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays++;
    //                             }
    //                         }

    //                         if($employeeDailyVacations->isEmpty() && $employeeDailyTasks->isEmpty())
    //                         {
    //                             $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays++;
    //                             // $discountsDays++;
    //                         }
    //                     }

    //                     if($unexplainedRow['duration'] <= '6:25:00')
    //                     {
    //                         $totalDuration = 0;

    //                         foreach($employeeHourlyVacations as $employeeHourlyVacation)
    //                         {
    //                             if ($unexplainedRow['logDate'] == $employeeHourlyVacation['vacationDate'])
    //                             {
    //                                 $totalDuration = $totalDuration + Carbon::parse($employeeHourlyVacation['from'])->diffInSeconds(Carbon::parse($employeeHourlyVacation['to']));
    //                             }
    //                             else
    //                             {
    //                                 // $discountsHours++;
    //                             }
    //                         }

    //                         foreach($employeeHourlyTasks as $employeeHourlyTask)
    //                         {
    //                             if ($unexplainedRow['logDate'] == $employeeHourlyTask['taskDate'])
    //                             {
    //                                 $totalDuration = $totalDuration + Carbon::parse($employeeHourlyTask['from'])->diffInSeconds(Carbon::parse($employeeHourlyTask['to']));
    //                             }
    //                             else
    //                             {
    //                                 // $discountsHours++;
    //                             }
    //                         }
    //                         // $totalDuration = gmdate('H', $totalDuration) . ":" . gmdate('i', $totalDuration) . ":" . gmdate('s', $totalDuration);
    //                         // dd($totalDuration);
    //                     }

    //                     // $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays += $discountsDays;
    //                     // $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsHours += 2;


    //                 }
    //             }
    //         }
    //     }

    //     dd($this->totalDiscounts);
    // }

    public function test()
    {
        $this->totalDiscounts = DB::table('attendees')
            ->join('employees', 'employees.id', '=', 'attendees.employeeId')
            ->select('employeeId', DB::raw("(COUNT(*)) as mustVerifiedCases"), DB::raw("SUM(isExcuse) as IsExcuseCount"))
            ->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])
            ->whereNull('logTime')
            ->orWhere('duration', '<=', '6:25:00')
            ->groupBy('employeeId')
            ->get();

        foreach($this->totalDiscounts as $totalDiscount) {
            $totalDiscount->discountsDays = 0;
            $totalDiscount->discountsHours = 0;
        }

        foreach($this->mustBeCheckedCases as $mustBeCheckedCase)
        {
            for($i=1; $i <= $mustBeCheckedCase['mustVerifiedCases']; $i++)
            {
                $employeeDailyVacations = Dailyvacation::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
                    ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
                    ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
                    ->get();
                $employeeDailyTasks = Dailytask::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
                    ->whereBetween('from' ,[$this->firstDate,$this->secondDate])
                    ->whereBetween('to' ,[$this->firstDate,$this->secondDate])
                    ->get();

                $employeeHourlyVacations = Hourlyvacation::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
                    ->whereBetween('vacationDate', [$this->firstDate,$this->secondDate])
                    ->get();
                $employeeHourlyTasks = Hourlytask::where('employeeId', '=', $mustBeCheckedCase['employeeId'])
                    ->whereBetween('taskDate', [$this->firstDate,$this->secondDate])
                    ->get();

                // $discountsDays = 0;
                // $discountsHours = 0;

                // $totalDuration = 0;

                foreach($this->unexplainedRows as $unexplainedRow)
                {
                    if($mustBeCheckedCase['employeeId'] == $unexplainedRow['employeeId'])
                    {
                        if($unexplainedRow['duration'] == null)
                        {
                            foreach($employeeDailyVacations as $employeeDailyVacation)
                            {
                                if ($unexplainedRow['logDate'] >= $employeeDailyVacation['from'] && $unexplainedRow['logDate'] <= $employeeDailyVacation['to'])
                                {
                                    $updated = Attendee::where('id' , '=', $unexplainedRow['id'])->update(['isExcuse' => 1]);
                                }
                                else
                                {
                                    $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays++;
                                }
                            }

                            foreach($employeeDailyTasks as $employeeDailyTask)
                            {
                                if ($unexplainedRow['logDate'] >= $employeeDailyTask['from'] && $unexplainedRow['logDate'] <= $employeeDailyTask['to'])
                                {
                                    $updated = Attendee::where('id' , '=', $unexplainedRow['id'])->update(['isExcuse' => 1]);
                                }
                                else
                                {
                                    $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays++;
                                }
                            }

                            if($employeeDailyVacations->isEmpty() && $employeeDailyTasks->isEmpty())
                            {
                                $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays++;
                                // $discountsDays++;
                            }
                        }

                        if($unexplainedRow['duration'] <= '6:25:00')
                        {
                            $totalDuration = 0;

                            foreach($employeeHourlyVacations as $employeeHourlyVacation)
                            {
                                if ($unexplainedRow['logDate'] == $employeeHourlyVacation['vacationDate'])
                                {
                                    $totalDuration = $totalDuration + Carbon::parse($employeeHourlyVacation['from'])->diffInSeconds(Carbon::parse($employeeHourlyVacation['to']));
                                }
                                else
                                {
                                    // $discountsHours++;
                                }
                            }

                            foreach($employeeHourlyTasks as $employeeHourlyTask)
                            {
                                if ($unexplainedRow['logDate'] == $employeeHourlyTask['taskDate'])
                                {
                                    $totalDuration = $totalDuration + Carbon::parse($employeeHourlyTask['from'])->diffInSeconds(Carbon::parse($employeeHourlyTask['to']));
                                }
                                else
                                {
                                    // $discountsHours++;
                                }
                            }
                            // $totalDuration = gmdate('H', $totalDuration) . ":" . gmdate('i', $totalDuration) . ":" . gmdate('s', $totalDuration);
                            // dd($totalDuration);
                        }

                        // $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsDays += $discountsDays;
                        // $this->totalDiscounts->where('employeeId', $unexplainedRow['employeeId'])->first()->discountsHours += 2;


                    }
                }
            }
        }

        dd($this->totalDiscounts);
    }
}
