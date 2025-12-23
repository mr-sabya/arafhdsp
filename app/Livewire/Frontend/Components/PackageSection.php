<?php

namespace App\Livewire\Frontend\Components;

use App\Models\PricingPlan;
use Livewire\Component;

class PackageSection extends Component
{
    public function render()
    {
        // Fetch only active plans, ordered by sort_order
        $plans = PricingPlan::where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('livewire.frontend.components.package-section', [
            'plans' => $plans
        ]);
    }
}
