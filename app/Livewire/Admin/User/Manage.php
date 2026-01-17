<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\Role;
use App\Models\BloodGroup;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Area;
use App\Models\DiagnosticCenter;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Manage extends Component
{
    use WithFileUploads;

    // State
    public $userId;
    public $isEditMode = false;

    // Model Fields
    public $name, $email, $role_id, $password, $father_name, $mobile, $dob, $blood_group_id, $nid;
    public $photo, $existingPhoto;
    public $hospital_id, $diagnostic_center_id;

    // Referral Fields
    public $referred_by; // ID of the worker who referred this user
    public $referral_code; // This user's own code (if they are a worker)

    // Address Fields
    public $division_id, $district_id, $upazila_id, $area_id;
    public $hospitals = [], $diagnostics = [];


    // Dropdown Collections
    public $districts = [], $upazilas = [], $areas = [];

    public function mount($userId = null)
    {
        // Initialize collections
        $this->hospitals = Hospital::all();
        $this->diagnostics = DiagnosticCenter::all();

        if ($userId) {
            $this->userId = $userId;
            $this->isEditMode = true;
            $this->loadUser();
        } else {
            $user = Auth::user();
            // The instanceof check tells the IDE that $user is your User model
            if ($user instanceof \App\Models\User && $user->isWorker()) {
                $this->referred_by = $user->id;
            }
        }
    }

    public function loadUser()
    {
        $user = User::findOrFail($this->userId);

        // নিরাপত্তা: অ্যাডমিন যদি কোনো মেম্বারকে এডিট করার চেষ্টা করে (যা এই ফর্মে অনুমোদিত নয়)
        if ($user->role && $user->role->slug === 'member') {
            session()->flash('error', 'সদস্যদের প্রোফাইল এখান থেকে এডিট করা সম্ভব নয়।');
            return $this->redirect(route('admin.user.index'), navigate: true);
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
        $this->father_name = $user->father_name;
        $this->mobile = $user->mobile;
        $this->dob = $user->dob ? $user->dob->format('Y-m-d') : null;
        $this->blood_group_id = $user->blood_group_id;
        $this->nid = $user->nid;
        $this->existingPhoto = $user->photo;

        // Referral mapping
        $this->referred_by = $user->referred_by;
        $this->referral_code = $user->referral_code;

        // Address mapping
        $this->division_id = $user->division_id;
        $this->district_id = $user->district_id;
        $this->upazila_id = $user->upazila_id;
        $this->area_id = $user->area_id;

        $this->hospital_id = $user->hospital_id;
        $this->diagnostic_center_id = $user->diagnostic_center_id;

        if ($this->division_id) $this->districts = District::where('division_id', $this->division_id)->get();
        if ($this->district_id) $this->upazilas = Upazila::where('district_id', $this->district_id)->get();
        if ($this->upazila_id) $this->areas = Area::where('upazila_id', $this->upazila_id)->get();
    }

    // ... (Updated Address Chain Logic remains same as your original)
    /**
     * Address Chain Logic
     * Triggered automatically by wire:model.live
     */

    public function updatedDivisionId($value)
    {
        // Load districts based on selected division
        $this->districts = $value ? District::where('division_id', $value)->get() : [];

        // Reset all dependent fields and their collections
        $this->reset(['district_id', 'upazila_id', 'area_id', 'upazilas', 'areas']);
    }

    public function updatedDistrictId($value)
    {
        // Load upazilas based on selected district
        $this->upazilas = $value ? Upazila::where('district_id', $value)->get() : [];

        // Reset all dependent fields and their collections
        $this->reset(['upazila_id', 'area_id', 'areas']);
    }

    public function updatedUpazilaId($value)
    {
        // Load areas based on selected upazila
        $this->areas = $value ? Area::where('upazila_id', $value)->get() : [];

        // Reset area selection
        $this->reset(['area_id']);
    }

    // This method runs automatically when role_id changes via wire:model.live
    public function updatedRoleId($value)
    {
        $role = Role::find($value);

        // Reset IDs if the role changes to something else
        if (!$role || $role->slug !== 'hospital') $this->hospital_id = null;
        if (!$role || $role->slug !== 'diagnostic') $this->diagnostic_center_id = null;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:users,mobile,' . $this->userId,
            'email' => 'nullable|email|unique:users,email,' . $this->userId,
            'role_id' => 'required',
            'referred_by' => 'nullable|exists:users,id',
            'photo' => 'nullable|image|max:1024',
        ];

        if (!$this->isEditMode) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        // 1. Fetch the Role to check the slug
        $selectedRole = Role::find($this->role_id);

        // Conditional validation
        if ($selectedRole?->slug === 'hospital') {
            $rules['hospital_id'] = 'required|exists:hospitals,id';
        }
        if ($selectedRole?->slug === 'diagnostic') {
            $rules['diagnostic_center_id'] = 'required|exists:diagnostic_centers,id';
        }

        // 2. Logic for is_verified (Member = false, Others = true)
        // If you only want this to happen during CREATION, wrap it in if(!$this->isEditMode)
        // গুরুত্বপূর্ণ: অ্যাডমিন যাতে ভুল করেও 'member' রোল দিয়ে ইউজার সেভ করতে না পারে
        if ($selectedRole->slug === 'member') {
            $this->addError('role_id', 'অ্যাডমিন প্যানেল থেকে সাধারণ সদস্য তৈরি করা সম্ভব নয়।');
            return;
        }
        $isVerified = ($selectedRole && $selectedRole->slug !== 'member');

        // 3. Logic for Referral Code (Only for Workers)
        $finalReferralCode = $this->referral_code;
        if ($selectedRole && $selectedRole->slug === 'worker' && empty($this->referral_code)) {
            $finalReferralCode = User::generateReferralCode($this->name);
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'father_name' => $this->father_name,
            'mobile' => $this->mobile,
            'dob' => $this->dob,
            'blood_group_id' => $this->blood_group_id,
            'nid' => $this->nid,
            'is_verified' => $isVerified,
            'referred_by' => $this->referred_by, // Link to the worker who referred them
            'referral_code' => $finalReferralCode, // This user's own referral code
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'area_id' => $this->area_id,
            'hospital_id' => ($selectedRole?->slug === 'hospital') ? $this->hospital_id : null,
            'diagnostic_center_id' => ($selectedRole?->slug === 'diagnostic') ? $this->diagnostic_center_id : null,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->photo) {
            if ($this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
            $data['photo'] = $this->photo->store('users', 'public');
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        $this->dispatch(
            'notify',
            message: $this->isEditMode ? 'User updated successfully!' : 'User created successfully!',
            type: 'success'
        );

        return $this->redirect(route('admin.user.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.user.manage', [
            'roles' => Role::where('slug', '!=', 'member')->get(),
            'bloodGroups' => BloodGroup::all(),
            'divisions' => Division::all(),
            // Get all existing Field Workers to populate a "Referrer" dropdown
            'workers' => User::whereHas('role', fn($q) => $q->where('slug', 'worker'))->get(),
        ]);
    }
}
