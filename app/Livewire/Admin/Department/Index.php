<?php

namespace App\Livewire\Admin\Department;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $name_en, $name_bn, $icon = 'fas fa-user-md', $sort_order = 0, $status = 1;
    public $departmentId;
    public $isEditMode = false;

    // Table State
    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';

    protected $rules = [
        'name_en' => 'required|string|max:255',
        'name_bn' => 'required|string|max:255',
        'icon' => 'required|string|max:100',
        'sort_order' => 'required|integer|min:0',
        'status' => 'required|boolean',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function resetFields()
    {
        $this->reset(['name_en', 'name_bn', 'icon', 'sort_order', 'status', 'departmentId', 'isEditMode']);
        $this->icon = 'fas fa-user-md';
        $this->status = 1;
        $this->sort_order = 0;
        $this->resetValidation();
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->isEditMode) {
            Department::find($this->departmentId)->update($data);
            $this->dispatch('notify', message: 'Department updated successfully!', type: 'success');
        } else {
            Department::create($data);
            $this->dispatch('notify', message: 'Department created successfully!', type: 'success');
        }

        $this->resetFields();
    }

    public function edit($id)
    {
        $dept = Department::findOrFail($id);
        $this->departmentId = $id;
        $this->name_en = $dept->name_en;
        $this->name_bn = $dept->name_bn;
        $this->icon = $dept->icon;
        $this->sort_order = $dept->sort_order;
        $this->status = $dept->status ? 1 : 0;

        $this->isEditMode = true;
    }

    public function delete($id)
    {
        Department::find($id)->delete();
        $this->dispatch('notify', message: 'Department deleted successfully!', type: 'danger');
    }

    public function render()
    {
        $departments = Department::where('name_en', 'like', '%' . $this->search . '%')
            ->orWhere('name_bn', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.department.index', [
            'departments' => $departments
        ]);
    }
}
