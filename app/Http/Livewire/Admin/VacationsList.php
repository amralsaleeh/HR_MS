<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Dailyvacation;
use App\Models\Hourlyvacation;
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
    public $perInfo=[];
    public $dailyVacationInfo=[];
    public $hourlyVacationInfo=[];
    public $employeeVacationInfo = [];
    public $showEditVacationForm = false;

    // Render
    public function render()
    {
        $employees = Employee::paginate(10);

        $dailyvacations = DB::table('dailyvacations')
            ->join('employees', 'employees.id', '=', 'dailyvacations.employeeid')
            ->get();

        $hourlyvacations = DB::table('hourlyvacations')
            ->join('employees', 'employees.id', '=', 'hourlyvacations.employeeid')
            ->get();

        $dailyvacations = $dailyvacations->countBy('employeeid');
        $hourlyvacations = $hourlyvacations->countBy('employeeid');

        return view('livewire.admin.vacations-list', [
            'employees' => $employees, 'dailyvacations' => $dailyvacations, 'hourlyvacations' => $hourlyvacations,
        ]);
    }

    // Show new daily vacation
    public function show_new_daily_vacation_form()
    {
        $this->dailyVacationInfo = [];
        $this->showEditVacationForm = false;
        $this->dispatchBrowserEvent('show_new_daily_vacation_form');
    }

    // New daily vacation
    public function new_daily_vacation()
    {
        $validatedData =  Validator::make($this->dailyVacationInfo, [
            'employeeid' => 'required',
            'requestdate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'isauthorization' => 'required',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = Carbon::parse($validatedData['from'])->diff(Carbon::parse($validatedData['to']))->days;
        $validatedData['duration']++;

        Dailyvacation::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_daily_vacation_form', ['message' => 'Vacation added successfully']);
    }

    // Show new hourly vacation
    public function show_new_hourly_vacation_form()
    {
        $this->hourlyVacationInfo = [];
        $this->showEditVacationForm = false;
        $this->dispatchBrowserEvent('show_new_hourly_vacation_form');
    }

    // New hourly vacation
    public function new_hourly_vacation()
    {
        $validatedData =  Validator::make($this->hourlyVacationInfo, [
            'employeeid' => 'required',
            'requestdate' => 'required',
            'vacationdate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = Carbon::parse($validatedData['from'])->diff(Carbon::parse($validatedData['to']));
        $validatedData['duration'] = $validatedData['duration']->h . ":" . $validatedData['duration']->i;

        Hourlyvacation::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_hourly_vacation_form', ['message' => 'Vacation added successfully']);
    }
}
