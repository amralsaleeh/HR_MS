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
    // Pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Objects
    public $employee;
    public $perInfo=[];
    public $showEditEmployerForm = false;
    public $deleteEmployeeId = null;

    // Render
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

    // Show import form
    public function show_import_form()
    {
        $this->dispatchBrowserEvent('show_import_form');
    }

    // Show new form
    public function show_new_employer_form()
    {
        $this->perInfo = [];
        $this->showEditEmployerForm = false;

        $this->dispatchBrowserEvent('show_employer_form');
    }

    // New employer
    public function new_employer()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'id' => 'required|unique:employees',
            'nationalNumber' => 'required|unique:employees',
            'firstName' => 'required',
            'fatherName' => 'required',
            'lastName' => 'required',
            'motherName' => 'required',
            'degree' => 'nullable',
            'address' => 'nullable',
            'phoneNumber' => 'required|unique:employees',
            'birthAndPlace' => 'required',
            'gender' => 'required',
            'startDate' => 'required',
            'quitDate' => 'required',
            'isActive' => 'required',
            'notes' => 'nullable',
            'earlyPositionId' => 'nullable',
            'positionId' => 'required',
            'departmentId' => 'required',
            'centerId' => 'required',
        ])-> validate();

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['firstName'] = ucfirst($validatedData['firstName']);
        $validatedData['fatherName'] = ucfirst($validatedData['fatherName']);
        $validatedData['lastName'] = ucfirst($validatedData['lastName']);
        $validatedData['motherName'] = ucfirst($validatedData['motherName']);

        $validatedData['fullName'] = $validatedData['firstName']  . ' ' . $validatedData['fatherName'] . ' ' .  $validatedData['lastName'];
        Employee::create($validatedData);

        $this->dispatchBrowserEvent('hide_employer_form', ['message' => 'Employee added successfully']);
    }

    // Show edit form
    public function show_edit_employer_form(Employee $employee)
    {
        $this->showEditEmployerForm = true;
        $this->employee = $employee;
        $this->perInfo = $employee->toArray();

        $this->dispatchBrowserEvent('show_employer_form');
    }

    // Edit employer
    public function edit_employer()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'id' => 'required|unique:employees',
            'nationalNumber' => 'required|unique:employees',
            'firstName' => 'required',
            'fatherName' => 'required',
            'lastName' => 'required',
            'motherName' => 'required',
            'degree' => 'nullable',
            'address' => 'nullable',
            'phoneNumber' => 'required|unique:employees',
            'birthAndPlace' => 'required',
            'gender' => 'required',
            'startDate' => 'required',
            'quitDate' => 'required',
            'isActive' => 'required',
            'notes' => 'nullable',
            'earlyPositionId' => 'nullable',
            'positionId' => 'required',
            'departmentId' => 'required',
            'centerId' => 'required',
        ])-> validate();

        $validatedData['firstName'] = ucfirst($validatedData['firstName']);
        $validatedData['fatherName'] = ucfirst($validatedData['fatherName']);
        $validatedData['lastName'] = ucfirst($validatedData['lastName']);
        $validatedData['motherName'] = ucfirst($validatedData['motherName']);

        $validatedData['fullname'] = $validatedData['firstName']  . ' ' . $validatedData['fatherName'] . ' ' .  $validatedData['lastName'];

        $this->employee->update($validatedData);

        $this->dispatchBrowserEvent('hide_employer_form', ['message' => 'Employee updated successfully']);
    }

    // Conformation
    public function show_conformation_model($employeeId)
    {
        $this->deleteEmployeeId = $employeeId;

        $this->dispatchBrowserEvent('show_conformation_model');
    }

    // Delete
    public function delete_employee()
    {
        $employee = Employee::findOrFail($this->deleteEmployeeId);
        $employee->delete();

        $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Employee deleted successfully']);
    }
}
