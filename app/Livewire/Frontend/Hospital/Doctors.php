<?php

namespace App\Livewire\Frontend\Hospital;

use App\Models\Doctor;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Doctors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $selectedDepartment = '';

    // Reset pagination when search or filter changes
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedSelectedDepartment()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Fetch departments for the filter dropdown
        $departments = Department::where('status', 1)->orderBy('sort_order', 'asc')->get();

        // Query doctors with filters
        $doctors = Doctor::with('department')
            ->where('status', 1)
            ->when($this->selectedDepartment, function ($query) {
                $query->where('department_id', $this->selectedDepartment);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name_en', 'like', '%' . $this->search . '%')
                        ->orWhere('name_bn', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(12);

        return view('livewire.frontend.hospital.doctors', [
            'doctors' => $doctors,
            'departments' => $departments
        ]);
    }
}
