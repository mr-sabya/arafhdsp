<?php

namespace App\Livewire\Admin\MedicalTest;

use App\Models\MedicalTestCategory;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $name_en, $name_bn, $sort_order = 0, $status = 1;
    public $categoryId, $isEditMode = false, $isOpen = false, $search = '';

    protected function rules()
    {
        return [
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ];
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
    }

    public function resetFields()
    {
        $this->reset(['name_en', 'name_bn', 'sort_order', 'status', 'categoryId', 'isEditMode']);
        $this->status = 1;
        $this->sort_order = 0;
    }

    public function save()
    {
        $this->validate();

        MedicalTestCategory::updateOrCreate(['id' => $this->categoryId], [
            'name_en' => $this->name_en,
            'name_bn' => $this->name_bn,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ]);

        $this->dispatch('notify', 
            message: $this->isEditMode ? 'Category Updated' : 'Category Created', 
            type: 'success'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $category = MedicalTestCategory::findOrFail($id);
        $this->categoryId = $id;
        $this->name_en = $category->name_en;
        $this->name_bn = $category->name_bn;
        $this->sort_order = $category->sort_order;
        $this->status = $category->status;
        
        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        MedicalTestCategory::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Category Deleted', type: 'danger');
    }

    public function toggleStatus($id)
    {
        $category = MedicalTestCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();
    }

    public function render()
    {
        $categories = MedicalTestCategory::where('name_en', 'like', '%' . $this->search . '%')
            ->orWhere('name_bn', 'like', '%' . $this->search . '%')
            ->orderBy('sort_order', 'asc')
            ->paginate(10);

        return view('livewire.admin.medical-test.category-index', [
            'categories' => $categories
        ]);
    }
}