<div class="row">
    <!-- Left Column: Form (col-md-4) -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0 fw-bold">
                            <i class="ri-shield-user-line me-1"></i> {{ $isEditMode ? 'Edit Role' : 'Create Role' }}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Role Name</label>
                        <input type="text" class="form-control shadow-none" wire:model.live="name" placeholder="e.g. Editor">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Role Slug</label>
                        <input type="text" class="form-control shadow-none" wire:model="slug" placeholder="e.g. editor">
                        <div class="form-text mt-1 small">Used for system permissions.</div>
                        @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                            <i class="ri-save-3-line me-1"></i> {{ $isEditMode ? 'Update Role' : 'Save Role' }}
                        </button>
                        @if($isEditMode)
                        <button type="button" wire:click="resetFields" class="btn btn-light text-secondary">Cancel</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Role Permissions Tip -->
        <div class="card bg-light border-0 shadow-sm d-none d-lg-block">
            <div class="card-body py-3">
                <p class="small text-muted mb-0">
                    <i class="ri-information-line me-1 text-info"></i>
                    Tip: Roles define user permissions. The <strong>slug</strong> should be lowercase and unique.
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
                        <h5 class="mb-0 fw-bold">User Roles</h5>
                    </div>
                </div>
            </div>

            <div class="row g-3 align-items-center px-3 py-2">
                <div class="col-auto ms-auto">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                        <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search roles...">
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3" style="cursor: pointer; width: 80px;" wire:click="sortBy('id')">
                                # @if($sortField === 'id') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sortBy('name')">
                                Role Name @if($sortField === 'name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th style="cursor: pointer;" wire:click="sortBy('slug')">
                                Slug @if($sortField === 'slug') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }} text-primary"></i> @endif
                            </th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr wire:key="role-{{ $role->id }}">
                            <td class="ps-3 text-muted">{{ $role->id }}</td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $role->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border">{{ $role->slug }}</span>
                            </td>
                            <td class="text-end pe-3">
                                <button wire:click="edit({{ $role->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle" title="Edit">
                                    <i class="ri-edit-line"></i>
                                </button>
                                <button onclick="confirm('Are you sure you want to delete this role?') || event.stopImmediatePropagation()"
                                    wire:click="delete({{ $role->id }})"
                                    class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Delete">
                                    <i class="ri-delete-bin-7-line"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="ri-shield-keyhole-line d-block text-muted mb-2" style="font-size: 30px;"></i>
                                <span class="text-muted small">No roles found matching your search.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small text-muted">
                        Showing {{ $roles->firstItem() ?? 0 }} to {{ $roles->lastItem() ?? 0 }} of {{ $roles->total() }} results
                    </div>
                    <div>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>