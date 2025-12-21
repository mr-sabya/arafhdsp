<div class="row">
    <!-- Left Column: Form (col-md-5) -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="ri-community-line me-1 text-primary"></i>
                    {{ $isEditMode ? 'Edit Area' : 'Add Multiple Areas' }}
                </h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="row g-2 mb-3">
                        <!-- Division -->
                        <div class="col-md-4">
                            <label class="form-label x-small fw-bold">Division</label>
                            <select class="form-select form-select-sm shadow-none"
                                wire:model.live="selectedDivision">
                                <option value="">Select</option>
                                @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District -->
                        <div class="col-md-4" wire:key="district-select-{{ $selectedDivision }}">
                            <label class="form-label x-small fw-bold">District</label>
                            <select class="form-select form-select-sm shadow-none"
                                wire:model.live="selectedDistrict">
                                <option value="">Select</option>
                                @foreach($districts_list as $dist)
                                <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Upazila -->
                        <div class="col-md-4" wire:key="upazila-select-{{ $selectedDistrict }}">
                            <label class="form-label x-small fw-bold">Upazila</label>
                            <select class="form-select form-select-sm shadow-none @error('upazila_id') is-invalid @enderror"
                                wire:model="upazila_id">
                                <option value="">Select</option>
                                @foreach($upazilas_list as $upz)
                                <option value="{{ $upz->id }}">{{ $upz->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="text-muted opacity-25">

                    @foreach($areas_input as $index => $input)
                    <div class="card bg-light border-0 mb-3" wire:key="area-row-{{ $index }}">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-white text-dark border small">City/Village #{{ $index + 1 }}</span>
                                @if(!$isEditMode && count($areas_input) > 1)
                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm text-danger p-0"><i class="ri-delete-bin-line"></i></button>
                                @endif
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm shadow-none" wire:model="areas_input.{{ $index }}.name" placeholder="Name (English)">
                                    @error("areas_input.$index.name") <span class="text-danger x-small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm shadow-none" wire:model="areas_input.{{ $index }}.bn_name" placeholder="Name (Bangla)">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control form-control-sm shadow-none" wire:model="areas_input.{{ $index }}.post_code" placeholder="Post Code (Optional)">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if(!$isEditMode)
                    <button type="button" wire:click="addRow" class="btn btn-sm btn-outline-primary border-dashed w-100 py-2">
                        <i class="ri-add-line"></i> Add More Areas
                    </button>
                    @endif

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary fw-bold">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-3-line me-1"></i> {{ $isEditMode ? 'Update' : 'Save Areas' }}
                        </button>
                        @if($isEditMode)
                        <button type="button" wire:click="resetInputs" class="btn btn-light border text-secondary">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Table (col-md-7) -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">Area List</h5>
                    </div>
                </div>
            </div>

            <div class="row g-3 align-items-center px-3 py-2">
                <div class="col-auto ms-auto">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                        <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light small text-uppercase">
                        <tr>
                            <th class="ps-3" style="cursor: pointer;" wire:click="sortBy('id')"># @if($sortField === 'id') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif</th>
                            <th style="cursor: pointer;" wire:click="sortBy('name')">Area @if($sortField === 'name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif</th>
                            <th>Parent Upazila</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($areas as $area)
                        <tr wire:key="area-{{ $area->id }}">
                            <td class="ps-3 text-muted small">#{{ $area->id }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $area->name }}</div>
                                <div class="x-small text-muted">{{ $area->bn_name }} {{ $area->post_code ? '| PC: '.$area->post_code : '' }}</div>
                            </td>
                            <td>
                                <div class="small fw-bold">{{ $area->upazila->name }}</div>
                                <div class="x-small text-muted">{{ $area->upazila->district->name }}, {{ $area->upazila->district->division->name }}</div>
                            </td>
                            <td class="text-end pe-3">
                                <button wire:click="edit({{ $area->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle"><i class="ri-edit-line"></i></button>
                                <button onclick="confirm('Delete?') || event.stopImmediatePropagation()" wire:click="delete({{ $area->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle"><i class="ri-delete-bin-line"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted small">No records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white py-3 border-top-0">
                {{ $areas->links() }}
            </div>
        </div>
    </div>
</div>