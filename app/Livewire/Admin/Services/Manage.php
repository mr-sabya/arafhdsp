<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;

class Manage extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // DataTable Properties
    public $search = '';
    public $perPage = 10;
    public $sortField = 'sort_order';
    public $sortDirection = 'asc';

    // Model Properties
    public $service_id;
    public $title;
    public $icon_class;
    public $short_description;
    public $description;
    public $details_url;
    public $sort_order = 0;
    public $status = true;

    // UI State
    public $isEditMode = false;

    // Reset pagination when searching
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Sorting Logic
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    // Prepare for Create
    public function create()
    {
        $this->resetInputFields();
        $this->isEditMode = false;
    }

    // Prepare for Edit
    public function edit($id)
    {
        $this->resetInputFields();
        $this->isEditMode = true;

        $service = Service::findOrFail($id);
        
        $this->service_id        = $service->id;
        $this->title             = $service->title;
        $this->icon_class        = $service->icon_class;
        $this->short_description = $service->short_description;
        $this->description       = $service->description;
        $this->details_url       = $service->details_url;
        $this->sort_order        = $service->sort_order;
        $this->status            = $service->status;
    }

    // Save or Update
    public function store()
    {
        // 1. Validate
        $this->validate([
            'title'             => 'required|string|max:255',
            'icon_class'        => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'sort_order'        => 'integer',
        ]);

        // 2. Update or Create
        Service::updateOrCreate(['id' => $this->service_id], [
            'title'             => $this->title,
            'icon_class'        => $this->icon_class,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'details_url'       => $this->details_url,
            'sort_order'        => $this->sort_order,
            'status'            => $this->status ? 1 : 0,
        ]);

        // 3. Notification
        $this->dispatch('show-toast', [
            'message' => $this->service_id ? 'Service Updated Successfully' : 'Service Created Successfully',
            'type' => 'success'
        ]);

        // 4. Reset Form (This clears the modal inputs)
        $this->resetInputFields();
    }

    // Delete
    public function delete($id)
    {
        Service::find($id)->delete();
        $this->dispatch('show-toast', ['message' => 'Service Deleted Successfully', 'type' => 'error']);
    }

    // Helper to Reset Vars
    private function resetInputFields()
    {
        $this->service_id = null;
        $this->title = '';
        $this->icon_class = '';
        $this->short_description = '';
        $this->description = '';
        $this->details_url = '';
        $this->sort_order = 0;
        $this->status = true;
        $this->isEditMode = false;
    }

    public function render()
    {
        $services = Service::where('title', 'like', '%'.$this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.services.manage', ['services' => $services]);
    }
}