<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Dailytask;
use App\Models\Hourlytask;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TasksList extends Component
{
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Objects
    public $employee;
    public $perInfo=[];
    public $dailyTaskInfo=[];
    public $hourlyTaskInfo=[];
    public $employeeTaskInfo = [];
    public $showEditTaskForm = false;

    // Render
    public function render()
    {
        $employees = Employee::paginate(10);

        $dailytasks = DB::table('dailytasks')
            ->join('employees', 'employees.id', '=', 'dailytasks.employeeid')
            ->get();

        $hourlytasks = DB::table('hourlytasks')
            ->join('employees', 'employees.id', '=', 'hourlytasks.employeeid')
            ->get();

        $dailytasks = $dailytasks->countBy('employeeid');
        $hourlytasks = $hourlytasks->countBy('employeeid');

        return view('livewire.admin.tasks-list', [
            'employees' => $employees, 'dailytasks' => $dailytasks, 'hourlytasks' => $hourlytasks,
        ]);
    }

    // Show new daily task
    public function show_new_daily_task_form()
    {
        $this->dailyTaskInfo = [];
        $this->showEditTaskForm = false;
        $this->dispatchBrowserEvent('show_new_daily_task_form');
    }

    // New daily task
    public function new_daily_task()
    {

        $validatedData =  Validator::make($this->dailyTaskInfo, [
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

        Dailytask::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_daily_task_form', ['message' => 'Task added successfully']);
    }

    // Show new hourly task
    public function show_new_hourly_task_form()
    {
        $this->hourlyTaskInfo = [];
        $this->showEditTaskForm = false;
        $this->dispatchBrowserEvent('show_new_hourly_task_form');
    }

    // New hourly task
    public function new_hourly_task()
    {

        $validatedData =  Validator::make($this->hourlyTaskInfo, [
            'employeeid' => 'required',
            'requestdate' => 'required',
            'taskdate' => 'required',
            'from' => 'required',
            'to' => 'required',
            'duration' => 'nullable',
            'type' => 'required',
            'reason' => 'required',
        ])-> validate();

        $validatedData['duration'] = Carbon::parse($validatedData['from'])->diff(Carbon::parse($validatedData['to']));
        $validatedData['duration'] = $validatedData['duration']->h . ":" . $validatedData['duration']->i;

        Hourlytask::create($validatedData);

        $this->dispatchBrowserEvent('hide_new_hourly_task_form', ['message' => 'Task added successfully']);
    }

    // Show employee task
    public function show_employee_task_form($employeeId)
    {
        $this->employeeTaskInfo = [];

        $dailytasks = DB::table('dailytasks')
            ->join('employees', 'employees.id', '=', 'dailytasks.employeeid')
            ->where('employeeid', '=', $employeeId)->get();

        $hourlytasks = DB::table('hourlytasks')
            ->join('employees', 'employees.id', '=', 'hourlytasks.employeeid')
            ->where('employeeid', '=', $employeeId)->get();

        $this->dispatchBrowserEvent('show_employee_tasks_form');
    }
}
