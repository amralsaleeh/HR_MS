<?php

namespace App\Http\Livewire\Admin;

use App\Models\Center;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class EmployeesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $employee;

    public $perInfo=[];

    public $showEditEmployerForm = false;
    public $deleteEmployeeId = null;

    public function render()
    {
        $employees = Employee::paginate(10);
        $positions = Position::get();
        $departments = Department::get();
        $centers = Center::get();

        return view('livewire.admin.employees-list', [
            'employees' => $employees, 'positions' => $positions, 'departments' => $departments, 'centers' => $centers,
        ]);
    }

    public function show_new_employer_form()
    {
        $this->perInfo = [];
        $this->showEditEmployerForm = false;
        $this->dispatchBrowserEvent('show_employer_form');
    }

    public function new_employer()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'nationalnumber' => 'required|unique:employees',
            'firstname' => 'required',
            'lastname' => 'required',
            'fathername' => 'required',
            'mothername' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'positionid' => 'required',
            'departmentid' => 'required',
            'centerid' => 'required',
            'startdate' => 'required',
            'phonenumber' => 'required|unique:employees',
        ])-> validate();

        // $validatedData['password'] = bcrypt($validatedData['password']);

        Employee::create($validatedData);

        $this->dispatchBrowserEvent('hide_employer_form', ['message' => 'Employee added successfully']);
    }

    public function show_edit_employer_form(Employee $employee)
    {
        $this->showEditEmployerForm = true;
        $this->employee = $employee;
        $this->perInfo = $employee->toArray();

        $this->dispatchBrowserEvent('show_employer_form');
    }

    public function edit_employer()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'nationalnumber' => 'required|unique:employees,phoneNumber,'.$this->employee->id,
            'fullname' => 'required',
            'birthdate' => 'required',
            'positionid' => 'required',
            'departmentid' => 'required',
            'centerid' => 'required',
            'startdate' => 'required',
            'phonenumber' => 'required|unique:employees,phoneNumber,'.$this->employee->id,
        ])-> validate();

        $this->employee->update($validatedData);

        $this->dispatchBrowserEvent('hide_employer_form', ['message' => 'Employee updated successfully']);
    }

    public function show_conformation_model($employeeId)
    {
        $this->deleteEmployeeId = $employeeId;

        $this->dispatchBrowserEvent('show_conformation_model');
    }

    public function delete_employee()
    {
        $employee = Employee::findOrFail($this->deleteEmployeeId);
        $employee->delete();

        $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Employee deleted successfully']);
    }



}
