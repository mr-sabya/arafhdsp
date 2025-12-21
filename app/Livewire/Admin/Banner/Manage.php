<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithFileUploads; // Crucial for Image Uploads
use App\Models\HeroBanner;
use Illuminate\Support\Facades\Storage;

class Manage extends Component
{
    use WithFileUploads;

    // Form Properties
    public $greeting;
    public $name;
    public $designation;
    public $button_text;
    public $button_url;
    public $about_title;
    public $about_description;
    public $bg_text_1;
    public $bg_text_2;

    // Image Handling
    public $new_image;      // The new file selected by user
    public $current_image;  // The path currently saved in DB

    public function mount()
    {
        // Get the existing data or create a blank instance
        $banner = HeroBanner::firstOrNew();

        $this->greeting          = $banner->greeting;
        $this->name              = $banner->name;
        $this->designation       = $banner->designation;
        $this->button_text       = $banner->button_text;
        $this->button_url        = $banner->button_url;
        $this->about_title       = $banner->about_title;
        $this->about_description = $banner->about_description;
        $this->bg_text_1         = $banner->bg_text_1;
        $this->bg_text_2         = $banner->bg_text_2;
        $this->current_image     = $banner->hero_image;
    }

    public function updateBanner()
    {
        $this->validate([
            'greeting'          => 'nullable|string|max:255',
            'name'              => 'required|string|max:255',
            'designation'       => 'required|string|max:255',
            'button_text'       => 'required|string|max:255',
            'button_url'        => 'nullable|string|max:255',
            'about_title'       => 'required|string|max:255',
            'about_description' => 'required|string',
            'bg_text_1'         => 'nullable|string|max:255',
            'bg_text_2'         => 'nullable|string|max:255',
            'new_image'         => 'nullable|image|max:2048', // 2MB Max
        ]);

        $banner = HeroBanner::first();

        // If table is empty, create the first record
        if (!$banner) {
            $banner = new HeroBanner();
        }

        // Image Upload Logic
        if ($this->new_image) {
            // 1. Delete old image if exists
            if ($banner->hero_image && Storage::disk('public')->exists($banner->hero_image)) {
                Storage::disk('public')->delete($banner->hero_image);
            }

            // 2. Store new image
            $imagePath = $this->new_image->store('hero-images', 'public');
            $banner->hero_image = $imagePath;
        }

        // Update Text Fields
        $banner->greeting = $this->greeting;
        $banner->name = $this->name;
        $banner->designation = $this->designation;
        $banner->button_text = $this->button_text;
        $banner->button_url = $this->button_url;
        $banner->about_title = $this->about_title;
        $banner->about_description = $this->about_description;
        $banner->bg_text_1 = $this->bg_text_1;
        $banner->bg_text_2 = $this->bg_text_2;

        $banner->save();

        // Refresh current image preview
        $this->current_image = $banner->hero_image;
        $this->new_image = null; // Reset input

        // Passing an array inside an array to match your JS: event.detail[0]
        $this->dispatch('show-toast', [
            'message' => 'Banner updated successfully!',
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.banner.manage');
    }
}
