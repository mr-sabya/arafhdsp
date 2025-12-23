<?php

namespace App\Livewire\Frontend\Auth;

use App\Models\Area;
use App\Models\BloodGroup;
use App\Models\District;
use App\Models\Division;
use App\Models\Upazila;
use App\Models\User;
use App\Models\PricingPlan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    use WithFileUploads;

    // Form Fields
    public $name, $father_name, $mobile, $dob, $blood_group_id, $nid;
    public $division_id, $district_id, $upazila_id, $area_id;
    public $pricing_plan_id, $family_members = 1;
    public $nominee_name, $nominee_relation, $password, $photo;
    public $terms = false;

    // Calculation Properties
    public $total_price = 0;
    public $base_unit_price = 0;
    public $discount_amount = 0;
    public $selected_plan = null;

    // Data Collections
    public $divisions = [], $districts = [], $upazilas = [], $areas = [], $bloodGroups = [], $pricingPlans = [];

    public function mount()
    {
        $this->divisions = Division::all();
        $this->bloodGroups = BloodGroup::all();
        $this->pricingPlans = PricingPlan::where('status', 1)->orderBy('sort_order', 'asc')->get();

        // Auto-select plan if passed via URL
        if (request()->has('plan')) {
            $this->pricing_plan_id = request()->get('plan');
            $this->calculateTotal();
        }
    }

    /**
     * Logic Listeners
     */
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
            $this->resetCalculation();
            return;
        }

        $this->base_unit_price = $this->selected_plan->price;
        $running_total = 0;

        // 1. Pricing Type Logic (Fixed vs Per Member)
        if ($this->selected_plan->pricing_type === 'per_member') {
            $members = max(1, (int)$this->family_members);

            // Tiered logic (e.g., "fixed_price_for_5" => 400)
            $rule_key = "fixed_price_for_" . $members;
            if (isset($this->selected_plan->pricing_rules[$rule_key])) {
                $running_total = $this->selected_plan->pricing_rules[$rule_key];
            } else {
                $running_total = $this->base_unit_price * $members;
            }
        } else {
            $running_total = $this->base_unit_price;
        }

        // 2. Discount Logic
        if ($this->selected_plan->discount_percentage > 0) {
            $this->discount_amount = ($running_total * $this->selected_plan->discount_percentage) / 100;
            $this->total_price = $running_total - $this->discount_amount;
        } else {
            $this->discount_amount = 0;
            $this->total_price = $running_total;
        }
    }

    private function resetCalculation()
    {
        $this->total_price = 0;
        $this->base_unit_price = 0;
        $this->discount_amount = 0;
        $this->selected_plan = null;
    }

    /**
     * Address Cascading Logic
     */
    public function updatedDivisionId($value)
    {
        $this->districts = District::where('division_id', $value)->get();
        $this->district_id = $this->upazila_id = $this->area_id = null;
    }

    public function updatedDistrictId($value)
    {
        $this->upazilas = Upazila::where('district_id', $value)->get();
        $this->upazila_id = $this->area_id = null;
    }

    public function updatedUpazilaId($value)
    {
        $this->areas = Area::where('upazila_id', $value)->get();
        $this->area_id = null;
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
            'password' => 'required|min:6',
            'terms' => 'accepted',
            'photo' => 'nullable|image|max:1024',
        ]);

        $photoPath = $this->photo ? $this->photo->store('profile-photos', 'public') : null;
        $otp = rand(1111, 9999);

        $user = User::create([
            'name' => $this->name,
            'father_name' => $this->father_name,
            'mobile' => $this->mobile,
            'dob' => $this->dob,
            'blood_group_id' => $this->blood_group_id,
            'nid' => $this->nid,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'area_id' => $this->area_id,
            'pricing_plan_id' => $this->pricing_plan_id,
            'package_level' => $this->selected_plan->name, // Saves current plan name
            'family_members' => $this->family_members,
            'total_price' => $this->total_price,
            'nominee_name' => $this->nominee_name,
            'nominee_relation' => $this->nominee_relation,
            'photo' => $photoPath,
            'password' => Hash::make($this->password),
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
            'is_verified' => false,
            'application_status' => 'pending', // Requires admin approval
            'payment_status' => 'pending',
        ]);

        session()->flash('temp_otp', $otp);
        return redirect()->route('verify.otp', ['mobile' => $user->mobile]);
    }

    public function render()
    {
        return view('livewire.frontend.auth.register');
    }
}
