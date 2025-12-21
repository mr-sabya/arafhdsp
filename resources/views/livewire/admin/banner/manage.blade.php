<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
           
            <div class="card-body">

                <form wire:submit.prevent="updateBanner" enctype="multipart/form-data">

                    <div class="row">
                        <!-- Left Column: Personal Info -->
                        <div class="col-md-8">
                            <h6 class="text-secondary border-bottom pb-2 mb-3">Main Information</h6>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Greeting</label>
                                    <input type="text" class="form-control" wire:model="greeting" placeholder="Hello i'm">
                                    @error('greeting') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="Sabya Roy">
                                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control" wire:model="designation" placeholder="Professional Web Developer">
                                @error('designation') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" class="form-control" wire:model="button_text">
                                    @error('button_text') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Button URL</label>
                                    <input type="text" class="form-control" wire:model="button_url">
                                    @error('button_url') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <h6 class="text-secondary border-bottom pb-2 mb-3 mt-4">About Me Section</h6>

                            <div class="mb-3">
                                <label class="form-label">About Title</label>
                                <input type="text" class="form-control" wire:model="about_title">
                                @error('about_title') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">About Description (HTML Allowed)</label>
                                <textarea class="form-control" rows="4" wire:model="about_description"></textarea>
                                <small class="text-muted">You can use &lt;span&gt; tags for highlighting.</small>
                                @error('about_description') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <h6 class="text-secondary border-bottom pb-2 mb-3 mt-4">Background Effects</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Background Text 1 (Top)</label>
                                    <input type="text" class="form-control" wire:model="bg_text_1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Background Text 2 (Bottom)</label>
                                    <input type="text" class="form-control" wire:model="bg_text_2">
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Image Upload -->
                        <div class="col-md-4">
                            <h6 class="text-secondary border-bottom pb-2 mb-3">Banner Image</h6>

                            <div class="card bg-light border-0">
                                <div class="card-body text-center">
                                    <!-- Image Preview Logic -->
                                    @if ($new_image)
                                    <div class="mb-3">
                                        <p class="small text-success">New Image Preview:</p>
                                        <img src="{{ $new_image->temporaryUrl() }}" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                                    </div>
                                    @elseif ($current_image)
                                    <div class="mb-3">
                                        <p class="small text-muted">Current Image:</p>
                                        <img src="{{ asset('storage/'.$current_image) }}" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                                    </div>
                                    @else
                                    <div class="mb-3">
                                        <img src="{{ url('assets/frontend/images/banner/banner-user-image-three.png') }}" class="img-fluid opacity-50" style="max-height: 200px;">
                                        <p class="small text-muted mt-2">Default Placeholder Shown</p>
                                    </div>
                                    @endif

                                    <div class="mt-3">
                                        <label class="form-label fw-bold">Upload New Image</label>
                                        <input type="file" class="form-control" wire:model="new_image">
                                        <div wire:loading wire:target="new_image" class="text-primary small mt-1">
                                            <div class="spinner-border spinner-border-sm" role="status"></div> Uploading...
                                        </div>
                                        @error('new_image') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <div wire:loading wire:target="updateBanner" class="spinner-border spinner-border-sm me-1"></div>
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>