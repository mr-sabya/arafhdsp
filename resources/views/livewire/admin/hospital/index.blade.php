<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Partner Hospitals & Diagnostic Centers</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search...">
                        </div>
                        <button wire:click="openModal" class="btn btn-success btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add New
                        </button>
                    </div>
                </div>

                <div class="row g-4 p-4">
                    @forelse($hospitals as $hospital)
                    <div class="col-xl-4 col-md-6" wire:key="hosp-{{ $hospital->id }}">
                        <div class="card h-100 border hospital-admin-card transition-all position-relative">
                            <div class="position-absolute top-0 end-0 p-2 d-flex flex-column align-items-end gap-1">
                                <span class="badge {{ $hospital->status ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                    {{ $hospital->status ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="badge bg-primary rounded-pill small">{{ $hospital->display_type }}</span>
                            </div>

                            <div class="card-body p-3">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ asset('storage/'.$hospital->photo) }}" class="rounded-3 shadow-sm me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $hospital->name_bn }}</h6>
                                        <!-- type -->
                                        <span class="badge bg-secondary rounded-pill small">{{ $hospital->type }}</span>
                                        <p class="text-muted small mb-0"><i class="ri-map-pin-line me-1"></i>
                                            {{ $hospital->area ? $hospital->area->bn_name . ($hospital->district ? ', ' : '') : '' }}

                                            {{-- ডিস্ট্রিক্ট থাকলে দেখাবে --}}
                                            {{ $hospital->district->bn_name ?? '' }}
                                        </p>
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
                                        <button wire:click="$dispatchTo('admin.hospital.manage-doctors', 'openManageDoctors', { id: {{ $hospital->id }} })"
                                            class="btn btn-sm btn-outline-primary border-0 rounded"
                                            title="Manage Doctors">
                                            <i class="ri-user-add-line"></i> Manage Doctors
                                        </button>
                                        <button wire:click="$dispatchTo('admin.hospital.manage-tests', 'openManageTests', { id: {{ $hospital->id }} })"
                                            class="btn btn-sm btn-outline-warning border-0 rounded"
                                            title="Manage Medical Tests">
                                            <i class="ri-flask-line"></i> Manage Tests
                                        </button>
                                        <button wire:click="edit({{ $hospital->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle"><i class="ri-edit-line"></i></button>
                                        <button onclick="confirm('Delete this hospital?') || event.stopImmediatePropagation()" wire:click="delete({{ $hospital->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5 text-muted">No records found.</div>
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
                    <h5 class="fw-bold text-success">{{ $isEditMode ? 'Edit Record' : 'Add Record' }}</h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="row g-3">
                            <!-- Basic Info -->
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
                                        <label class="form-label small fw-bold">Type</label>
                                        <select class="form-select" wire:model="type">
                                            @foreach(App\Models\Hospital::getTypes() as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Division</label>
                                        <select class="form-select" wire:model.live="division_id">
                                            <option value="">Select Division</option>
                                            @foreach($divisions as $div) <option value="{{ $div->id }}">{{ $div->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">District</label>
                                        <select class="form-select" wire:model.live="district_id">
                                            <option value="">Select District</option>
                                            @foreach($districts as $dis) <option value="{{ $dis->id }}">{{ $dis->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Upazila</label>
                                        <select class="form-select" wire:model.live="upazila_id">
                                            <option value="">Select Upazila</option>
                                            @foreach($upazilas as $upz) <option value="{{ $upz->id }}">{{ $upz->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Area</label>
                                        <select class="form-select" wire:model="area_id">
                                            <option value="">Select Area</option>
                                            @foreach($areas as $ar) <option value="{{ $ar->id }}">{{ $ar->bn_name }}</option> @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Photo -->
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Logo/Photo</label>
                                <div class="image-preview" style="height: 175px;">
                                    @if($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="">
                                    @elseif($existingPhoto)
                                    <img src="{{ asset('storage/'.$existingPhoto) }}" alt="">
                                    @else
                                    <i class="ri-image-add-line fs-1 text-muted"></i>
                                    @endif
                                </div>
                                <input type="file" class="form-control" wire:model="photo">
                            </div>

                            <!-- Phone Numbers -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Main Phone</label>
                                <input type="text" class="form-control" wire:model="phone">
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label small fw-bold">Serial Numbers (Optional)</label>
                                            <button type="button" wire:click="addSerialPhone" class="btn btn-sm text-success p-0 mb-1"><i class="ri-add-circle-fill"></i> Add</button>
                                        </div>
                                        <div class="row g-2">
                                            @foreach($serial_phones as $index => $sp)
                                            <div class="col-12">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control" wire:model="serial_phones.{{ $index }}" placeholder="Phone number">
                                                    <button type="button" wire:click="removeSerialPhone({{ $index }})" class="btn btn-outline-danger"><i class="ri-close-line"></i></button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Address -->
                            <div class="col-12">
                                <label class="form-label small fw-bold">Full Address (BN)</label>
                                <textarea class="form-control" wire:model="address_bn" rows="2"></textarea>
                            </div>

                            <!-- Benefits -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">Benefits & Discounts</h6>
                                    <button type="button" wire:click="addBenefit" class="btn btn-sm btn-outline-success rounded-pill px-3">Add Benefit</button>
                                </div>
                                <div class="bg-light p-3 rounded">
                                    @foreach($benefits as $index => $benefit)
                                    <div class="row g-2 mb-2 align-items-end" wire:key="ben-{{ $index }}">
                                        <div class="col-md-4"><input type="text" class="form-control form-control-sm" placeholder="EN" wire:model="benefits.{{ $index }}.text_en"></div>
                                        <div class="col-md-4"><input type="text" class="form-control form-control-sm" placeholder="BN" wire:model="benefits.{{ $index }}.text_bn"></div>
                                        <div class="col-md-3">
                                            <select class="form-select form-select-sm" wire:model="benefits.{{ $index }}.class">
                                                <option value="bg-info text-dark">Cyan</option>
                                                <option value="bg-success text-white">Green</option>
                                                <option value="bg-danger text-white">Red</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 text-end">
                                            <button type="button" wire:click="removeBenefit({{ $index }})" class="btn btn-sm text-danger"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Settings -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0 mt-4 border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-success rounded-pill px-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif


    @livewire('admin.hospital.manage-doctors')
    @livewire('admin.hospital.manage-tests')
</div>