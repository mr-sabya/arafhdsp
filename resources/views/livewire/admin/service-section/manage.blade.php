<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">

                <div class="card-body">
                    <form wire:submit.prevent="updateSection" enctype="multipart/form-data">

                        <div class="row">
                            <!-- Left Column: Text Content -->
                            <div class="col-md-7 border-end">
                                <h6 class="text-secondary border-bottom pb-2 mb-3">Header Content</h6>

                                <div class="mb-3">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" class="form-control" wire:model="sub_title" placeholder="e.g. Latest Service">
                                    @error('sub_title') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Main Title</label>
                                    <input type="text" class="form-control" wire:model="title" placeholder="e.g. Inspiring The World One Project">
                                    @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="5" wire:model="description" placeholder="Enter section description..."></textarea>
                                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Right Column: Featured Image -->
                            <div class="col-md-5">
                                <h6 class="text-secondary border-bottom pb-2 mb-3">Featured Image (Home Page)</h6>

                                <div class="card bg-light border-0">
                                    <div class="card-body text-center">
                                        <!-- Image Preview Logic -->
                                        @if ($new_image)
                                        <div class="mb-3">
                                            <p class="small text-success fw-bold">New Image Preview:</p>
                                            <img src="{{ $new_image->temporaryUrl() }}" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                                        </div>
                                        @elseif ($current_image)
                                        <div class="mb-3">
                                            <p class="small text-muted">Current Image:</p>
                                            <img src="{{ asset('storage/'.$current_image) }}" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                                        </div>
                                        @else
                                        <div class="mb-3">
                                            <img src="{{ url('assets/frontend/images/services/latest-services-user-image-two.png') }}" class="img-fluid opacity-50" style="max-height: 200px;">
                                            <p class="small text-muted mt-2">Default Placeholder</p>
                                        </div>
                                        @endif

                                        <div class="mt-3">
                                            <label class="form-label fw-bold">Change Image</label>
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
                                <div wire:loading wire:target="updateSection" class="spinner-border spinner-border-sm me-1"></div>
                                Save Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>