<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Employee;
use App\Models\DailyVacation;
use App\Models\HourlyVacation;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VacationsList extends Component
{
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Objects
    public $employee;

    public $employeeId = null;
    public $employeeFullName = null;

    public $dailyVacationInfo=[];
    public $dailyVacationFrom = null;
    public $dailyVacationTo = null;
    public $dailyVacationDuration = null;

    public $hourlyVacationInfo=[];
    public $hourlyVacationFrom = null;
    public $hourlyVacationTo = null;
    public $hourlyVacationDuration = null;

    public $employeeVacationInfo = [];
    public $showEditVacationForm = false;

    // Render
    public function render()
    {
        $employees = Employee::paginate(10);

        $daily_vacations = DB::table('daily_vacations')
            ->join('employees', 'employees.id', '=', 'daily_vacations.employeeId')
            ->get();

        $hourly_vacations = DB::table('hourly_vacations')
            ->join('employees', 'employees.id', '=', 'hourly_vacations.employeeId')
            ->get();

        $daily_vacations = $daily_vacations->countBy('employeeId');
        $hourly_vacations = $hourly_vacations->countBy('employeeId');

        return view('livewire.admin.vacations-list', [
            'employees' => $employees, 'daily_vacations' => $daily_vacations, 'hourly_vacations' => $hourly_vacations,
        ]);
    }

    // Find employee fullname
    public function updatedEmployeeId($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $this->employeeFullName = $employee->fullName;
    }

    // Insert from for daily vacation
    public function updateddailyVacationFrom($dailyVacationFrom)
    {
        $this->dailyVacationFrom = $dailyVacationFrom;
    }
    // Insert to for daily vacation
    public function updateddailyVacationTo($dailyVacationTo)
    {
        $this->dailyVacationTo = $dailyVacationTo;
        $this->dailyVacationDuration = Carbon::parse($this->dailyVacationFrom)->diff(Carbon::parse($this->dailyVacationTo))->days + 1;
    }

    // Insert from for hourly vacation
    public function updatedhourlyVacationFrom($hourlyVacationFrom)
    {
        $this->hourlyVacationFrom = $hourlyVacationFrom;
    }
    // Insert to for hourly vacation
    public function updatedhourlyVacationTo($hourlyVacationTo)
    {
        $this->hourlyVacationTo = $hourlyVacationTo;
        $this->hourlyVacationDuration = Carbon::parse($this->hourlyVacationFrom)->diff(Carbon::parse($this->hourlyVacationTo));
        // $this->hourlyVacationDuration = $this->hourlyVacationDuration->h . " H :" . $this->hourlyVacationDuration->i . " M";
        $this->hourlyVacationDuration = $this->hourlyVacationDuration->h . " : " . $this->hourlyVacationDuration->i;
    }

    // Show new daily vacation
    public function show_new_daily_vacation_form()
    {
        $this->dailyVacationInfo = [];
        $this->employeeFullName = "....... ....... .......";
        $this->dailyVacationDuration = ".......";

        $this->showEditVacationForm = false;
        $this->dispatchBrowserEvent('show_new_daily_vacation_form');
    }

    // New daily vacation
    public function new_daily_vacation()
    {
        $validatedData =  Validator::make($this->dailyVacationInfo, [
            'employeeId' => 'required',
            'requestDate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'isAuthorization' => 'required',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = $this->dailyVacationDuration;

        DailyVacation::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_daily_vacation_form', ['message' => 'Vacation added successfully']);
    }

    // Show new hourly vacation
    public function show_new_hourly_vacation_form()
    {
        $this->hourlyVacationInfo = [];
        $this->employeeFullName = "....... ....... .......";
        $this->hourlyVacationDuration = "__ : __";

        $this->showEditVacationForm = false;
        $this->dispatchBrowserEvent('show_new_hourly_vacation_form');
    }

    // New hourly vacation
    public function new_hourly_vacation()
    {
        $validatedData =  Validator::make($this->hourlyVacationInfo, [
            'employeeId' => 'required',
            'requestDate' => 'required',
            'vacationDate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = Carbon::parse($validatedData['from'])->diff(Carbon::parse($validatedData['to']));
        $validatedData['duration'] = $validatedData['duration']->h . ":" . $validatedData['duration']->i;

        HourlyVacation::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_hourly_vacation_form', ['message' => 'Vacation added successfully']);
    }

    // Show employee vacation
    public function show_employee_vacation_form($employeeId)
    {
        $this->employeeVacationInfo = [];

        $daily_vacations = DB::table('daily_vacations')
            ->join('employees', 'employees.id', '=', 'daily_vacations.employeeId')
            ->where('employeeId', '=', $employeeId)->get();

        $hourly_vacations = DB::table('hourly_vacations')
            ->join('employees', 'employees.id', '=', 'hourly_vacations.employeeId')
            ->where('employeeId', '=', $employeeId)->get();

        $this->dispatchBrowserEvent('show_employee_vacations_form');
    }
}
