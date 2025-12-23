<?php

namespace App\Livewire\Admin\PricingPlan;

use App\Models\PricingPlan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Form Properties
    public $name, $level_text, $price, $ribbon_text, $sort_order = 0, $is_featured = false, $status = 1;
    public $billing_interval = 'monthly'; // Added: monthly, yearly, lifetime, one_time
    public $pricing_type = 'fixed';
    public $discount_percentage = 0;
    public $fixed_price_for_5;
    public $features = [['text' => '', 'available' => true]];

    public $planId;
    public $isEditMode = false;
    public $isOpen = false;

    // Table State
    public $search = '';
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';

    protected $rules = [
        'name' => 'required|string|max:255',
        'level_text' => 'required|string|max:255',
        'price' => 'required|numeric',
        'billing_interval' => 'required|in:monthly,yearly,lifetime,one_time',
        'pricing_type' => 'required|in:fixed,per_member',
        'discount_percentage' => 'nullable|numeric|min:0|max:100',
        'fixed_price_for_5' => 'nullable|numeric',
        'features' => 'required|array|min:1',
        'features.*.text' => 'required|string',
        'features.*.available' => 'boolean',
        'sort_order' => 'required|integer',
        'status' => 'required',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function addFeature()
    {
        $this->features[] = ['text' => '', 'available' => true];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function resetFields()
    {
        $this->reset([
            'name',
            'level_text',
            'price',
            'billing_interval',
            'ribbon_text',
            'sort_order',
            'is_featured',
            'status',
            'planId',
            'isEditMode',
            'pricing_type',
            'discount_percentage',
            'fixed_price_for_5'
        ]);
        $this->status = 1;
        $this->billing_interval = 'monthly';
        $this->pricing_type = 'fixed';
        $this->features = [['text' => '', 'available' => true]];
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        // Prepare JSON rules
        $rules = null;
        if ($this->pricing_type === 'per_member' && $this->fixed_price_for_5) {
            $rules = ['fixed_price_for_5' => (float)$this->fixed_price_for_5];
        }

        $data = [
            'name' => $this->name,
            'level_text' => $this->level_text,
            'price' => $this->price,
            'billing_interval' => $this->billing_interval,
            'pricing_type' => $this->pricing_type,
            'discount_percentage' => $this->discount_percentage ?? 0,
            'pricing_rules' => $rules,
            'features' => $this->features,
            'is_featured' => $this->is_featured,
            'ribbon_text' => $this->ribbon_text,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
        ];

        if ($this->isEditMode) {
            PricingPlan::find($this->planId)->update($data);
            $this->dispatch('notify', message: 'Package updated successfully!', type: 'success');
        } else {
            PricingPlan::create($data);
            $this->dispatch('notify', message: 'Package created successfully!', type: 'success');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $plan = PricingPlan::findOrFail($id);
        $this->planId = $id;
        $this->name = $plan->name;
        $this->level_text = $plan->level_text;
        $this->price = $plan->price;
        $this->billing_interval = $plan->billing_interval;
        $this->pricing_type = $plan->pricing_type;
        $this->discount_percentage = $plan->discount_percentage;

        $this->fixed_price_for_5 = $plan->pricing_rules['fixed_price_for_5'] ?? null;

        $this->features = $plan->features;
        $this->is_featured = $plan->is_featured;
        $this->ribbon_text = $plan->ribbon_text;
        $this->sort_order = $plan->sort_order;
        $this->status = $plan->status ? 1 : 0;

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
        PricingPlan::find($id)->delete();
        $this->dispatch('notify', message: 'Package deleted successfully!', type: 'danger');
    }

    public function render()
    {
        $plans = PricingPlan::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('level_text', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.pricing-plan.index', ['plans' => $plans]);
    }
}
