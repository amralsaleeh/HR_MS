<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class TasksList extends Component
{
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Objects
    public $employee;
    public $showEditTaskForm = false;

    // Render
    public function render()
    {
        $employees = Employee::paginate(10);

        return view('livewire.admin.tasks-list', [
            'employees' => $employees,
        ]);
    }

    // New daily task
    public function show_new_daily_task_form()
    {
        $this->dailyTaskInfo = [];
        $this->showEditTaskForm = false;
        $this->dispatchBrowserEvent('show_new_daily_task_form');
    }

    // New hourly task
    public function show_new_hourly_task_form()
    {
        $this->hourlyTaskInfo = [];
        $this->showEditTaskForm = false;
        $this->dispatchBrowserEvent('show_new_hourly_task_form');
    }
}
