<?php

namespace App\Livewire\Admin\Hospital;

use App\Models\Doctor;
use App\Models\Hospital;
use Livewire\Component;

class ManageDoctors extends Component
{
    public $hospital;
    public $hospitalId;

    // Search & Selection
    public $search_doctor = '';
    public $selected_doctor = null; // To hold the doctor picked from search

    // Pivot data
    public $fee, $discount_percent = 0;

    protected $listeners = ['openManageDoctors' => 'loadHospital'];

    public function loadHospital($id)
    {
        $this->hospitalId = $id;
        $this->hospital = Hospital::with('doctors')->findOrFail($id);
        $this->resetForm();
    }

    public function selectDoctor($doctorId)
    {
        $this->selected_doctor = Doctor::find($doctorId);
        $this->search_doctor = ''; // Clear search list
    }

    public function resetForm()
    {
        $this->reset(['search_doctor', 'selected_doctor', 'fee', 'discount_percent']);
    }

    public function addDoctor()
    {
        $this->validate([
            'selected_doctor' => 'required',
            'fee' => 'required|numeric|min:0',
            'discount_percent' => 'required|numeric|min:0|max:100',
        ]);

        $this->hospital->doctors()->syncWithoutDetaching([
            $this->selected_doctor->id => [
                'fee' => $this->fee,
                'discount_percent' => $this->discount_percent
            ]
        ]);

        $this->loadHospital($this->hospitalId);
        $this->dispatch('notify', message: 'Doctor added successfully', type: 'success');
    }

    public function removeDoctor($doctorId)
    {
        $this->hospital->doctors()->detach($doctorId);
        $this->loadHospital($this->hospitalId);
    }

    public function closeModal()
    {
        $this->hospital = null;
        $this->resetForm();
    }

    public function clearSelection()
    {
        $this->selected_doctor = null;
        $this->search_doctor = '';
        // Optional: reset fee and discount when unselecting
        $this->fee = null;
        $this->discount_percent = 0;
    }

    public function render()
    {
        $searchResults = [];

        // Only search if user has typed at least 2 characters
        if (strlen($this->search_doctor) >= 2) {
            $searchResults = Doctor::where('name_en', 'like', "%{$this->search_doctor}%")
                ->orWhere('name_bn', 'like', "%{$this->search_doctor}%")
                ->limit(5) // Keep it fast
                ->get();
        }

        return view('livewire.admin.hospital.manage-doctors', [
            'searchResults' => $searchResults
        ]);
    }
}
