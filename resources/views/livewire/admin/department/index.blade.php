<div class="row">
    <!-- Left Column: Form (col-md-4) -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="{{ $isEditMode ? 'ri-edit-circle-line' : 'ri-add-circle-line' }} me-1"></i>
                    {{ $isEditMode ? 'Edit Department' : 'Create Department' }}
                </h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Name (English) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none" wire:model="name_en" placeholder="e.g. Cardiology">
                        @error('name_en') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Name (Bangla) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none" wire:model="name_bn" placeholder="e.g. কার্ডিওলজি">
                        @error('name_bn') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Icon Class (FontAwesome/Remix)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="{{ $icon }}"></i></span>
                            <input type="text" class="form-control shadow-none" wire:model.live="icon" placeholder="fas fa-heartbeat">
                        </div>
                        <small class="text-muted" style="font-size: 10px;">Example: fas fa-pills, ri-heart-line</small>
                        @error('icon') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold small">Sort Order</label>
                            <input type="number" class="form-control shadow-none" wire:model="sort_order">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold small">Status</label>
                            <select class="form-select shadow-none" wire:model="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" class="btn btn-primary shadow-sm">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-3-line me-1"></i> {{ $isEditMode ? 'Update Department' : 'Save Department' }}
                        </button>
                        @if($isEditMode)
                        <button type="button" wire:click="resetFields" class="btn btn-light text-secondary border">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-info-subtle border-0 shadow-sm mt-3 d-none d-lg-block">
            <div class="card-body py-3">
                <p class="small text-info-emphasis mb-0">
                    <i class="ri-information-line me-1"></i>
                    Icons are based on <b>FontAwesome</b> or <b>Remix Icons</b> classes.
                </p>
            </div>
        </div>
    </div>

    <!-- Right Column: Table (col-md-8) -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">Department List</h5>
                    </div>
                    <div class="col-auto">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search departments...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" style="cursor: pointer;" wire:click="sortBy('sort_order')">
                                Order @if($sortField === 'sort_order') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th>Icon</th>
                            <th style="cursor: pointer;" wire:click="sortBy('name_en')">
                                English Name @if($sortField === 'name_en') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sortBy('name_bn')">
                                Bangla Name @if($sortField === 'name_bn') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th>Status</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $dept)
                        <tr wire:key="dept-{{ $dept->id }}">
                            <td class="ps-3 text-muted">#{{ $dept->sort_order }}</td>
                            <td>
                                <div class="dept-icon-box small bg-light text-primary rounded d-flex align-items-center justify-content-center" style="width:35px; height:35px;">
                                    <i class="{{ $dept->icon }} fs-5"></i>
                                </div>
                            </td>
                            <td><span class="fw-semibold text-dark">{{ $dept->name_en }}</span></td>
                            <td>{{ $dept->name_bn }}</td>
                            <td>
                                <span class="badge {{ $dept->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill">
                                    {{ $dept->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <button wire:click="edit({{ $dept->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle shadow-none" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button onclick="confirm('Delete this department?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $dept->id }})"
                                    class="btn btn-sm btn-outline-danger border-0 rounded-circle shadow-none" title="Delete">
                                    <i class="ri-delete-bin-7-line"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="ri-hospital-line d-block text-muted mb-2" style="font-size: 40px;"></i>
                                <span class="text-muted">No departments found.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                        Showing {{ $departments->firstItem() ?? 0 }} to {{ $departments->lastItem() ?? 0 }} of {{ $departments->total() }} results
                    </div>
                    <div>
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>