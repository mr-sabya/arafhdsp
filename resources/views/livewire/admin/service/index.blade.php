<div>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Benefit Services</h5>
            <button wire:click="openModal" class="btn btn-primary btn-sm rounded-pill px-3">
                <i class="ri-add-line"></i> Add New Service
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>Service Name</th>
                        <th>Type</th>
                        <th>Plans Linked</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $service->name }}</div>
                            <small class="text-muted">{{ $service->slug }}</small>
                        </td>
                        <td>
                            <span class="badge {{ $service->type == 'limit' ? 'bg-info-subtle text-info' : 'bg-warning-subtle text-warning' }}">
                                {{ ucfirst($service->type) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary rounded-pill">{{ $service->plans->count() }} Plans</span>
                        </td>
                        <td>
                            <span class="badge {{ $service->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $service->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end pe-3">
                            <button wire:click="view({{ $service->id }})" class="btn btn-sm btn-outline-primary border-0 rounded-circle" title="View Details">
                                <i class="ri-eye-line"></i>
                            </button>
                            <button wire:click="edit({{ $service->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle"><i class="ri-edit-line"></i></button>
                            <button onclick="confirm('Delete this service?') || event.stopImmediatePropagation()" wire:click="delete({{ $service->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle"><i class="ri-delete-bin-line"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No services found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="fw-bold">{{ $isEditMode ? 'Edit Service' : 'New Service' }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4" style="max-height: 80vh; overflow-y: auto;">
                    <form wire:submit.prevent="save">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Service Name</label>
                                <input type="text" class="form-control" wire:model.live="name" placeholder="e.g. Doctor Visit">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Slug</label>
                                <input type="text" class="form-control" wire:model="slug">
                                @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Service Type</label>
                                <select class="form-select" wire:model.live="type">
                                    <option value="limit">Limit (Quota Based)</option>
                                    <option value="discount">Discount (Percentage Based)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <h6 class="fw-bold text-primary mb-3">Assign to Pricing Plans</h6>
                        <div class="table-responsive border rounded">
                            <table class="table table-sm align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="50">Enable</th>
                                        <th>Pricing Plan</th>
                                        @if($type === 'limit')
                                        <th>Quantity</th>
                                        <th>Frequency</th>
                                        @else
                                        <th>Discount %</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($planMappings as $planId => $map)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input" wire:model.live="planMappings.{{ $planId }}.enabled">
                                        </td>
                                        <td class="small fw-bold">{{ $map['plan_name'] }}</td>

                                        @if($map['enabled'])
                                        @if($type === 'limit')
                                        <td>
                                            <input type="number" class="form-control form-control-sm" wire:model="planMappings.{{ $planId }}.quantity" style="width: 80px;">
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm" wire:model="planMappings.{{ $planId }}.frequency">
                                                <option value="monthly">Monthly</option>
                                                <option value="yearly">Yearly</option>
                                                <option value="lifetime">Lifetime</option>
                                            </select>
                                        </td>
                                        @else
                                        <td>
                                            <div class="input-group input-group-sm" style="width: 100px;">
                                                <input type="number" class="form-control" wire:model="planMappings.{{ $planId }}.discount_value">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </td>
                                        @endif
                                        @else
                                        <td colspan="2" class="text-muted small italic">Not assigned</td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-pill px-4" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm"></span>
                                Save Service
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- VIEW MODAL -->
    @if($isViewOpen && $viewingService)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light border-0">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="ri-information-line me-1"></i> Service Details
                    </h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeViewModal"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Basic Info Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light">
                                <label class="text-muted small fw-bold d-block mb-1">SERVICE NAME</label>
                                <div class="fw-bold fs-5">{{ $viewingService->name }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <label class="text-muted small fw-bold d-block mb-1">TYPE</label>
                                <span class="badge {{ $viewingService->type == 'limit' ? 'bg-info' : 'bg-warning text-dark' }}">
                                    {{ strtoupper($viewingService->type) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <label class="text-muted small fw-bold d-block mb-1">STATUS</label>
                                <span class="badge {{ $viewingService->status ? 'bg-success' : 'bg-danger' }}">
                                    {{ $viewingService->status ? 'ACTIVE' : 'INACTIVE' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Linked Plans Table -->
                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="ri-list-check-2 me-2"></i> Linked Pricing Plans
                    </h6>
                    <div class="table-responsive border rounded">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Plan Name</th>
                                    <th>Level</th>
                                    @if($viewingService->type === 'limit')
                                    <th class="text-center">Usage Limit</th>
                                    <th class="text-center">Frequency</th>
                                    @else
                                    <th class="text-center">Benefit Value</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($viewingService->plans as $plan)
                                <tr>
                                    <td class="fw-bold text-primary">{{ $plan->name }}</td>
                                    <td><small class="text-muted">{{ $plan->level_text }}</small></td>

                                    @if($viewingService->type === 'limit')
                                    <td class="text-center">
                                        <span class="badge bg-dark rounded-pill">{{ $plan->pivot->quantity }} Times</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary-subtle text-primary">{{ ucfirst($plan->pivot->frequency) }}</span>
                                    </td>
                                    @else
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success fs-6">
                                            {{ (int)$plan->pivot->discount_value }}% Discount
                                        </span>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="ri-error-warning-line d-block fs-3 opacity-50"></i>
                                        This service is not currently assigned to any plans.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" wire:click="closeViewModal">Close</button>
                    <button type="button" class="btn btn-primary rounded-pill px-4" wire:click="edit({{ $viewingService->id }}); closeViewModal();">
                        <i class="ri-edit-line me-1"></i> Go to Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>