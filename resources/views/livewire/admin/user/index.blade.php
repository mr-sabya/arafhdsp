<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark">User Management</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none"
                                wire:model.live.debounce.300ms="search" placeholder="Search by name, mobile or TrxID...">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3">User Info</th>
                                <th>Mobile</th>
                                <th>Plan</th>
                                <th>Payment</th>
                                <th>Application</th>
                                <th>Verification</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr wire:key="user-{{ $user->id }}">
                                <td class="ps-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user->photo ? asset('storage/'.$user->photo) : asset('assets/frontend/images/default-user.png') }}"
                                            class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <small class="text-muted">ID: #{{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $user->pricingPlan->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                    $p_class = match($user->payment_status) {
                                    'paid' => 'bg-success',
                                    'pending' => 'bg-warning',
                                    default => 'bg-danger'
                                    };
                                    @endphp
                                    <span class="badge {{ $p_class }}-subtle text-{{ str_replace('bg-', '', $p_class) }} text-capitalize">
                                        {{ $user->payment_status }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                    $a_class = match($user->application_status) {
                                    'approved' => 'bg-success',
                                    'pending' => 'bg-info',
                                    'rejected' => 'bg-danger',
                                    default => 'bg-secondary'
                                    };
                                    @endphp
                                    <span class="badge {{ $a_class }}-subtle text-{{ str_replace('bg-', '', $a_class) }} text-capitalize">
                                        {{ $user->application_status }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_verified)
                                    <i class="ri-checkbox-circle-fill text-success fs-5"></i>
                                    @else
                                    <i class="ri-close-circle-fill text-muted fs-5"></i>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    <button wire:click="openModal({{ $user->id }})" class="btn btn-sm btn-primary rounded-pill px-3 shadow-none">
                                        Manage
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No users found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0">{{ $users->links() }}</div>
            </div>
        </div>
    </div>

    <!-- User Details & Status Update Modal -->
    <!-- User Details & Full Info Modal -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.6); overflow-y: auto;">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <!-- Header -->
                <div class="modal-header p-4 border-bottom bg-light rounded-top-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ $selectedUser->photo ? asset('storage/'.$selectedUser->photo) : asset('assets/frontend/images/default-user.png') }}"
                            class="rounded-circle border border-3 border-white shadow-sm me-3"
                            style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h5 class="modal-title fw-bold mb-0">{{ $selectedUser->name }}</h5>
                            <span class="badge bg-primary-subtle text-primary small">User ID: #{{ $selectedUser->id }}</span>
                            @if($selectedUser->is_verified)
                            <span class="badge bg-success-subtle text-success small"><i class="ri-verified-badge-line"></i> Verified</span>
                            @endif
                        </div>
                    </div>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- Column 1: Personal Information -->
                        <div class="col-md-4">
                            <div class="card h-100 border shadow-none rounded-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-primary border-bottom pb-2"><i class="ri-user-line me-1"></i> Personal Info</h6>
                                    <div class="mb-2"><small class="text-muted d-block">Father's Name</small><span class="fw-semibold">{{ $selectedUser->father_name ?? 'N/A' }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">Email Address</small><span class="fw-semibold">{{ $selectedUser->email ?? 'N/A' }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">Mobile</small><span class="fw-semibold">{{ $selectedUser->mobile }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">Date of Birth</small><span class="fw-semibold">{{ $selectedUser->dob ? $selectedUser->dob->format('d M, Y') : 'N/A' }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">NID Number</small><span class="fw-semibold">{{ $selectedUser->nid }}</span></div>
                                    <div class="mb-0"><small class="text-muted d-block">Blood Group</small><span class="badge bg-danger text-white">{{ $selectedUser->bloodGroup->name ?? 'N/A' }}</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Address & Location -->
                        <div class="col-md-4">
                            <div class="card h-100 border shadow-none rounded-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-primary border-bottom pb-2"><i class="ri-map-pin-line me-1"></i> Address Detail</h6>
                                    <div class="mb-2"><small class="text-muted d-block">Division</small><span class="fw-semibold">{{ $selectedUser->division->name ?? 'N/A' }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">District</small><span class="fw-semibold">{{ $selectedUser->district->name ?? 'N/A' }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">Upazila</small><span class="fw-semibold">{{ $selectedUser->upazila->name ?? 'N/A' }}</span></div>
                                    <div class="mb-2"><small class="text-muted d-block">Area / Village</small><span class="fw-semibold">{{ $selectedUser->area->name ?? 'N/A' }}</span></div>
                                    <hr>
                                    <h6 class="fw-bold mb-2 text-primary small text-uppercase">Subscription Details</h6>
                                    <div class="mb-2"><small class="text-muted d-block">Package</small><span class="fw-bold text-success">{{ $selectedUser->pricingPlan->name ?? 'N/A' }}</span></div>
                                    <div class="mb-0"><small class="text-muted d-block">Total Family Members</small><span class="fw-bold">{{ $selectedUser->family_members }} Person</span></div>
                                </div>
                            </div>
                        </div>

                        <!-- Column 3: Payment & Approval (Action) -->
                        <div class="col-md-4">
                            <div class="card h-100 border border-primary-subtle shadow-none rounded-3 bg-primary-subtle bg-opacity-10">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-primary border-bottom pb-2"><i class="ri-bank-card-line me-1"></i> Payment & Actions</h6>

                                    <div class="p-3 bg-white rounded-3 border mb-3">
                                        <div class="d-flex justify-content-between mb-2 small"><span class="text-muted">Transaction ID:</span><span class="fw-bold text-dark">{{ $selectedUser->transaction_id ?? 'N/A' }}</span></div>
                                        <div class="d-flex justify-content-between mb-2 small"><span class="text-muted">Method:</span><span class="fw-bold text-uppercase">{{ $selectedUser->payment_method ?? 'N/A' }}</span></div>
                                        <div class="d-flex justify-content-between small"><span class="text-muted">Total Amount:</span><span class="fw-bold text-primary">৳{{ number_format($selectedUser->total_price, 2) }}</span></div>
                                    </div>

                                    <form wire:submit.prevent="updateStatus">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Payment Status</label>
                                            <select class="form-select form-select-sm" wire:model="payment_status">
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid (Verified)</option>
                                                <option value="failed">Failed / Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Application Status</label>
                                            <select class="form-select form-select-sm" wire:model="application_status">
                                                <option value="pending">Under Review</option>
                                                <option value="approved">Approved / Active</option>
                                                <option value="rejected">Rejected</option>
                                            </select>
                                        </div>

                                        <div class="d-grid mt-4">
                                            <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold shadow">
                                                <i class="ri-save-line me-1"></i> Update User Status
                                            </button>
                                        </div>
                                    </form>

                                    @if($selectedUser->last_payment_date)
                                    <div class="mt-3 text-center">
                                        <small class="text-muted">Last Updated: {{ $selectedUser->last_payment_date->format('d M Y, h:i A') }}</small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top-0 rounded-bottom-4 py-3 px-4">
                    <div class="me-auto">
                        <small class="text-muted">Registered at: {{ $selectedUser->created_at->format('d/m/Y h:i A') }}</small>
                    </div>
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" wire:click="closeModal">Close Details</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>