<div class="row">
    <!-- Left Column: Form (col-md-5) -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">
                            <i class="ri-add-circle-line me-1"></i> {{ $isEditMode ? 'Edit District' : 'Add Districts' }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <!-- Division Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Select Division</label>
                        <select class="form-select shadow-none" wire:model="division_id">
                            <option value="">Choose Division...</option>
                            @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        @error('division_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <h6 class="text-secondary small fw-bold text-uppercase mb-3">District Details</h6>

                    @foreach($districts_input as $index => $district)
                    <div class="card bg-light border-0 mb-3" wire:key="district-input-{{ $index }}">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-secondary">Row #{{ $index + 1 }}</span>
                                @if(!$isEditMode && count($districts_input) > 1)
                                <button type="button" wire:click="removeRow({{ $index }})" class="btn btn-sm btn-link text-danger p-0 shadow-none">
                                    <i class="ri-delete-bin-line"></i> Remove
                                </button>
                                @endif
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm shadow-none"
                                        wire:model="districts_input.{{ $index }}.name" placeholder="English Name">
                                    @error("districts_input.$index.name") <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm shadow-none"
                                        wire:model="districts_input.{{ $index }}.bn_name" placeholder="Bangla Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if(!$isEditMode)
                    <div class="mb-3">
                        <button type="button" wire:click="addRow" class="btn btn-sm btn-outline-primary border-dashed w-100">
                            <i class="ri-add-line"></i> Add More District Row
                        </button>
                    </div>
                    @endif

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-3-line me-1"></i> {{ $isEditMode ? 'Update District' : 'Save All Districts' }}
                        </button>
                        @if($isEditMode)
                        <button type="button" wire:click="resetFields" class="btn btn-light text-secondary">Cancel</button>
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
                        <h5 class="mb-0 fw-bold">Districts</h5>
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
                    <thead class="bg-light text-muted small">
                        <tr>
                            <th class="ps-3" style="cursor: pointer;" wire:click="sortBy('id')">
                                # @if($sortField === 'id') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sortBy('name')">
                                District @if($sortField === 'name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th>Division</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($districts as $district)
                        <tr wire:key="dist-{{ $district->id }}">
                            <td class="ps-3 text-muted">{{ $district->id }}</td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $district->name }}</div>
                                <div class="small text-muted">{{ $district->bn_name }}</div>
                            </td>
                            <td><span class="badge bg-light text-primary border">{{ $district->division->name }}</span></td>
                            <td class="text-end pe-3">
                                <button wire:click="edit({{ $district->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button onclick="confirm('Delete this district?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $district->id }})"
                                    class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Delete">
                                    <i class="ri-delete-bin-7-line"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="ri-map-pin-line d-block text-muted mb-2" style="font-size: 30px;"></i>
                                <span class="text-muted small">No districts found.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                        Showing {{ $districts->firstItem() }} to {{ $districts->lastItem() }}
                    </div>
                    <div>
                        {{ $districts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>