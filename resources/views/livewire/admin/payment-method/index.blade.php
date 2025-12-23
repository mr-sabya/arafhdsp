<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Payment Methods</h5>
                    <button wire:click="openModal" class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="ri-add-line"></i> New Method
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3" wire:click="sortBy('sort_order')" style="cursor:pointer">Order</th>
                                <th>Method Name</th>
                                <th>Type</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($methods as $method)
                            <tr>
                                <td class="ps-3">{{ $method->sort_order }}</td>
                                <td>
                                    <div class="fw-bold">{{ $method->name }}</div>
                                    <small class="text-muted">{{ $method->slug }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $method->type == 'gateway' ? 'bg-info-subtle text-info' : 'bg-secondary-subtle text-secondary' }}">
                                        {{ ucfirst($method->type) }}
                                    </span>
                                </td>
                                <td>
                                    @if($method->type == 'manual')
                                    <small>{{ $method->account_number }}</small>
                                    @else
                                    <small class="text-primary fw-bold">{{ strtoupper($method->driver) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $method->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                        {{ $method->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <button wire:click="edit({{ $method->id }})" class="btn btn-sm btn-outline-info border-0 rounded-circle shadow-none"><i class="ri-edit-line"></i></button>
                                    <button onclick="confirm('Delete this method?') || event.stopImmediatePropagation()" wire:click="delete({{ $method->id }})" class="btn btn-sm btn-outline-danger border-0 rounded-circle shadow-none"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">No payment methods found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">{{ $isEditMode ? 'Edit' : 'Add' }} Payment Method</h5>
                    <button type="button" class="btn-close shadow-none" wire:click="closeModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="save">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Method Name</label>
                                <input type="text" class="form-control shadow-none" wire:model.live="name" placeholder="Bkash Personal / PayCheckout">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Slug</label>
                                <input type="text" class="form-control shadow-none" wire:model="slug">
                                @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label small fw-bold">Method Type</label>
                                <select class="form-select shadow-none" wire:model.live="type">
                                    <option value="manual">Manual (Mobile Banking)</option>
                                    <option value="gateway">Automated Gateway</option>
                                </select>
                            </div>

                            @if($type === 'manual')
                            <!-- Manual Fields -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Account Number</label>
                                <input type="text" class="form-control" wire:model="account_number" placeholder="017xxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">QR Code (Optional)</label>
                                <input type="file" class="form-control" wire:model="qr_code">
                                @if($existing_qr && !$qr_code)
                                <img src="{{ asset('storage/'.$existing_qr) }}" width="50" class="mt-2 rounded border">
                                @endif
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold">Instructions for User</label>
                                <textarea class="form-control" wire:model="instruction" rows="2" placeholder="e.g. Please send money to this personal number..."></textarea>
                            </div>
                            @else
                            <!-- Gateway Fields -->
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Gateway Driver</label>
                                <select class="form-select" wire:model="driver">
                                    <option value="">Select Gateway</option>
                                    <option value="paycheckout">PayCheckout</option>
                                    <option value="sslcommerz">SSLCommerz</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">API Key / Client ID</label>
                                <input type="text" class="form-control" wire:model="config.api_key">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Secret Key</label>
                                <input type="password" class="form-control" wire:model="config.api_secret">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Mode</label>
                                <select class="form-select" wire:model="config.mode">
                                    <option value="sandbox">Sandbox (Testing)</option>
                                    <option value="live">Live (Real Money)</option>
                                </select>
                            </div>
                            @endif

                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Sort Order</label>
                                <input type="number" class="form-control" wire:model="sort_order">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Status</label>
                                <select class="form-select" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0 border-0 mt-4">
                            <button type="button" class="btn btn-light rounded-pill" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm me-1"></span>
                                {{ $isEditMode ? 'Update' : 'Create' }} Method
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>