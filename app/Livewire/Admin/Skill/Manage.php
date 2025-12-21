<?php

namespace App\Livewire\Admin\Skill;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Skill;
use App\Models\SkillCategory;

class Manage extends Component
{
    use WithPagination;

    // View Control: 'skills' or 'categories'
    public $viewType = 'skills';

    // Common Props
    public $search = '';
    public $perPage = 10;
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';
    public $isEditMode = false;

    // Form Props (Mixed for both models)
    public $edit_id;
    public $title;      // Used for Category Title
    public $name;       // Used for Skill Name
    public $percent;    // Used for Skill Percent
    public $category_id; // Used for Skill -> Category relationship
    public $sort_order = 0;
    public $status = true;

    // Reset pagination when search changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Switch View Mode (Skills <-> Categories)
    public function setView($type)
    {
        $this->viewType = $type;
        $this->resetInputFields();
        $this->resetPage();
        $this->search = '';
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEditMode = false;
        $this->dispatch('show-modal');
    }

    public function edit($id)
    {
        $this->isEditMode = true;
        $this->edit_id = $id;

        if ($this->viewType === 'skills') {
            $data = Skill::findOrFail($id);
            $this->name = $data->name;
            $this->percent = $data->percent;
            $this->category_id = $data->skill_category_id;
        } else {
            $data = SkillCategory::findOrFail($id);
            $this->title = $data->title;
        }

        $this->sort_order = $data->sort_order;
        $this->status = $data->status;

        $this->dispatch('show-modal');
    }

    public function store()
    {
        if ($this->viewType === 'skills') {
            $this->validate([
                'name' => 'required|string|max:255',
                'percent' => 'required|integer|min:0|max:100',
                'category_id' => 'required|exists:skill_categories,id',
                'sort_order' => 'integer',
            ]);

            Skill::updateOrCreate(['id' => $this->edit_id], [
                'name' => $this->name,
                'percent' => $this->percent,
                'skill_category_id' => $this->category_id,
                'sort_order' => $this->sort_order,
                'status' => $this->status,
            ]);
        } else {
            $this->validate([
                'title' => 'required|string|max:255',
                'sort_order' => 'integer',
            ]);

            SkillCategory::updateOrCreate(['id' => $this->edit_id], [
                'title' => $this->title,
                'sort_order' => $this->sort_order,
                'status' => $this->status,
            ]);
        }

        $this->dispatch('hide-modal');
        $this->dispatch('show-toast', [
            'message' => ucfirst(rtrim($this->viewType, 's')) . ' saved successfully!',
            'type' => 'success'
        ]);
        $this->resetInputFields();
    }

    public function delete($id)
    {
        if ($this->viewType === 'skills') {
            Skill::find($id)->delete();
        } else {
            SkillCategory::find($id)->delete(); // Cascades to skills based on migration
        }

        $this->dispatch('show-toast', ['message' => 'Deleted successfully', 'type' => 'error']);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    private function resetInputFields()
    {
        $this->edit_id = null;
        $this->title = '';
        $this->name = '';
        $this->percent = '';
        $this->category_id = '';
        $this->sort_order = 0;
        $this->status = true;
    }

    public function render()
    {
        if ($this->viewType === 'skills') {
            $data = Skill::with('category')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);
        } else {
            $data = SkillCategory::where('title', 'like', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage);
        }

        // Always needed for the dropdown in Skill form
        $categories = SkillCategory::orderBy('sort_order')->get();

        return view('livewire.admin.skill.manage', [
            'data' => $data,
            'categories' => $categories
        ]);
    }
}
