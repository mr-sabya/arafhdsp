<?php

namespace App\Livewire\Frontend\Hospital;

use App\Models\Hospital;
use Livewire\Component;
use Livewire\WithPagination;

class Hospitals extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    // Reset pagination when searching
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $hospitals = Hospital::with(['division', 'district', 'upazila', 'area'])->where('status', 1)
            ->where(function ($query) {
                $query->where('name_en', 'like', '%' . $this->search . '%')
                    ->orWhere('name_bn', 'like', '%' . $this->search . '%')
                    ->orWhere('address_en', 'like', '%' . $this->search . '%')
                    ->orWhere('address_bn', 'like', '%' . $this->search . '%');
            })
            ->orderBy('sort_order', 'asc')
            ->paginate(10);

        return view('livewire.frontend.hospital.hospitals', [
            'hospitals' => $hospitals
        ]);
    }
}
