<?php

namespace App\Livewire\Admin\Division;

use App\Models\Division;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Table States
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    // Form States
    public $divisionId;
    public $name;
    public $bn_name;
    public $isEditMode = false;

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function resetFields()
    {
        $this->reset(['name', 'bn_name', 'divisionId', 'isEditMode']);
        $this->resetValidation();
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255|unique:divisions,name,' . $this->divisionId,
            'bn_name' => 'nullable|string|max:255',
        ];

        $this->validate($rules);

        Division::updateOrCreate(
            ['id' => $this->divisionId],
            ['name' => $this->name, 'bn_name' => $this->bn_name]
        );

        $this->resetFields();
        $this->dispatch(
            'notify',
            message: $this->isEditMode ? 'Division updated successfully!' : 'Division created successfully!',
            type: 'success' // You can pass 'danger', 'info', or 'warning'
        );
    }

    public function edit($id)
    {
        $division = Division::findOrFail($id);
        $this->divisionId = $division->id;
        $this->name = $division->name;
        $this->bn_name = $division->bn_name;
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        Division::find($id)->delete();
        $this->dispatch(
            'notify',
            message: 'Division deleted successfully!',
            type: 'success' // You can pass 'danger', 'info', or 'warning'
        );
    }

    public function render()
    {
        $divisions = Division::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('bn_name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.division.index', [
            'divisions' => $divisions
        ]);
    }
}
