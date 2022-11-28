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
        $result = DB::table('position')
               ->crossJoin('employee')
               ->get();

               dd($result);

        $positions = Position::paginate(10);

        return view('livewire.admin.positions-list', [
            'positions' => $positions,
        ]);
    }
}
