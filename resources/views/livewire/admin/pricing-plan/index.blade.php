<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Pricing Plans</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none" wire:model.live.debounce.300ms="search" placeholder="Search plans...">
                        </div>
                        <button wire:click="openModal" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> New Package
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3" wire:click="sortBy('sort_order')" style="cursor:pointer">Order</th>
                                <th wire:click="sortBy('name')" style="cursor:pointer">Package Name</th>
                                <th>Interval</th>
                                <th>Pricing Logic</th>
                                <th>Price</th>
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
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ ucfirst($plan->billing_interval) }}
                                    </span>
                                </td>
                                <td>
                                    @if($plan->pricing_type === 'per_member')
                                    <span class="badge bg-info-subtle text-info">Per Member</span>
                                    @else
                                    <span class="badge bg-secondary-subtle text-secondary">Fixed</span>
                                    @endif
                                    @if($plan->discount_percentage > 0)
                                    <span class="badge bg-danger-subtle text-danger">{{ $plan->discount_percentage }}% Off</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-primary">৳{{ number_format($plan->price) }}</td>
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
                                <td colspan="7" class="text-center py-5 text-muted">No pricing plans found.</td>
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
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold text-primary">{{ $isEditMode ? 'Edit Package' : 'New Package' }}</h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-semibold small">Package Name</label>
                                <input type="text" class="form-control" wire:model="name" placeholder="e.g. Family Pack">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold small">Level Text</label>
                                <input type="text" class="form-control" wire:model="level_text" placeholder="e.g. Level 2">
                                @error('level_text') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Pricing Engine Section -->
                        <div class="bg-light p-3 rounded mb-4 border">
                            <h6 class="fw-bold mb-3 small text-uppercase text-muted">Pricing Engine Logic</h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Price (৳)</label>
                                    <input type="number" class="form-control" wire:model="price">
                                    @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Interval</label>
                                    <select class="form-select" wire:model="billing_interval">
                                        <option value="monthly">Monthly</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="lifetime">Lifetime</option>
                                        <option value="one_time">One Time</option>
                                    </select>
                                    @error('billing_interval') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Pricing Type</label>
                                    <select class="form-select" wire:model.live="pricing_type">
                                        <option value="fixed">Fixed Price</option>
                                        <option value="per_member">Per Member</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label small fw-bold">Discount (%)</label>
                                    <input type="number" class="form-control" wire:model="discount_percentage" placeholder="e.g. 30">
                                </div>

                                @if($pricing_type === 'per_member')
                                <div class="col-12">
                                    <div class="alert alert-info py-2 mb-0 border-0">
                                        <label class="form-label small fw-bold mb-1">Fixed Price Rule for 5 Members (Optional)</label>
                                        <div class="input-group input-group-sm" style="width: 250px;">
                                            <span class="input-group-text">5 People = ৳</span>
                                            <input type="number" class="form-control shadow-none" wire:model="fixed_price_for_5" placeholder="e.g. 400">
                                        </div>
                                        <small class="d-block mt-1 opacity-75">If set, selecting 5 members will override the "Price per member" calculation.</small>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold small d-flex justify-content-between">
                                Features / Perks
                                <button type="button" wire:click="addFeature" class="btn btn-sm btn-link p-0 text-decoration-none">+ Add Feature</button>
                            </label>
                            @foreach($features as $index => $feature)
                            <div class="input-group mb-2 shadow-sm" wire:key="feature-{{ $index }}">
                                <div class="input-group-text bg-white border-end-0">
                                    <input class="form-check-input mt-0" type="checkbox" wire:model="features.{{ $index }}.available">
                                </div>
                                <input type="text" class="form-control border-start-0 shadow-none {{ !$features[$index]['available'] ? 'text-decoration-line-through text-muted' : '' }}" wire:model="features.{{ $index }}.text" placeholder="Feature description">
                                @if(count($features) > 1)
                                <button type="button" wire:click="removeFeature({{ $index }})" class="btn btn-outline-danger"><i class="ri-delete-bin-line"></i></button>
                                @endif
                            </div>
                            @error('features.'.$index.'.text') <span class="text-danger small d-block mb-2">{{ $message }}</span> @enderror
                            @endforeach
                        </div>

                        <div class="row align-items-end">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold small">Ribbon Text (Optional)</label>
                                <input type="text" class="form-control" wire:model="ribbon_text" placeholder="e.g. Popular">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold small">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label fw-semibold small">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" wire:model="is_featured" id="pop">
                            <label class="form-check-label fw-bold small" for="pop">Highlight as Popular Package</label>
                        </div>

                        <div class="modal-footer px-0 pb-0 border-top-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                                {{ $isEditMode ? 'Update Package' : 'Create Package' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>