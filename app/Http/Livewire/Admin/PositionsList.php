<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Position;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PositionsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $position;


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

        $results = DB::table('positions')
            ->join('employees', 'employees.positionid', '=', 'positions.id')
            ->get();

        return view('livewire.admin.positions-list', [
            'results' => $results,
        ]);
    }
}
