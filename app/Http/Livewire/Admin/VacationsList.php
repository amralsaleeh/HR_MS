<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;

class VacationsList extends Component
{
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Objects
    public $employee;
    public $showEditVacationForm = false;

    // Render
    public function render()
    {
        $employees = Employee::paginate(10);

        return view('livewire.admin.vacations-list', [
            'employees' => $employees,
        ]);
    }

    // New daily vacation
    public function show_new_daily_vacation_form()
    {
        $this->dailyVacationInfo = [];
        $this->showEditVacationForm = false;
        $this->dispatchBrowserEvent('show_new_daily_vacation_form');
    }

    // New hourly vacation
    public function show_new_hourly_vacation_form()
    {
        $this->hourlyVacationInfo = [];
        $this->showEditVacationForm = false;
        $this->dispatchBrowserEvent('show_new_hourly_vacation_form');
    }
}
