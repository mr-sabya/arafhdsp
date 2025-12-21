<?php

namespace App\Livewire\Admin\District;

use App\Models\District;
use App\Models\Division;
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
    public $division_id;
    public $districts_input = []; // Array for dynamic rows
    public $districtId; // Used for single edit
    public $isEditMode = false;

    public function mount()
    {
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->districts_input = [
            ['name' => '', 'bn_name' => '']
        ];
        $this->division_id = null;
        $this->districtId = null;
        $this->isEditMode = false;
        $this->resetValidation();
    }

    public function addRow()
    {
        $this->districts_input[] = ['name' => '', 'bn_name' => ''];
    }

    public function removeRow($index)
    {
        unset($this->districts_input[$index]);
        $this->districts_input = array_values($this->districts_input);
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function save()
    {
        if ($this->isEditMode) {
            $this->validate([
                'division_id' => 'required',
                'districts_input.0.name' => 'required|string|max:255',
                'districts_input.0.bn_name' => 'nullable|string|max:255',
            ]);

            District::find($this->districtId)->update([
                'division_id' => $this->division_id,
                'name' => $this->districts_input[0]['name'],
                'bn_name' => $this->districts_input[0]['bn_name'],
            ]);
        } else {
            $this->validate([
                'division_id' => 'required',
                'districts_input.*.name' => 'required|string|max:255',
                'districts_input.*.bn_name' => 'nullable|string|max:255',
            ]);

            foreach ($this->districts_input as $item) {
                District::create([
                    'division_id' => $this->division_id,
                    'name' => $item['name'],
                    'bn_name' => $item['bn_name'],
                ]);
            }
        }

        $this->resetInputs();
        $this->dispatch(
            'notify',
            message: 'District saved successfully!',
            type: 'success' // You can pass 'danger', 'info', or 'warning'
        );
    }

    public function edit($id)
    {
        $this->resetInputs();
        $district = District::findOrFail($id);
        $this->districtId = $district->id;
        $this->division_id = $district->division_id;
        $this->districts_input = [
            ['name' => $district->name, 'bn_name' => $district->bn_name]
        ];
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        District::find($id)->delete();
        $this->dispatch(
            'notify',
            message: $this->isEditMode ? 'District deleted successfully!' : 'District deleted successfully!',
            type: 'success' // You can pass 'danger', 'info', or 'warning'
        );
    }

    public function render()
    {
        $districts = District::with('division')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhereHas('division', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.district.index', [
            'districts' => $districts,
            'divisions' => Division::all()
        ]);
    }
}
