<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Partner Hospitals</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search hospitals...">
                        </div>
                        <button wire:click="openModal" class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add Hospital
                        </button>
                    </div>
                </div>

                <div class="row g-4 p-4">
                    @forelse($hospitals as $hospital)
                    <div class="col-xl-4 col-md-6" wire:key="hosp-{{ $hospital->id }}">
                        <div class="card h-100 border hospital-admin-card transition-all position-relative">
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge {{ $hospital->status ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                    {{ $hospital->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="card-body p-3">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('storage/'.$hospital->photo) }}" class="rounded-3 shadow-sm me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $hospital->name_bn }}</h6>
                                        <p class="text-muted small mb-0"><i class="ri-map-pin-line me-1"></i> {{ $hospital->area->name_bn ?? $hospital->district->name_bn }}</p>
                                    </div>
                                </div>

                                <div class="mb-3 d-flex flex-wrap gap-1">
                                    @if($hospital->benefits)
                                    @foreach($hospital->benefits as $benefit)
                                    <span class="badge {{ $benefit['class'] }} x-small rounded-pill">{{ $benefit['text_bn'] }}</span>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <span class="text-muted x-small">Order: #{{ $hospital->sort_order }}</span>
                                    <div class="btn-group">
                                        <button wire:click="edit({{ $hospital->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle"><i class="ri-edit-line"></i></button>
                                        <button onclick="confirm('Delete this hospital?') || event.stopImmediatePropagation()" wire:click="delete({{ $hospital->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">No hospitals found.</div>
                    @endforelse
                </div>
                <div class="card-footer bg-white border-0">{{ $hospitals->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); overflow-y: auto;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="fw-bold text-success">{{ $isEditMode ? 'Edit Hospital' : 'Add Hospital' }}</h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="row g-3">
                            <!-- Left: Basic Info -->
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name (English)</label>
                                        <input type="text" class="form-control" wire:model="name_en">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name (Bangla)</label>
                                        <input type="text" class="form-control" wire:model="name_bn">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Division</label>
                                        <select class="form-select" wire:model.live="division_id">
                                            <option value="">Select Division</option>
                                            @foreach($divisions as $div) <option value="{{ $div->id }}">{{ $div->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">District</label>
                                        <select class="form-select" wire:model.live="district_id">
                                            <option value="">Select District</option>
                                            @foreach($districts as $dis) <option value="{{ $dis->id }}">{{ $dis->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Upazila</label>
                                        <select class="form-select" wire:model.live="upazila_id">
                                            <option value="">Select Upazila</option>
                                            @foreach($upazilas as $upz) <option value="{{ $upz->id }}">{{ $upz->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Area</label>
                                        <select class="form-select" wire:model="area_id">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $ar) <option value="{{ $ar->id }}">{{ $ar->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Photo Preview -->
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Hospital Logo/Photo</label>
                                <div class="image-preview" style="height: 175px;">
                                    @if($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="">
                                    @elseif($existingPhoto)
                                    <img src="{{ asset('storage/'.$existingPhoto) }}" alt="">
                                    @else
                                    <div class="text-center text-muted">
                                        <i class="ri-image-add-line fs-1 d-block"></i>
                                        <span class="small">No Photo Selected</span>
                                    </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control" wire:model="photo">
                            </div>

                            <!-- Benefits (Dynamic Array) -->
                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">Benefits & Discounts</h6>
                                    <button type="button" wire:click="addBenefit" class="btn btn-sm btn-outline-success rounded-pill"><i class="ri-add-line"></i> Add Item</button>
                                </div>
                                <div class="bg-light p-3 rounded">
                                    @foreach($benefits as $index => $benefit)
                                    <div class="row g-2 mb-2 align-items-end" wire:key="benefit-{{ $index }}">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm" placeholder="Text (EN)" wire:model="benefits.{{ $index }}.text_en">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm" placeholder="Text (BN)" wire:model="benefits.{{ $index }}.text_bn">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select form-select-sm" wire:model="benefits.{{ $index }}.class">
                                                <option value="bg-info text-dark">Cyan (Info)</option>
                                                <option value="bg-success text-white">Green (Success)</option>
                                                <option value="bg-secondary text-white">Gray (Secondary)</option>
                                                <option value="bg-danger text-white">Red (Danger)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" wire:click="removeBenefit({{ $index }})" class="btn btn-sm btn-outline-danger border-0"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Address & Settings -->
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Full Address (BN)</label>
                                <textarea class="form-control" wire:model="address_bn" rows="2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="text" class="form-control" wire:model="phone">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0 mt-4 border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-success rounded-pill px-4">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                                Save Hospital
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>