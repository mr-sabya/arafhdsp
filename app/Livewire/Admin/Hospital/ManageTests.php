<?php

namespace App\Livewire\Admin\Hospital;

use App\Models\Hospital;
use App\Models\MedicalTest;
use Livewire\Component;

class ManageTests extends Component
{
    public $hospital;
    public $hospitalId;
    
    // Search & Selection
    public $search_test = '';
    public $selected_test = null;
    
    // Form fields
    public $price, $discount_percent = 0;

    protected $listeners = ['openManageTests' => 'loadHospital'];

    public function loadHospital($id)
    {
        $this->hospitalId = $id;
        $this->hospital = Hospital::with('tests')->findOrFail($id);
        $this->clearSelection();
    }

    public function selectTest($testId)
    {
        $this->selected_test = MedicalTest::find($testId);
        $this->search_test = '';
    }

    public function clearSelection()
    {
        $this->reset(['selected_test', 'search_test', 'price', 'discount_percent']);
    }

    public function addTest()
    {
        $this->validate([
            'selected_test' => 'required',
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        $this->hospital->tests()->syncWithoutDetaching([
            $this->selected_test->id => [
                'price' => $this->price,
                'discount_percent' => $this->discount_percent
            ]
        ]);

        $this->loadHospital($this->hospitalId);
        $this->dispatch('notify', message: 'Test added successfully', type: 'success');
    }

    public function removeTest($testId)
    {
        $this->hospital->tests()->detach($testId);
        $this->loadHospital($this->hospitalId);
    }

    public function closeModal()
    {
        $this->hospital = null;
    }

    public function render()
    {
        $searchResults = [];
        if (strlen($this->search_test) >= 2) {
            $searchResults = MedicalTest::where('name_en', 'like', "%{$this->search_test}%")
                ->orWhere('name_bn', 'like', "%{$this->search_test}%")
                ->limit(5)->get();
        }

        return view('livewire.admin.hospital.manage-tests', [
            'searchResults' => $searchResults
        ]);
    }
}