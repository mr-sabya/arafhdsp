<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <div class="search-box">
                                <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Search by title...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-sm-auto ms-auto">
                            <div class="list-grid-nav hstack gap-1">
                                <button
                                    class="btn btn-info addMembers-modal"
                                    wire:click="create"
                                    data-bs-toggle="modal"
                                    data-bs-target="#serviceModal">
                                    <i class="ri-add-fill me-1 align-bottom"></i> Add New Service
                                </button>

                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- Controls --}}
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-2 col-6">
                            <select wire:model.live="perPage" class="form-select form-select-sm">
                                <option value="5">5 per page</option>
                                <option value="10">10 per page</option>
                                <option value="25">25 per page</option>
                                <option value="50">50 per page</option>
                            </select>
                        </div>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="cursor: pointer" wire:click="sortBy('id')">ID <i class="fas fa-sort"></i></th>
                                    <th>Icon</th>
                                    <th style="cursor: pointer" wire:click="sortBy('title')">Title <i class="fas fa-sort"></i></th>
                                    <th>Short Desc</th>
                                    <th style="cursor: pointer" wire:click="sortBy('sort_order')">Order <i class="fas fa-sort"></i></th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td><i class="{{ $service->icon_class }} fa-lg text-secondary"></i></td>
                                    <td class="fw-bold">{{ $service->title }}</td>
                                    <td class="small text-muted">{{ Str::limit($service->short_description, 30) }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $service->sort_order }}</span></td>
                                    <td>
                                        <span class="badge bg-{{ $service->status ? 'success' : 'danger' }}">
                                            {{ $service->status ? 'Active' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        {{-- EDIT BUTTON: Opens Modal directly --}}
                                        <button wire:click="edit({{ $service->id }})"
                                            data-bs-toggle="modal"
                                            data-bs-target="#serviceModal"
                                            class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button wire:confirm="Are you sure?"
                                            wire:click="delete({{ $service->id }})"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No services found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">{{ $services->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Modal --}}
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $isEditMode ? 'Edit Service' : 'Add New Service' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit.prevent="store">
                    <div class="modal-body">

                        {{-- Loading Indicator (only for Edit) --}}
                        <div wire:loading.block wire:target="edit" class="text-center py-4">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-2 text-muted">Loading...</p>
                        </div>

                        {{-- Form Content --}}
                        <div wire:loading.remove wire:target="edit">
                            <div class="row g-3">

                                {{-- Left Column --}}
                                <div class="col-md-6">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" wire:model="title" placeholder="Service Name">
                                    @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" wire:model="sort_order">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Icon Class (FontAwesome)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="{{ $icon_class ?? 'fas fa-icons' }}"></i></span>
                                        <input type="text" class="form-control" wire:model.live="icon_class" placeholder="fa-solid fa-pen">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Details URL</label>
                                    <input type="text" class="form-control" wire:model="details_url" placeholder="service-details.html">
                                </div>

                                {{-- Full Width Columns --}}
                                <div class="col-12">
                                    <label class="form-label">Short Description (Grid View)</label>
                                    <input type="text" class="form-control" wire:model="short_description" placeholder="e.g. 120 Projects">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Long Description (List View)</label>
                                    <textarea class="form-control" rows="3" wire:model="description"></textarea>
                                </div>

                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="statusSwitch" wire:model="status">
                                        <label class="form-check-label" for="statusSwitch">Active Status</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <span wire:loading.remove wire:target="store">{{ $isEditMode ? 'Update Changes' : 'Save Service' }}</span>
                            <span wire:loading wire:target="store">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>