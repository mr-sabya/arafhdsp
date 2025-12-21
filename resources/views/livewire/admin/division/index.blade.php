<div class="row">
    <!-- Left Column: Form (col-md-4) -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">
                            <i class="ri-add-circle-line me-1"></i> {{ $isEditMode ? 'Edit Division' : 'Create Division' }}
                        </h5>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Division Name (English)</label>
                        <input type="text" class="form-control shadow-none" wire:model="name" placeholder="e.g. Dhaka">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Division Name (Bangla)</label>
                        <input type="text" class="form-control shadow-none" wire:model="bn_name" placeholder="e.g. ঢাকা">
                        @error('bn_name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-3-line me-1"></i> {{ $isEditMode ? 'Update' : 'Save' }}
                        </button>
                        @if($isEditMode)
                        <button type="button" wire:click="resetFields" class="btn btn-light text-secondary">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Optional Help Card -->
        <div class="card bg-light border-0 shadow-sm d-none d-lg-block">
            <div class="card-body py-3">
                <p class="small text-muted mb-0">
                    <i class="ri-information-line me-1 text-info"></i>
                    Tip: Divisions are the highest administrative tier. Ensure spellings match official government records.
                </p>
            </div>
        </div>
    </div>

    <!-- Right Column: Table (col-md-8) -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">Divisions</h5>
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
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" style="cursor: pointer;" wire:click="sortBy('id')">
                                # @if($sortField === 'id') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sortBy('name')">
                                English Name @if($sortField === 'name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sortBy('bn_name')">
                                Bangla Name @if($sortField === 'bn_name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($divisions as $division)
                        <tr wire:key="div-{{ $division->id }}">
                            <td class="ps-3 text-muted">{{ $division->id }}</td>
                            <td><span class="fw-semibold text-dark">{{ $division->name }}</span></td>
                            <td>{{ $division->bn_name }}</td>
                            <td class="text-end pe-3">
                                <button wire:click="edit({{ $division->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button onclick="confirm('Delete this division?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $division->id }})"
                                    class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Delete">
                                    <i class="ri-delete-bin-7-line"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="ri-folder-open-line d-block text-muted mb-2" style="font-size: 30px;"></i>
                                <span class="text-muted small">No records found matching your search.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                        Showing {{ $divisions->firstItem() }} to {{ $divisions->lastItem() }} of {{ $divisions->total() }} results
                    </div>
                    <div>
                        {{ $divisions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>