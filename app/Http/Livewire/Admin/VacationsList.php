<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Employee;

class VacationsList extends Component
{
    public $employee;

    public function render()
    {
        $employees = Employee::paginate(10);

        return view('livewire.admin.vacations-list', [
            'employees' => $employees,
        ]);
    }
}
