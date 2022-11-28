<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attendee;
use App\Models\Employee;
use Livewire\WithPagination;

class AttendeesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $employees = Employee::paginate(10);
        $attendees = Attendee::paginate(10);

        return view('livewire.admin.attendees-list', [
            'attendees' => $attendees, 'employees' => $employees,
        ]);
    }
}
