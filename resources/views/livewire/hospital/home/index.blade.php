<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="ri-hospital-line fs-2"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bold text-white">{{ $hospital->name_bn ?? 'Hospital Dashboard' }}</h3>
                            <p class="mb-0 opacity-75">Welcome back! Here is what's happening today.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold">Total Members</span>
                            <h2 class="mb-0 fw-bold">{{ $stats['total_members'] }}</h2>
                        </div>
                        <div class="bg-light-primary text-primary rounded p-2" style="height: fit-content;">
                            <i class="ri-group-line fs-3"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold">Active Patients</span>
                            <h2 class="mb-0 fw-bold text-success">{{ $stats['active_members'] }}</h2>
                        </div>
                        <div class="bg-light-success text-success rounded p-2" style="height: fit-content;">
                            <i class="ri-checkbox-circle-line fs-3"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $stats['total_members'] > 0 ? ($stats['active_members']/$stats['total_members'])*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold">Pending Approval</span>
                            <h2 class="mb-0 fw-bold text-warning">{{ $stats['pending_verifications'] }}</h2>
                        </div>
                        <div class="bg-light-warning text-warning rounded p-2" style="height: fit-content;">
                            <i class="ri-time-line fs-3"></i>
                        </div>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $stats['total_members'] > 0 ? ($stats['pending_verifications']/$stats['total_members'])*100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Patients Table -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Recently Registered Members</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Member Name</th>
                                    <th>Blood Group</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th class="text-end pe-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_patients'] as $patient)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <span class="small fw-bold">{{ substr($patient->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="fw-bold mb-0" style="font-size: 0.9rem;">{{ $patient->name }}</div>
                                                <div class="text-muted x-small">{{ $patient->mobile }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-soft text-danger">{{ $patient->bloodGroup->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @if($patient->application_status == 'approved')
                                        <span class="badge rounded-pill bg-success-soft text-success">Approved</span>
                                        @else
                                        <span class="badge rounded-pill bg-warning-soft text-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="small text-muted">
                                        {{ $patient->created_at->diffForHumans() }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-light rounded-circle"><i class="ri-eye-line"></i></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No members found for this hospital.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hospital Info Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Hospital Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Location</span>
                            <span class="fw-bold small">{{ $hospital->district->name ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Contact</span>
                            <span class="fw-bold small">{{ $hospital->phone ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Total Doctors</span>
                            <span class="badge bg-primary rounded-pill">View List</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm bg-dark text-white">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-sm"><i class="ri-add-line"></i> Add New Record</button>
                        <button class="btn btn-outline-light btn-sm"><i class="ri-printer-line"></i> Daily Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>