<?php

namespace App\Livewire\Admin\Upazila;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Table States
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    // Form States
    public $selectedDivision = null; // For filtering districts
    public $districts_list = [];      // For the dropdown
    public $district_id;             // The actual parent
    public $upazilas_input = [];
    public $upazilaId;               // For single edit
    public $isEditMode = false;

    public function mount()
    {
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->upazilas_input = [['name' => '', 'bn_name' => '']];
        $this->selectedDivision = null;
        $this->districts_list = [];
        $this->district_id = null;
        $this->upazilaId = null;
        $this->isEditMode = false;
        $this->resetValidation();
    }

    // Dependent Dropdown Logic
    public function updatedSelectedDivision($divisionId)
    {
        $this->districts_list = District::where('division_id', $divisionId)->get();
        $this->district_id = null;
    }

    public function addRow()
    {
        $this->upazilas_input[] = ['name' => '', 'bn_name' => ''];
    }

    public function removeRow($index)
    {
        unset($this->upazilas_input[$index]);
        $this->upazilas_input = array_values($this->upazilas_input);
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function save()
    {
        $this->validate([
            'district_id' => 'required',
            'upazilas_input.*.name' => 'required|string|max:255',
            'upazilas_input.*.bn_name' => 'nullable|string|max:255',
        ], [
            'district_id.required' => 'Please select a district first.',
            'upazilas_input.*.name.required' => 'Upazila name is required.'
        ]);

        if ($this->isEditMode) {
            Upazila::find($this->upazilaId)->update([
                'district_id' => $this->district_id,
                'name' => $this->upazilas_input[0]['name'],
                'bn_name' => $this->upazilas_input[0]['bn_name'],
            ]);
            $msg = 'Upazila updated successfully!';
        } else {
            foreach ($this->upazilas_input as $item) {
                Upazila::create([
                    'district_id' => $this->district_id,
                    'name' => $item['name'],
                    'bn_name' => $item['bn_name'],
                ]);
            }
            $msg = count($this->upazilas_input) . ' Upazilas added successfully!';
        }

        $this->resetInputs();
        $this->dispatch('notify', message: $msg, type: 'success');
    }

    public function edit($id)
    {
        $this->resetInputs();
        $upazila = Upazila::with('district.division')->findOrFail($id);

        $this->upazilaId = $upazila->id;
        $this->isEditMode = true;

        // 1. Set Division and CAST to string
        $this->selectedDivision = (string) $upazila->district->division_id;

        // 2. MANUALLY load the districts for this division
        $this->districts_list = District::where('division_id', $this->selectedDivision)->get();

        // 3. Set the District ID and CAST to string
        // This is the key part to make it show as selected
        $this->district_id = (string) $upazila->district_id;

        $this->upazilas_input = [
            ['name' => $upazila->name, 'bn_name' => $upazila->bn_name]
        ];
    }

    public function delete($id)
    {
        Upazila::find($id)->delete();
        $this->dispatch('notify', message: 'Upazila deleted.', type: 'danger');
    }

    public function render()
    {
        $upazilas = Upazila::with(['district.division'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('district', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.upazila.index', [
            'upazilas' => $upazilas,
            'divisions' => Division::all()
        ]);
    }
}
