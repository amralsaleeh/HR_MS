<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Position;
use Livewire\WithPagination;

class PositionsList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $position;

    public function render()
    {
        $positions = Position::paginate(10);

        return view('livewire.admin.positions-list', [
            'positions' => $positions,
        ]);
    }
}
