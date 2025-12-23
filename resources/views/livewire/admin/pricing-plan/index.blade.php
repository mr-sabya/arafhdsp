<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Pricing Plans</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search plans...">
                        </div>
                        <button wire:click="openModal" class="btn btn-primary btn-sm">
                            <i class="ri-add-line"></i> New Package
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3" wire:click="sortBy('sort_order')" style="cursor:pointer">
                                    Order @if($sortField === 'sort_order') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }}"></i> @endif
                                </th>
                                <th wire:click="sortBy('name')" style="cursor:pointer">
                                    Package Name @if($sortField === 'name') <i class="ri-sort-{{ $sortDirection === 'asc' ? 'asc' : 'desc' }}"></i> @endif
                                </th>
                                <th>Price</th>
                                <th>Features</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($plans as $plan)
                            <tr wire:key="plan-{{ $plan->id }}">
                                <td class="ps-3 text-muted">{{ $plan->sort_order }}</td>
                                <td>
                                    <div class="fw-bold">{{ $plan->name }}</div>
                                    <small class="text-muted">{{ $plan->level_text }}</small>
                                    @if($plan->is_featured) <span class="badge bg-info-subtle text-info ms-1">Popular</span> @endif
                                </td>
                                <td class="fw-bold text-primary">৳{{ number_format($plan->price) }}</td>
                                <td><span class="badge bg-light text-dark">{{ count($plan->features) }} Features</span></td>
                                <td>
                                    <span class="badge {{ $plan->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                        {{ $plan->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <button wire:click="edit({{ $plan->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle shadow-none"><i class="ri-edit-line"></i></button>
                                    <button onclick="confirm('Delete this package?') || event.stopImmediatePropagation()" wire:click="delete({{ $plan->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle shadow-none"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No pricing plans found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0">{{ $plans->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">{{ $isEditMode ? 'Edit Package' : 'New Package' }}</h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Package Name</label>
                                <input type="text" class="form-control shadow-none" wire:model="name" placeholder="e.g. Basic">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Level Text</label>
                                <input type="text" class="form-control shadow-none" wire:model="level_text" placeholder="e.g. Level 1">
                                @error('level_text') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Price (৳)</label>
                                <input type="number" class="form-control shadow-none" wire:model="price">
                                @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold d-flex justify-content-between">
                                Features
                                <button type="button" wire:click="addFeature" class="btn btn-sm btn-link p-0 text-decoration-none">+ Add More</button>
                            </label>
                            @foreach($features as $index => $feature)
                            <div class="input-group mb-2">
                                <div class="input-group-text bg-white">
                                    <input class="form-check-input mt-0" type="checkbox" wire:model="features.{{ $index }}.available">
                                </div>
                                <input type="text" class="form-control shadow-none {{ !$features[$index]['available'] ? 'text-decoration-line-through text-muted' : '' }}" wire:model="features.{{ $index }}.text" placeholder="Description">
                                @if(count($features) > 1)
                                <button type="button" wire:click="removeFeature({{ $index }})" class="btn btn-outline-danger"><i class="ri-delete-bin-line"></i></button>
                                @endif
                            </div>
                            @error('features.'.$index.'.text') <span class="text-danger small d-block mb-2">{{ $message }}</span> @enderror
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Ribbon Text</label>
                                <input type="text" class="form-control shadow-none" wire:model="ribbon_text" placeholder="Best Choice">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Sort Order</label>
                                <input type="number" class="form-control shadow-none" wire:model="sort_order">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold">Status</label>
                                <select class="form-select shadow-none" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" wire:model="is_featured" id="pop">
                            <label class="form-check-label fw-bold" for="pop">Popular Package Toggle</label>
                        </div>

                        <div class="modal-footer px-0 pb-0 border-0">
                            <button type="button" class="btn btn-light" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                                {{ $isEditMode ? 'Update Package' : 'Save Package' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>