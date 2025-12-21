<div class="row">
    <!-- Left Column: Form -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-danger">
                    <i class="ri-drop-line me-1"></i> {{ $isEditMode ? 'Edit Blood Group' : 'Add Blood Group' }}
                </h5>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Group Name (e.g. A+)</label>
                        <input type="text" class="form-control shadow-none" wire:model="name" placeholder="A+">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bangla Name</label>
                        <input type="text" class="form-control shadow-none" wire:model="bn_name" placeholder="এ পজিটিভ">
                        @error('bn_name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-danger">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-3-line me-1"></i> {{ $isEditMode ? 'Update' : 'Save' }}
                        </button>
                        @if($isEditMode)
                        <button type="button" wire:click="resetFields" class="btn btn-light text-secondary border">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Table -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">Blood Group List</h5>
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
                            <th class="ps-3" wire:click="sortBy('id')" style="cursor: pointer;">
                                # @if($sortField === 'id') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-danger"></i> @endif
                            </th>
                            <th wire:click="sortBy('name')" style="cursor: pointer;">
                                Group Name @if($sortField === 'name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-danger"></i> @endif
                            </th>
                            <th>Bangla Name</th>
                            <th>URL Slug</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bloodGroups as $bg)
                        <tr wire:key="bg-{{ $bg->id }}">
                            <td class="ps-3 text-muted">#{{ $bg->id }}</td>
                            <td><span class="badge bg-danger px-3 py-2 rounded-pill">{{ $bg->name }}</span></td>
                            <td class="fw-semibold text-dark">{{ $bg->bn_name }}</td>
                            <td><code class="small text-muted">{{ $bg->slug }}</code></td>
                            <td class="text-end pe-3">
                                <button wire:click="edit({{ $bg->id }})" class="btn btn-sm btn-outline-primary border-0 rounded-circle"><i class="ri-edit-line"></i></button>
                                <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete({{ $bg->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle"><i class="ri-delete-bin-line"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white py-3 border-top-0">
                {{ $bloodGroups->links() }}
            </div>
        </div>
    </div>
</div>