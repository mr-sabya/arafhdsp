<?php

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Table States
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    // Form States
    public $roleId;
    public $name;
    public $slug;
    public $isEditMode = false;

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function resetFields()
    {
        $this->reset(['name', 'slug', 'roleId', 'isEditMode']);
        $this->resetValidation();
    }

    // Optional: Auto-generate slug when name is updated
    public function updatedName($value)
    {
        if (!$this->isEditMode) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug,' . $this->roleId,
        ];

        $this->validate($rules);

        Role::updateOrCreate(
            ['id' => $this->roleId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->slug) // Ensure slug format
            ]
        );

        $message = $this->isEditMode ? 'Role updated successfully!' : 'Role created successfully!';

        $this->resetFields();
        $this->dispatch(
            'notify',
            message: $message,
            type: 'success'
        );
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->slug = $role->slug;
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        Role::find($id)->delete();
        $this->dispatch(
            'notify',
            message: 'Role deleted successfully!',
            type: 'success'
        );
    }

    public function render()
    {
        $roles = Role::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('slug', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.role.index', [
            'roles' => $roles
        ]);
    }
}
