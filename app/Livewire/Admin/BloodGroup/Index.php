<?php

namespace App\Livewire\Admin\BloodGroup;

use App\Models\BloodGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Table States
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';

    // Form States
    public $bloodGroupId;
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
        $this->reset(['name', 'bn_name', 'bloodGroupId', 'isEditMode']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:10|unique:blood_groups,name,' . $this->bloodGroupId,
            'bn_name' => 'nullable|string|max:255',
        ]);

        // Fix the slug error: replace + with positive and - with negative
        $cleanName = str_replace(['+', '-'], [' positive', ' negative'], $this->name);
        $slug = Str::slug($cleanName);

        BloodGroup::updateOrCreate(
            ['id' => $this->bloodGroupId],
            [
                'name' => $this->name,
                'bn_name' => $this->bn_name,
                'slug' => $slug,
            ]
        );

        $this->dispatch('notify', message: $this->isEditMode ? 'Blood group updated!' : 'Blood group added!', type: 'success');
        $this->resetFields();
    }

    public function edit($id)
    {
        $this->resetFields();
        $group = BloodGroup::findOrFail($id);
        $this->bloodGroupId = $group->id;
        $this->name = $group->name;
        $this->bn_name = $group->bn_name;
        $this->isEditMode = true;
    }

    public function delete($id)
    {
        BloodGroup::find($id)->delete();
        $this->dispatch('notify', message: 'Blood group deleted.', type: 'danger');
    }

    public function render()
    {
        $bloodGroups = BloodGroup::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('bn_name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.blood-group.index', [
            'bloodGroups' => $bloodGroups
        ]);
    }
}
