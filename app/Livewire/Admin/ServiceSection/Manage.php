<?php

namespace App\Livewire\Admin\ServiceSection;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ServiceSection;
use Illuminate\Support\Facades\Storage;

class Manage extends Component
{
    use WithFileUploads;

    public $sub_title;
    public $title;
    public $description;
    
    // Image Handling
    public $new_image;
    public $current_image;

    public function mount()
    {
        // Get existing data or create blank
        $section = ServiceSection::firstOrNew();

        $this->sub_title     = $section->sub_title;
        $this->title         = $section->title;
        $this->description   = $section->description;
        $this->current_image = $section->featured_image;
    }

    public function updateSection()
    {
        $this->validate([
            'sub_title'   => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'new_image'   => 'nullable|image|max:2048', // 2MB Max
        ]);

        $section = ServiceSection::first();

        if (!$section) {
            $section = new ServiceSection();
        }

        // Image Upload Logic
        if ($this->new_image) {
            // Delete old image if exists
            if ($section->featured_image && Storage::disk('public')->exists($section->featured_image)) {
                Storage::disk('public')->delete($section->featured_image);
            }

            // Store new image
            $imagePath = $this->new_image->store('service-sections', 'public');
            $section->featured_image = $imagePath;
        }

        // Update Text Fields
        $section->sub_title   = $this->sub_title;
        $section->title       = $this->title;
        $section->description = $this->description;

        $section->save();

        // Refresh state
        $this->current_image = $section->featured_image;
        $this->new_image = null;

        // Dispatch Toast Notification
        $this->dispatch('show-toast', [
            'message' => 'Service Section updated successfully!',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.service-section.manage');
    }
}