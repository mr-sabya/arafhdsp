<?php

namespace App\Livewire\Admin\Diagnostic;

use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\DiagnosticCenter;
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
    public $discount_badge_en, $discount_badge_bn;
    public $division_id, $district_id, $upazila_id, $area_id;
    public $sort_order = 0, $status = 1;
    public $test_list = []; // JSON array for tests

    // Dropdowns
    public $districts = [], $upazilas = [], $areas = [];

    public $centerId, $isEditMode = false, $isOpen = false, $search = '';

    protected function rules()
    {
        return [
            'name_en' => 'required',
            'name_bn' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'photo' => $this->isEditMode ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ];
    }

    // --- Test List Management ---
    public function addTest()
    {
        $this->test_list[] = ''; // সাধারণ স্ট্রিং হিসেবে অ্যাড হবে
    }

    public function removeTest($index)
    {
        unset($this->test_list[$index]);
        $this->test_list = array_values($this->test_list);
    }

    // --- Location Logic ---
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
            'name_en',
            'name_bn',
            'address_en',
            'address_bn',
            'phone',
            'photo',
            'existingPhoto',
            'division_id',
            'district_id',
            'upazila_id',
            'area_id',
            'centerId',
            'isEditMode',
            'test_list',
            'discount_badge_en',
            'discount_badge_bn'
        ]);
        $this->status = 1;
        $this->sort_order = 0;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name_en' => $this->name_en,
            'name_bn' => $this->name_bn,
            'address_en' => $this->address_en,
            'address_bn' => $this->address_bn,
            'phone' => $this->phone,
            'discount_badge_en' => $this->discount_badge_en,
            'discount_badge_bn' => $this->discount_badge_bn,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'area_id' => $this->area_id,
            'test_list' => array_filter($this->test_list), // খালি ভ্যালু রিমুভ করবে
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('diagnostics', 'public');
            if ($this->isEditMode && $this->existingPhoto) Storage::disk('public')->delete($this->existingPhoto);
        }

        DiagnosticCenter::updateOrCreate(['id' => $this->centerId], $data);

        $this->dispatch('notify', message: $this->isEditMode ? 'Center Updated' : 'Center Added', type: 'success');
        $this->closeModal();
    }

    public function edit($id)
    {
        $center = DiagnosticCenter::findOrFail($id);
        $this->centerId = $id;
        $this->name_en = $center->name_en;
        $this->name_bn = $center->name_bn;
        $this->address_en = $center->address_en;
        $this->address_bn = $center->address_bn;
        $this->phone = $center->phone;
        $this->discount_badge_en = $center->discount_badge_en;
        $this->discount_badge_bn = $center->discount_badge_bn;
        $this->division_id = $center->division_id;

        $this->districts = District::where('division_id', $center->division_id)->get();
        $this->district_id = $center->district_id;
        $this->upazilas = Upazila::where('district_id', $center->district_id)->get();
        $this->upazila_id = $center->upazila_id;
        $this->areas = Area::where('upazila_id', $center->upazila_id)->get();
        $this->area_id = $center->area_id;

        $this->test_list = $center->test_list ?? [];
        $this->existingPhoto = $center->photo;
        $this->sort_order = $center->sort_order;
        $this->status = $center->status;
        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        $center = DiagnosticCenter::find($id);
        if ($center->photo) Storage::disk('public')->delete($center->photo);
        $center->delete();
        $this->dispatch('notify', message: 'Center Removed', type: 'danger');
    }

    public function render()
    {
        return view('livewire.admin.diagnostic.index', [
            'centers' => DiagnosticCenter::with(['district', 'area'])
                ->where('name_en', 'like', "%{$this->search}%")
                ->orWhere('name_bn', 'like', "%{$this->search}%")
                ->orderBy('sort_order', 'asc')->paginate(12),
            'divisions' => Division::all()
        ]);
    }
}
