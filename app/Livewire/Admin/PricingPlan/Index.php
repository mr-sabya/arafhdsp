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
        'features' => 'required|array|min:1',
        'features.*.text' => 'required|string',
        'features.*.available' => 'boolean',
        'sort_order' => 'required|integer',
        'status' => 'required|boolean',
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

    public function sortBy($field)
    {
        $this->sortDirection = ($this->sortField === $field && $this->sortDirection === 'asc') ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function resetFields()
    {
        $this->reset(['name', 'level_text', 'price', 'ribbon_text', 'sort_order', 'is_featured', 'status', 'planId', 'isEditMode']);
        $this->features = [['text' => '', 'available' => true]];
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'level_text' => $this->level_text,
            'price' => $this->price,
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
        $this->features = $plan->features;
        $this->is_featured = $plan->is_featured;
        $this->ribbon_text = $plan->ribbon_text;
        $this->sort_order = $plan->sort_order;
        $this->status = $plan->status;
        $this->isEditMode = true;
        $this->isOpen = true;
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
