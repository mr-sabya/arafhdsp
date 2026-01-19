<?php

namespace App\Livewire\Admin\Hospital;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Hospital;
use App\Models\Upazila;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $name_en, $name_bn, $address_en, $address_bn, $phone, $photo, $existingPhoto;
    public $type = 'hospital', $serial_phones = []; 
    public $division_id, $district_id, $upazila_id, $area_id;
    public $sort_order = 0, $status = 1;
    public $benefits = [];

    public $districts = [], $upazilas = [], $areas = [];
    public $hospitalId, $isEditMode = false, $isOpen = false, $search = '';

    protected function rules()
    {
        return [
            'name_en' => 'required|string',
            'name_bn' => 'required|string',
            'type' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'photo' => $this->isEditMode ? 'nullable|image|max:1024' : 'required|image|max:1024',
            'serial_phones.*' => 'nullable|string',
        ];
    }

    public function addBenefit()
    {
        $this->benefits[] = ['text_en' => '', 'text_bn' => '', 'class' => 'bg-info text-dark'];
    }

    public function removeBenefit($index)
    {
        unset($this->benefits[$index]);
        $this->benefits = array_values($this->benefits);
    }

    public function addSerialPhone()
    {
        $this->serial_phones[] = '';
    }

    public function removeSerialPhone($index)
    {
        unset($this->serial_phones[$index]);
        $this->serial_phones = array_values($this->serial_phones);
    }

    public function updatedDivisionId($value)
    {
        $this->districts = District::where('division_id', $value)->get();
        $this->reset(['district_id', 'upazila_id', 'area_id', 'upazilas', 'areas']);
    }

    public function updatedDistrictId($value)
    {
        $this->upazilas = Upazila::where('district_id', $value)->get();
        $this->reset(['upazila_id', 'area_id', 'areas']);
    }

    public function updatedUpazilaId($value)
    {
        $this->areas = Area::where('upazila_id', $value)->get();
        $this->reset(['area_id']);
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
            'name_en', 'name_bn', 'address_en', 'address_bn', 'phone', 'photo', 'existingPhoto',
            'division_id', 'district_id', 'upazila_id', 'area_id', 'hospitalId', 'isEditMode',
            'benefits', 'type', 'serial_phones'
        ]);
        $this->status = 1;
        $this->sort_order = 0;
        $this->type = 'hospital';
        $this->benefits = [];
        $this->serial_phones = [];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name_en' => $this->name_en,
            'name_bn' => $this->name_bn,
            'type' => $this->type,
            'address_en' => $this->address_en,
            'address_bn' => $this->address_bn,
            'phone' => $this->phone,
            'serial_phones' => array_filter($this->serial_phones),
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'area_id' => $this->area_id,
            'benefits' => $this->benefits,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('hospitals', 'public');
            if ($this->isEditMode && $this->existingPhoto) Storage::disk('public')->delete($this->existingPhoto);
        }

        Hospital::updateOrCreate(['id' => $this->hospitalId], $data);

        $this->dispatch('notify', message: $this->isEditMode ? 'Hospital Updated' : 'Hospital Added', type: 'success');
        $this->closeModal();
    }

    public function edit($id)
    {
        $hosp = Hospital::findOrFail($id);
        $this->hospitalId = $id;
        $this->name_en = $hosp->name_en;
        $this->name_bn = $hosp->name_bn;
        $this->type = $hosp->type;
        $this->address_en = $hosp->address_en;
        $this->address_bn = $hosp->address_bn;
        $this->phone = $hosp->phone;
        $this->serial_phones = $hosp->serial_phones ?? [];
        $this->division_id = $hosp->division_id;

        $this->districts = District::where('division_id', $hosp->division_id)->get();
        $this->district_id = $hosp->district_id;
        $this->upazilas = Upazila::where('district_id', $hosp->district_id)->get();
        $this->upazila_id = $hosp->upazila_id;
        $this->areas = Area::where('upazila_id', $hosp->upazila_id)->get();
        $this->area_id = $hosp->area_id;

        $this->benefits = $hosp->benefits ?? [];
        $this->existingPhoto = $hosp->photo;
        $this->sort_order = $hosp->sort_order;
        $this->status = $hosp->status;
        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        $hosp = Hospital::find($id);
        if ($hosp->photo) Storage::disk('public')->delete($hosp->photo);
        $hosp->delete();
        $this->dispatch('notify', message: 'Hospital Removed', type: 'danger');
    }

    public function render()
    {
        return view('livewire.admin.hospital.index', [
            'hospitals' => Hospital::with(['district', 'area'])
                ->where('name_en', 'like', "%{$this->search}%")
                ->orWhere('name_bn', 'like', "%{$this->search}%")
                ->orderBy('sort_order', 'asc')->paginate(12),
            'divisions' => Division::all()
        ]);
    }
}