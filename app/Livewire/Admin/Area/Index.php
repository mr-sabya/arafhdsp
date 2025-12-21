<?php

namespace App\Livewire\Admin\Area;

use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Area;
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
    public $selectedDivision = null;
    public $selectedDistrict = null;
    public $districts_list = [];
    public $upazilas_list = [];

    public $upazila_id; // The final parent
    public $areas_input = [];
    public $areaId;     // For single edit
    public $isEditMode = false;

    public function mount()
    {
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->areas_input = [['name' => '', 'bn_name' => '', 'post_code' => '']];
        $this->selectedDivision = null;
        $this->selectedDistrict = null;
        $this->districts_list = [];
        $this->upazilas_list = [];
        $this->upazila_id = null;
        $this->areaId = null;
        $this->isEditMode = false;
        $this->resetValidation();
    }

    // Triple Dependent Dropdown Logic
    public function updatedSelectedDivision($divisionId)
    {
        $this->districts_list = District::where('division_id', $divisionId)->get();
        $this->reset(['selectedDistrict', 'upazilas_list', 'upazila_id']);
    }

    public function updatedSelectedDistrict($districtId)
    {
        $this->upazilas_list = Upazila::where('district_id', $districtId)->get();
        $this->reset(['upazila_id']);
    }

    public function addRow()
    {
        $this->areas_input[] = ['name' => '', 'bn_name' => '', 'post_code' => ''];
    }

    public function removeRow($index)
    {
        unset($this->areas_input[$index]);
        $this->areas_input = array_values($this->areas_input);
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function save()
    {
        $this->validate([
            'upazila_id' => 'required',
            'areas_input.*.name' => 'required|string|max:255',
            'areas_input.*.bn_name' => 'nullable|string|max:255',
        ], [
            'upazila_id.required' => 'Please select an Upazila first.',
            'areas_input.*.name.required' => 'Area name is required.'
        ]);

        if ($this->isEditMode) {
            Area::find($this->areaId)->update([
                'upazila_id' => $this->upazila_id,
                'name' => $this->areas_input[0]['name'],
                'bn_name' => $this->areas_input[0]['bn_name'],
                'post_code' => $this->areas_input[0]['post_code'],
            ]);
            $msg = 'Area updated successfully!';
        } else {
            foreach ($this->areas_input as $item) {
                Area::create([
                    'upazila_id' => $this->upazila_id,
                    'name' => $item['name'],
                    'bn_name' => $item['bn_name'],
                    'post_code' => $item['post_code'],
                ]);
            }
            $msg = count($this->areas_input) . ' Areas added successfully!';
        }

        $this->resetInputs();
        $this->dispatch('notify', message: $msg, type: 'success');
    }

    public function edit($id)
    {
        $this->resetInputs();

        // Eager load relations to prevent extra queries
        $area = Area::with('upazila.district.division')->findOrFail($id);

        $this->areaId = $area->id;
        $this->isEditMode = true;

        // 1. Set Division and fetch Districts
        $this->selectedDivision = (string) $area->upazila->district->division_id;
        $this->districts_list = District::where('division_id', $this->selectedDivision)->get();

        // 2. Set District and fetch Upazilas
        $this->selectedDistrict = (string) $area->upazila->district_id;
        $this->upazilas_list = Upazila::where('district_id', $this->selectedDistrict)->get();

        // 3. Set the final Upazila ID
        $this->upazila_id = (string) $area->upazila_id;

        // 4. Set input fields
        $this->areas_input = [
            [
                'name' => $area->name,
                'bn_name' => $area->bn_name,
                'post_code' => $area->post_code
            ]
        ];
    }

    public function delete($id)
    {
        Area::find($id)->delete();
        $this->dispatch('notify', message: 'Area deleted.', type: 'danger');
    }

    public function render()
    {
        $areas = Area::with(['upazila.district.division'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('upazila', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.area.index', [
            'areas' => $areas,
            'divisions' => Division::all()
        ]);
    }
}
