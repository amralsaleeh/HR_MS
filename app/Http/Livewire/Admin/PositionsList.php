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

        $results = DB::table('employee')
            ->join('position', 'position.id', '=', 'employee.positionid')
            ->join('department', 'department.id', '=', 'employee.departmentid')
            ->join('center', 'center.id', '=', 'employee.centerid')
            ->get();

        return view('livewire.admin.positions-list', [
            'results' => $results,
        ]);
    }
}
