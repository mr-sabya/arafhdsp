<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="ri-user-star-line me-1"></i> Staff & Partner Management</h5>
                    <div class="d-flex gap-2">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <span class="input-group-text bg-light border-end-0"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control bg-light border-start-0 shadow-none"
                                wire:model.live.debounce.300ms="search" placeholder="Search by name or mobile...">
                        </div>
                        <a href="{{ route('admin.user.create') }}" wire:navigate class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="ri-add-line"></i> Add New User
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="ps-3">User Info</th>
                                <th>Role</th>
                                <th>Mobile</th>
                                <th>Specific Details</th>
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
                                            class="rounded-circle me-2 border" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <small class="text-muted">UID: #{{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-dark-subtle text-dark border">
                                        {{ $user->role->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    @if($user->role->slug == 'worker')
                                    <span class="badge bg-primary-subtle text-primary">
                                        <i class="ri-team-line me-1"></i> Referrals: {{ $user->referrals()->count() }}
                                    </span>
                                    @elseif($user->role->slug == 'hospital' && $user->hospital)
                                    <a href="#" class="text-decoration-none fw-bold text-info">
                                        <i class="ri-hospital-line me-1"></i> {{ $user->hospital->name }}
                                    </a>
                                    @elseif($user->role->slug == 'diagnostic' && $user->diagnosticCenter)
                                    <span class="fw-bold text-warning">
                                        <i class="ri-microscope-line me-1"></i> {{ $user->diagnosticCenter->name }}
                                    </span>
                                    @else
                                    <span class="text-muted small">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_verified)
                                    <span class="badge bg-success-subtle text-success"><i class="ri-verified-badge-fill me-1"></i> Verified</span>
                                    @else
                                    <span class="badge bg-secondary-subtle text-muted">Unverified</span>
                                    @endif
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group shadow-sm rounded-pill overflow-hidden">
                                        <button wire:click="openModal({{ $user->id }})" class="btn btn-sm btn-white border-end">
                                            <i class="ri-eye-line text-primary"></i>
                                        </button>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" wire:navigate class="btn btn-sm btn-white">
                                            <i class="ri-edit-line text-info"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="{{ asset('assets/admin/images/no-data.png') }}" alt="" style="width: 100px; opacity: 0.5;">
                                    <p class="text-muted mt-2">No users found in this criteria.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0">{{ $users->links() }}</div>
            </div>
        </div>
    </div>

    <!-- User Details Modal (View Only) -->
    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.6); overflow-y: auto;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header p-4 border-bottom bg-light rounded-top-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ $selectedUser->photo ? asset('storage/'.$selectedUser->photo) : asset('assets/frontend/images/default-user.png') }}"
                            class="rounded-circle border border-3 border-white shadow-sm me-3"
                            style="width: 65px; height: 65px; object-fit: cover;">
                        <div>
                            <h5 class="modal-title fw-bold mb-0 text-dark">{{ $selectedUser->name }}</h5>
                            <div class="mt-1">
                                <span class="badge bg-primary">{{ $selectedUser->role->name }}</span>
                                <span class="badge bg-light text-dark border ms-1">ID: #{{ $selectedUser->id }}</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>

                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- Left Side: Basic Info -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3 text-primary border-bottom pb-2">
                                <i class="ri-information-line me-1"></i> Basic Information
                            </h6>
                            <table class="table table-sm table-borderless small">
                                <tr>
                                    <td class="text-muted" width="40%">Father's Name:</td>
                                    <td class="fw-bold">{{ $selectedUser->father_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Mobile:</td>
                                    <td class="fw-bold">{{ $selectedUser->mobile }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email:</td>
                                    <td class="fw-bold">{{ $selectedUser->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">NID Number:</td>
                                    <td class="fw-bold">{{ $selectedUser->nid ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Date of Birth:</td>
                                    <td class="fw-bold">{{ $selectedUser->dob ? $selectedUser->dob->format('d M, Y') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Blood Group:</td>
                                    <td><span class="badge bg-danger">{{ $selectedUser->bloodGroup->name ?? 'N/A' }}</span></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Right Side: Role Specific & Address -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3 text-primary border-bottom pb-2">
                                <i class="ri-map-pin-line me-1"></i> Address & Role Details
                            </h6>
                            <table class="table table-sm table-borderless small mb-3">
                                <tr>
                                    <td class="text-muted" width="40%">Division:</td>
                                    <td class="fw-bold">{{ $selectedUser->division->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">District:</td>
                                    <td class="fw-bold">{{ $selectedUser->district->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Upazila:</td>
                                    <td class="fw-bold">{{ $selectedUser->upazila->name ?? 'N/A' }}</td>
                                </tr>
                            </table>

                            <div class="bg-light p-3 rounded-3 border">
                                <h6 class="fw-bold text-dark small text-uppercase mb-2">Role Performance/Entity</h6>
                                @if($selectedUser->role->slug == 'worker')
                                <div class="d-flex justify-content-between">
                                    <span>Total Referrals:</span>
                                    <span class="fw-bold text-primary">{{ $selectedUser->referrals()->count() }} Members</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span>Referral Code:</span>
                                    <span class="badge bg-dark">{{ $selectedUser->referral_code ?? 'None' }}</span>
                                </div>
                                @elseif($selectedUser->role->slug == 'hospital' && $selectedUser->hospital)
                                <div class="text-center">
                                    <i class="ri-hospital-fill text-info fs-3"></i>
                                    <p class="fw-bold mb-0">{{ $selectedUser->hospital->name }}</p>
                                    <small class="text-muted">Linked Hospital Entity</small>
                                </div>
                                @elseif($selectedUser->role->slug == 'diagnostic' && $selectedUser->diagnosticCenter)
                                <div class="text-center">
                                    <i class="ri-microscope-fill text-warning fs-3"></i>
                                    <p class="fw-bold mb-0">{{ $selectedUser->diagnosticCenter->name }}</p>
                                    <small class="text-muted">Linked Diagnostic Center</small>
                                </div>
                                @else
                                <p class="text-muted small text-center mb-0">No entity linked</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top-0 rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" wire:click="closeModal">Close Window</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>