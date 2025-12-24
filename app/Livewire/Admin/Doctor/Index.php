<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $department_id, $name_en, $name_bn, $designation_en, $designation_bn;
    public $degree_en, $degree_bn, $base_fee = 0, $discount_percentage = 0;
    public $appointment_number, $bio_en, $bio_bn, $sort_order = 0, $status = 1;
    public $photo, $existingPhoto;

    public $doctorId;
    public $isEditMode = false;
    public $isOpen = false;

    // Table State
    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';

    protected function rules()
    {
        return [
            'department_id' => 'required',
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'base_fee' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|integer|min:0|max:100',
            'appointment_number' => 'nullable|string',
            'photo' => $this->isEditMode ? 'nullable|image|max:1024' : 'required|image|max:1024',
            'sort_order' => 'required|integer',
            'status' => 'required',
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
        $this->reset([
            'department_id',
            'name_en',
            'name_bn',
            'designation_en',
            'designation_bn',
            'degree_en',
            'degree_bn',
            'base_fee',
            'discount_percentage',
            'appointment_number',
            'bio_en',
            'bio_bn',
            'photo',
            'existingPhoto',
            'doctorId',
            'isEditMode'
        ]);
        $this->status = 1;
        $this->sort_order = 0;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'department_id' => $this->department_id,
            'name_en' => $this->name_en,
            'name_bn' => $this->name_bn,
            'designation_en' => $this->designation_en,
            'designation_bn' => $this->designation_bn,
            'degree_en' => $this->degree_en,
            'degree_bn' => $this->degree_bn,
            'base_fee' => $this->base_fee,
            'discount_percentage' => $this->discount_percentage ?? 0,
            'appointment_number' => $this->appointment_number,
            'bio_en' => $this->bio_en,
            'bio_bn' => $this->bio_bn,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('doctors', 'public');
            if ($this->isEditMode && $this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
        }

        if ($this->isEditMode) {
            Doctor::find($this->doctorId)->update($data);
            $this->dispatch('notify', message: 'Doctor updated successfully!', type: 'success');
        } else {
            Doctor::create($data);
            $this->dispatch('notify', message: 'Doctor added successfully!', type: 'success');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $this->doctorId = $id;
        $this->department_id = $doctor->department_id;
        $this->name_en = $doctor->name_en;
        $this->name_bn = $doctor->name_bn;
        $this->designation_en = $doctor->designation_en;
        $this->designation_bn = $doctor->designation_bn;
        $this->degree_en = $doctor->degree_en;
        $this->degree_bn = $doctor->degree_bn;
        $this->base_fee = $doctor->base_fee;
        $this->discount_percentage = $doctor->discount_percentage;
        $this->appointment_number = $doctor->appointment_number;
        $this->bio_en = $doctor->bio_en;
        $this->bio_bn = $doctor->bio_bn;
        $this->existingPhoto = $doctor->photo;
        $this->sort_order = $doctor->sort_order;
        $this->status = $doctor->status ? 1 : 0;

        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function delete($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor->photo) Storage::disk('public')->delete($doctor->photo);
        $doctor->delete();
        $this->dispatch('notify', message: 'Doctor removed successfully!', type: 'danger');
    }

    public function render()
    {
        $departments = Department::all();
        $doctors = Doctor::with('department')
            ->where('name_en', 'like', '%' . $this->search . '%')
            ->orWhere('name_bn', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.doctor.index', [
            'doctors' => $doctors,
            'departments' => $departments
        ]);
    }
}
