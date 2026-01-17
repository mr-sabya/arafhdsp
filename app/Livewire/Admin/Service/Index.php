<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use App\Models\PricingPlan;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // Service Properties
    public $serviceId, $name, $slug, $type = 'limit', $status = 1;

    // Pivot Mapping Properties
    // Structure: [plan_id => ['enabled' => bool, 'quantity' => int, 'frequency' => string, 'discount_value' => float]]
    public $planMappings = [];

    public $isEditMode = false;
    public $isOpen = false;
    public $search = '';

    // Add these properties
    public $isViewOpen = false;
    public $viewingService = null;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:services,slug,' . $this->serviceId,
            'type' => 'required|in:limit,discount',
            'status' => 'required|boolean',
            'planMappings.*.enabled' => 'boolean',
            'planMappings.*.quantity' => 'nullable|required_if:type,limit|integer|min:0',
            'planMappings.*.frequency' => 'nullable|required_if:type,limit|string',
            'planMappings.*.discount_value' => 'nullable|required_if:type,discount|numeric|min:0|max:100',
        ];
    }

    public function updatedName($value)
    {
        if (!$this->isEditMode) {
            $this->slug = Str::slug($value);
        }
    }

    public function openModal()
    {
        $this->resetFields();
        $this->preparePlanMappings();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetFields();
    }

    public function preparePlanMappings($existingMappings = [])
    {
        $plans = PricingPlan::all();
        $this->planMappings = [];

        foreach ($plans as $plan) {
            $existing = collect($existingMappings)->firstWhere('id', $plan->id);

            $this->planMappings[$plan->id] = [
                'enabled' => $existing ? true : false,
                'quantity' => $existing->pivot->quantity ?? 0,
                'frequency' => $existing->pivot->frequency ?? 'monthly',
                'discount_value' => $existing->pivot->discount_value ?? 0,
                'plan_name' => $plan->name
            ];
        }
    }

    public function resetFields()
    {
        $this->reset(['serviceId', 'name', 'slug', 'type', 'status', 'isEditMode', 'planMappings']);
        $this->status = 1;
        $this->type = 'limit';
    }

    public function save()
    {
        $this->validate();

        $service = Service::updateOrCreate(
            ['id' => $this->serviceId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'type' => $this->type,
                'status' => $this->status,
            ]
        );

        // Sync with Pricing Plans
        $syncData = [];
        foreach ($this->planMappings as $planId => $data) {
            if ($data['enabled']) {
                $syncData[$planId] = [
                    'quantity' => $this->type === 'limit' ? $data['quantity'] : 0,
                    'frequency' => $this->type === 'limit' ? $data['frequency'] : 'monthly',
                    'discount_value' => $this->type === 'discount' ? $data['discount_value'] : 0,
                ];
            }
        }

        $service->plans()->sync($syncData);

        $this->dispatch(
            'notify',
            message: $this->isEditMode ? 'Service updated!' : 'Service created!',
            type: 'success'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $service = Service::with('plans')->findOrFail($id);
        $this->serviceId = $id;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->type = $service->type;
        $this->status = $service->status;

        $this->preparePlanMappings($service->plans);

        $this->isEditMode = true;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        Service::find($id)->delete();
        $this->dispatch('notify', message: 'Service deleted!', type: 'danger');
    }

    // Add this method
    public function view($id)
    {
        $this->viewingService = Service::with('plans')->findOrFail($id);
        $this->isViewOpen = true;
    }

    // Add this method to close the view modal
    public function closeViewModal()
    {
        $this->isViewOpen = false;
        $this->viewingService = null;
    }

    public function render()
    {
        $services = Service::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.service.index', [
            'services' => $services
        ]);
    }
}
