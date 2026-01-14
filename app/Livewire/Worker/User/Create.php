<?php

namespace App\Livewire\Worker\User;

use App\Models\Area;
use App\Models\BloodGroup;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Role;
use App\Models\PricingPlan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    use WithFileUploads;

    // Form Fields
    public $name, $father_name, $mobile, $dob, $blood_group_id, $nid;
    public $division_id, $district_id, $upazila_id, $area_id;
    public $pricing_plan_id, $family_members = 1;
    public $nominee_name, $nominee_relation, $password, $photo;
    public $terms = false;

    // Calculation Properties
    public $total_price = 0, $base_unit_price = 0, $discount_amount = 0, $selected_plan = null;

    // Collections
    public $divisions = [], $districts = [], $upazilas = [], $areas = [], $bloodGroups = [], $pricingPlans = [];

    public function mount()
    {
        $this->divisions = Division::all();
        $this->bloodGroups = BloodGroup::all();
        $this->pricingPlans = PricingPlan::where('status', 1)->orderBy('sort_order', 'asc')->get();
    }

    public function updatedPricingPlanId()
    {
        $this->calculateTotal();
    }
    public function updatedFamilyMembers()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->selected_plan = PricingPlan::find($this->pricing_plan_id);
        if (!$this->selected_plan) {
            $this->total_price = 0;
            return;
        }

        $this->base_unit_price = $this->selected_plan->price;
        $members = max(1, (int)$this->family_members);

        $running_total = $this->base_unit_price * ($this->selected_plan->pricing_type === 'per_member' ? $members : 1);

        if ($this->selected_plan->pricing_type === 'per_member' && is_array($this->selected_plan->pricing_rules)) {
            foreach ($this->selected_plan->pricing_rules as $rule) {
                if ((int)$rule['member_count'] === $members) {
                    $running_total = (float)$rule['price'];
                    break;
                }
            }
        }

        $this->discount_amount = ($running_total * ($this->selected_plan->discount_percentage ?? 0)) / 100;
        $this->total_price = $running_total - $this->discount_amount;
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

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:11|unique:users,mobile',
            'blood_group_id' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'pricing_plan_id' => 'required',
            'nid' => 'nullable|numeric|digits_between:10,17',
            'password' => 'required|min:6',
            'terms' => 'accepted',
            'photo' => 'nullable|image|max:1024',
        ]);

        $memberRole = Role::where('slug', 'member')->first();

        // OTP Generation
        $otp = rand(1000, 9999);

        $user = User::create([
            'name' => $this->name,
            'father_name' => $this->father_name,
            'mobile' => $this->mobile,
            'dob' => $this->dob,
            'blood_group_id' => $this->blood_group_id,
            'nid' => $this->nid,
            'role_id' => $memberRole->id,
            'referred_by' => Auth::id(),
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'area_id' => $this->area_id,
            'pricing_plan_id' => $this->pricing_plan_id,
            'package_level' => $this->selected_plan->name,
            'family_members' => $this->family_members,
            'total_price' => $this->total_price,
            'nominee_name' => $this->nominee_name,
            'nominee_relation' => $this->nominee_relation,
            'photo' => $this->photo ? $this->photo->store('users', 'public') : null,
            'password' => Hash::make($this->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(15),
            'is_verified' => false,
            'application_status' => 'pending',
            'payment_status' => 'pending',
        ]);

        session()->flash('success', 'সদস্যের তথ্য সংরক্ষিত হয়েছে। ওটিপি যাচাই করুন।');
        return $this->redirect(route('worker.user.verify', ['user_id' => $user->id]), navigate: true);
    }

    public function render()
    {
        return view('livewire.worker.user.create');
    }
}
