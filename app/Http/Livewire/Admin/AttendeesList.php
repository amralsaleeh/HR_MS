<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Attendee;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AttendeesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $firstDate;
    public $secondDate;
    public $isAttendees = true;
    public $isGoodAttendees = false;
    public $isBadAttendees = false;

    public function render()
    {
        $attendCount = Attendee::all()->unique('employee_id')->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->count();
        $goodAttendeesCount = Attendee::all()->unique('employee_id')->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->where('duration', '>=', strtotime('06:30:00'))->count();
        $badAttendeesCount = Attendee::all()->unique('employee_id')->whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->where('duration', '<', strtotime('06:30:00'))->count();

        $attendees = Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->paginate(3);
        $goodAttendees = Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->where('duration', '>=', '06:30:00')->paginate(3);
        $badAttendees = Attendee::whereBetween('logDate' ,[$this->firstDate,$this->secondDate])->where('duration', '<', '06:30:00')->paginate(3);

        return view('livewire.admin.attendees-list', [
            'attendCount' => $attendCount,
            'goodAttendeesCount' => $goodAttendeesCount,
            'badAttendeesCount' => $badAttendeesCount,
            'goodAttendees' => $goodAttendees,
            'badAttendees' => $badAttendees,
            'attendees' => $attendees,
        ]);
    }

    public function show_good_attendees(){
         $this->isGoodAttendees = true;
         $this->isAttendees = false;
         $this->isBadAttendees = false;
    }

    public function show_bad_attendees(){
        $this->isGoodAttendees = false;
        $this->isAttendees = false;
        $this->isBadAttendees = true;
    }

    public function show_all_attendees(){
        $this->isGoodAttendees = false;
        $this->isAttendees = true;
        $this->isBadAttendees = false;
    }

    public function show_attendees_form()
    {
        $this->dispatchBrowserEvent('show_attendees_form');
    }

    public function show_error_model()
    {
        $this->dispatchBrowserEvent('show_error_model', ['message' => 'Sorry the file extension must be xls,xlsx']);
    }

}
