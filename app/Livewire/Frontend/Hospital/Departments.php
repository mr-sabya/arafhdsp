<?php

namespace App\Livewire\Frontend\Hospital;

use App\Models\Department;
use Livewire\Component;

class Departments extends Component
{
    public function render()
    {
        $departments = Department::where('status', 1)
                ->orderBy('sort_order', 'asc')
                ->get();
        return view('livewire.frontend.hospital.departments',[
            'departments' => $departments,
        ]);
    }
}
