<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Position;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PositionsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $position;
    public $perInfo=[];
    public $deletePositionId = null;
    public $showEditPositionForm = false;

    public function render()
    {
        $positions = Position::paginate(10);

        // $results = DB::table('position')
        //     ->join('employee', 'positionid', '=', 'position.id')
        //     ->get();

        // $results = DB::table('employees')
        //     ->join('positions', 'positions.id', '=', 'employees.positionid')
        //     ->join('departments', 'departments.id', '=', 'employees.departmentid')
        //     ->join('centers', 'centers.id', '=', 'employees.centerid')
        //     ->get();


        // $results = DB::table('positions')
        //     ->join('employees', 'employees.positionid', '=', 'positions.id')
        //     ->get();

        $positions = Position::paginate(10);

        return view('livewire.admin.positions-list', [
            /* 'results' => $results, */ 'positions' => $positions,
        ]);
    }

    public function newPositionForm()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'positionName' => 'required',
            'numberOfVacancies' => 'required',
        ])-> validate();

        Position::create($validatedData);

        $this->perInfo=[];

        $this->dispatchBrowserEvent('success_postiion_form', ['message' => 'Position added successfully']);
    }

    public function show_edit_position_form(Position $position)
    {
        $this->showEditPositionForm = true;
        $this->position = $position;
        $this->perInfo = $position->toArray();

        $this->dispatchBrowserEvent('show_position_form');
    }

    public function edit_position()
    {
        $validatedData =  Validator::make($this->perInfo, [
            'positionName' => 'required',
            'numberOfVacancies' => 'required',
        ])-> validate();

        $this->position->update($validatedData);

        $this->dispatchBrowserEvent('hide_position_form', ['message' => 'Position updated successfully']);

        $this->perInfo=[];

        $this->showEditPositionForm = false;
    }

    public function show_conformation_model($id)
    {

        $this->deletePositionId = $id;
        $this->dispatchBrowserEvent('show_conformation_model');

    }

    public function delete_position()
    {
        $id = Position::findOrFail($this->deletePositionId);
        $id->delete();

        $this->dispatchBrowserEvent('hide_conformation_model', ['message' => 'Position deleted successfully']);

    }
}
