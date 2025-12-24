<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Doctor Management</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search doctors...">
                        </div>
                        <button wire:click="openModal" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add New Doctor
                        </button>
                    </div>
                </div>

                <!-- Card Grid Section -->
                <div class="row g-4 p-4">
                    @forelse($doctors as $doctor)
                    <div class="col-xl-3 col-lg-4 col-md-6" wire:key="doc-{{ $doctor->id }}">
                        <div class="card h-100 border doctor-admin-card transition-all">
                            <!-- Status Badge Overlay -->
                            <div class="position-absolute top-0 end-0 p-3" style="z-index: 5;">
                                <span class="badge {{ $doctor->status ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                    {{ $doctor->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="card-body p-4 text-center">
                                <!-- Doctor Photo -->
                                <div class="mb-3">
                                    <img src="{{ asset('storage/'.$doctor->photo) }}"
                                        class="rounded-circle border border-4 border-white shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>

                                <!-- Info -->
                                <h6 class="fw-bold mb-1 text-dark">{{ $doctor->name_bn }}</h6>
                                <p class="text-primary small fw-bold mb-2">{{ $doctor->department->name_bn }}</p>
                                <div class="text-muted x-small mb-3" style="height: 35px; overflow: hidden;">
                                    {{ $doctor->degree_bn }}
                                </div>

                                <!-- Fee Summary -->
                                <div class="bg-light rounded-3 p-2 mb-4 d-flex justify-content-between align-items-center px-3">
                                    <div class="text-start">
                                        <small class="text-muted d-block" style="font-size: 10px;">CONSULTATION FEE</small>
                                        <span class="fw-bold text-dark">৳{{ number_format($doctor->base_fee) }}</span>
                                    </div>
                                    @if($doctor->discount_percentage > 0)
                                    <div class="text-end">
                                        <span class="badge bg-danger-subtle text-danger rounded-pill">-{{ $doctor->discount_percentage }}%</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Quick Actions -->
                                <div class="d-flex justify-content-center gap-2 border-top pt-3">
                                    <button wire:click="edit({{ $doctor->id }})" class="btn btn-sm btn-outline-info rounded-pill px-3 shadow-none">
                                        <i class="ri-edit-line me-1"></i> Edit
                                    </button>
                                    <button onclick="confirm('Delete this doctor?') || event.stopImmediatePropagation()"
                                        wire:click="delete({{ $doctor->id }})"
                                        class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-none">
                                        <i class="ri-delete-bin-line me-1"></i> Delete
                                    </button>
                                </div>
                            </div>

                            <!-- Footer Info -->
                            <div class="card-footer bg-transparent border-0 pt-0 pb-3 text-center">
                                <small class="text-muted x-small">Sort Order: #{{ $doctor->sort_order }}</small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <div class="card border-0 shadow-sm py-5">
                            <i class="ri-user-search-line display-1 text-light mb-3"></i>
                            <h5 class="text-muted">No doctors found matching your criteria.</h5>
                        </div>
                    </div>
                    @endforelse
                </div>

                <div class="card-footer bg-white border-0">{{ $doctors->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Modal (Pricing Plan Style) -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title fw-bold text-primary">{{ $isEditMode ? 'Edit Doctor Info' : 'Add New Doctor' }}</h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <form wire:submit.prevent="save">
                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <!-- Basic Information -->
                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold">Name (English)</label>
                                        <input type="text" class="form-control" wire:model="name_en" placeholder="Dr. Rafiqul Islam">
                                        @error('name_en') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label small fw-bold">Name (Bangla)</label>
                                        <input type="text" class="form-control" wire:model="name_bn" placeholder="ডাঃ রফিকুল ইসলাম">
                                        @error('name_bn') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Department</label>
                                        <select class="form-select" wire:model="department_id">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->name_bn }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id') <span class="text-danger x-small">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Appointment Number</label>
                                        <input type="text" class="form-control" wire:model="appointment_number" placeholder="01711XXXXXX">
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Photo</label>
                                <div class="image-preview" style="height: 175px;">
                                    @if($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="">
                                    @elseif($existingPhoto)
                                    <img src="{{ asset('storage/'.$existingPhoto) }}" alt="">
                                    @else
                                    <!-- Show an icon if no image exists -->
                                    <div class="text-center text-muted">
                                        <i class="ri-image-add-line fs-1 d-block"></i>
                                        <span class="small">No Photo Selected</span>
                                    </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" wire:model="photo">

                                @error('photo') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>


                        </div>
                        <div class="row g-3">

                            <!-- Designations & Degrees -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Designation (English)</label>
                                <input type="text" class="form-control" wire:model="designation_en" placeholder="Medicine Specialist">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Designation (Bangla)</label>
                                <input type="text" class="form-control" wire:model="designation_bn" placeholder="মেডিসিন বিশেষজ্ঞ">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Degrees (English)</label>
                                <input type="text" class="form-control" wire:model="degree_en" placeholder="MBBS, FCPS">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Degrees (Bangla)</label>
                                <input type="text" class="form-control" wire:model="degree_bn" placeholder="এমবিবিএস, এফসিপিএস">
                            </div>
                            <!-- Fee Calculation Section -->
                            <div class="col-12">
                                <div class="border-bottom my-2"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Consultation Fee (৳)</label>
                                <input type="number" class="form-control" wire:model="base_fee">
                                @error('base_fee') <span class="text-danger x-small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Discount (%)</label>
                                <input type="number" class="form-control" wire:model="discount_percentage">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <!-- Bio/Details Section -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Bio/Experience (English)</label>
                                <textarea class="form-control" wire:model="bio_en" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Bio/Experience (Bangla)</label>
                                <textarea class="form-control" wire:model="bio_bn" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0 border-top-0 mt-4">
                            <button type="button" class="btn btn-light rounded-pill px-4 shadow-sm" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                                {{ $isEditMode ? 'Update Doctor' : 'Save Doctor' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>