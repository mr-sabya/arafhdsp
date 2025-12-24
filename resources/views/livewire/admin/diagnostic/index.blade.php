<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Diagnostic Center Management</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search centers...">
                        </div>
                        <button wire:click="openModal" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add New Center
                        </button>
                    </div>
                </div>

                <!-- Grid Section -->
                <div class="row g-4 p-4">
                    @forelse($centers as $center)
                    <div class="col-xl-3 col-md-6" wire:key="center-{{ $center->id }}">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative admin-diag-card">
                            <div class="position-absolute top-0 end-0 p-2" style="z-index: 2;">
                                <span class="badge {{ $center->status ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                    {{ $center->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <img src="{{ asset('storage/'. $center->photo) }}" class="card-img-top" style="height: 180px; object-fit: cover;">

                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-1 text-dark">{{ $center->name_bn }}</h6>
                                <p class="text-muted small mb-2"><i class="ri-map-pin-line me-1 text-primary"></i> {{ $center->area->bn_name ?? $center->district->bn_name }}</p>

                                <div class="mb-3">
                                    @if($center->test_list)
                                    @foreach(array_slice($center->test_list, 0, 3) as $test)
                                    <span class="badge bg-light text-primary border border-primary-subtle rounded-pill x-small me-1 mb-1">{{ $test }}</span>
                                    @endforeach
                                    @if(count($center->test_list) > 3) <small class="text-muted x-small">+ more</small> @endif
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <span class="text-muted x-small">Order: #{{ $center->sort_order }}</span>
                                    <div class="btn-group">
                                        <button wire:click="edit({{ $center->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle"><i class="ri-edit-line"></i></button>
                                        <button onclick="confirm('Delete this center?') || event.stopImmediatePropagation()" wire:click="delete({{ $center->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">No Diagnostic Centers found.</div>
                    @endforelse
                </div>
                <div class="card-footer bg-white border-0">{{ $centers->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); overflow-y: auto;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="fw-bold text-primary">{{ $isEditMode ? 'Edit' : 'Add' }} Diagnostic Center</h5>
                    <button wire:click="closeModal" class="btn-close shadow-none"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <form wire:submit.prevent="save">
                        <div class="row g-3 mt-1">
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name (EN)</label>
                                        <input type="text" class="form-control" wire:model="name_en">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Name (BN)</label>
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
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Center Photo</label>
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

                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Discount Text (EN)</label>
                                <input type="text" class="form-control" wire:model="discount_badge_en" placeholder="Up to 50% Off">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Discount Text (BN)</label>
                                <input type="text" class="form-control" wire:model="discount_badge_bn" placeholder="৫০% পর্যন্ত ছাড়">
                            </div>

                            <!-- Dynamic Test List -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label small fw-bold mb-0">Tests/Services List</label>
                                    <button type="button" wire:click="addTest" class="btn btn-xs btn-outline-primary rounded-pill px-2" style="font-size: 10px;">+ Add Test</button>
                                </div>
                                <div class="row g-2">
                                    @foreach($test_list as $index => $test)
                                    <div class="col-md-4 position-relative" wire:key="test-{{ $index }}">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" wire:model="test_list.{{ $index }}" placeholder="e.g. CBC">
                                            <button type="button" wire:click="removeTest({{ $index }})" class="btn btn-outline-danger"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label small fw-bold">Address (BN)</label>
                                <input type="text" class="form-control" wire:model="address_bn">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold">Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0 border-0 mt-4">
                            <button type="button" wire:click="closeModal" class="btn btn-light rounded-pill px-4">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow">Save Center</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>