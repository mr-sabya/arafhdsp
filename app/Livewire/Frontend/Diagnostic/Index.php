<?php

namespace App\Livewire\Frontend\Diagnostic;

use App\Models\DiagnosticCenter;
use App\Models\Division;
use App\Models\District;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $division_id = '';
    public $district_id = '';
    public $districts = [];

    protected $paginationTheme = 'bootstrap';

    public function updatedDivisionId($value)
    {
        $this->districts = District::where('division_id', $value)->get();
        $this->district_id = '';
        $this->resetPage();
    }

    public function updatedDistrictId()
    {
        $this->resetPage();
    }
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $divisions = Division::all();

        $centers = DiagnosticCenter::with(['division', 'district', 'area'])
            ->where('status', 1)
            ->when($this->division_id, fn($q) => $q->where('division_id', $this->division_id))
            ->when($this->district_id, fn($q) => $q->where('district_id', $this->district_id))
            ->when($this->search, function ($q) {
                $q->where('name_en', 'like', "%{$this->search}%")
                    ->orWhere('name_bn', 'like', "%{$this->search}%");
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(9);

        return view('livewire.frontend.diagnostic.index', [
            'centers' => $centers,
            'divisions' => $divisions
        ]);
    }
}
