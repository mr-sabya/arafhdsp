<?php

namespace App\Livewire\Admin\MedicalTest;

use App\Models\MedicalTest;
use App\Models\MedicalTestCategory;
use Livewire\Component;
use Livewire\WithPagination;

class TestIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $medical_test_category_id, $name_en, $name_bn, $status = 1;
    public $testId, $isEditMode = false, $isOpen = false, $search = '';
    public $filterCategory = ''; // For filtering the table

    protected function rules()
    {
        return [
            'medical_test_category_id' => 'required|exists:medical_test_categories,id',
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
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
        $this->reset(['medical_test_category_id', 'name_en', 'name_bn', 'status', 'testId', 'isEditMode']);
        $this->status = 1;
    }

    public function save()
    {
        $this->validate();

        MedicalTest::updateOrCreate(['id' => $this->testId], [
            'medical_test_category_id' => $this->medical_test_category_id,
            'name_en' => $this->name_en,
            'name_bn' => $this->name_bn,
            'status' => $this->status,
        ]);

        $this->dispatch(
            'notify',
            message: $this->isEditMode ? 'Medical Test Updated' : 'Medical Test Created',
            type: 'success'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $test = MedicalTest::findOrFail($id);
        $this->testId = $id;
        $this->medical_test_category_id = $test->medical_test_category_id;
        $this->name_en = $test->name_en;
        $this->name_bn = $test->name_bn;
        $this->status = $test->status;

        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        MedicalTest::findOrFail($id)->delete();
        $this->dispatch('notify', message: 'Test Deleted', type: 'danger');
    }

    public function toggleStatus($id)
    {
        $test = MedicalTest::findOrFail($id);
        $test->status = !$test->status;
        $test->save();
    }

    public function render()
    {
        $query = MedicalTest::with('category')
            ->where(function ($q) {
                $q->where('name_en', 'like', '%' . $this->search . '%')
                    ->orWhere('name_bn', 'like', '%' . $this->search . '%');
            });

        if ($this->filterCategory) {
            $query->where('medical_test_category_id', $this->filterCategory);
        }

        return view('livewire.admin.medical-test.test-index', [
            'tests' => $query->latest()->paginate(15),
            'categories' => MedicalTestCategory::where('status', 1)->orderBy('name_en')->get()
        ]);
    }
}
