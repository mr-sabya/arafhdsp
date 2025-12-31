<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\Role;
use App\Models\BloodGroup;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Area;
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

    // Referral Fields
    public $referred_by; // ID of the worker who referred this user
    public $referral_code; // This user's own code (if they are a worker)

    // Address Fields
    public $division_id, $district_id, $upazila_id, $area_id;

    // Dropdown Collections
    public $districts = [], $upazilas = [], $areas = [];

    public function mount($userId = null)
    {
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

        if ($this->division_id) $this->districts = District::where('division_id', $this->division_id)->get();
        if ($this->district_id) $this->upazilas = Upazila::where('district_id', $this->district_id)->get();
        if ($this->upazila_id) $this->areas = Area::where('upazila_id', $this->upazila_id)->get();
    }

    // ... (Updated Address Chain Logic remains same as your original)

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

        // Logic: Generate referral code if the user is a worker and doesn't have one
        $selectedRole = Role::find($this->role_id);
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
            'referred_by' => $this->referred_by, // Link to the worker who referred them
            'referral_code' => $finalReferralCode, // This user's own referral code
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'area_id' => $this->area_id,
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
            'roles' => Role::all(),
            'bloodGroups' => BloodGroup::all(),
            'divisions' => Division::all(),
            // Get all existing Field Workers to populate a "Referrer" dropdown
            'workers' => User::whereHas('role', fn($q) => $q->where('slug', 'worker'))->get(),
        ]);
    }
}
