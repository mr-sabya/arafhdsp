<div class="row">
    <div class="col-xl-12">
        <div class="d-flex align-items-lg-center flex-column flex-lg-row mb-4 gap-3">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">Financial & Membership Overview</h4>
            </div>
            <div class="text-muted">
                {{ now()->format('D, d M Y') }}
            </div>
        </div>

        <div class="row">
            <!-- Total Earnings -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate border-start border-success border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-2">Total Earnings</p>
                                <h4 class="fs-22 fw-bold mb-0">৳{{ number_format($totalEarnings, 2) }}</h4>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded-circle fs-2">
                                    <i class="bx bx-wallet text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Amount (Critical Metric) -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate border-start border-danger border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-2">Pending Collection</p>
                                <h4 class="fs-22 fw-bold text-danger mb-0">৳{{ number_format($pendingAmount, 2) }}</h4>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger-subtle rounded-circle fs-2">
                                    <i class="bx bx-timer text-danger"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Members -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate border-start border-primary border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-2">Active Members</p>
                                <h4 class="fs-22 fw-bold mb-0">{{ $activeMembers }}</h4>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded-circle fs-2">
                                    <i class="bx bx-user-check text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Approvals -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate border-start border-warning border-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-uppercase fw-medium text-muted mb-2">Pending Approvals</p>
                                <h4 class="fs-22 fw-bold mb-0">{{ $pendingApprovals }}</h4>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle rounded-circle fs-2">
                                    <i class="bx bx-hourglass text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Revenue vs Pending Chart -->
            <div class="col-xl-8">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Revenue vs Pending (Last 6 Months)</h4>
                    </div>
                    <div class="card-body">
                        <div id="financial_overview_chart" style="height: 350px;"></div>
                    </div>
                </div>
            </div>

            <!-- Hospital Partners -->
            <div class="col-xl-4">
                <div class="card card-height-100">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Top Medical Partners</h4>
                        <a href="#" class="btn btn-soft-primary btn-sm">View All</a>
                    </div>
                    <div class="card-body">
                        @foreach($topHospitals as $hospital)
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <div class="avatar-title bg-light rounded text-primary">
                                    <i class="bx bxs-institution"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $hospital->display_name }}</h6>
                                <p class="text-muted mb-0 fs-12">{{ $hospital->doctors_count }} Doctors</p>
                            </div>
                            <span class="badge bg-success-subtle text-success">Verified</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions/Registrations -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Recent Transactions</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-nowrap mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th>Member</th>
                                        <th>Pricing Plan</th>
                                        <th>Total Fee</th>
                                        <th>Payment Status</th>
                                        <th>App Status</th>
                                        <th>Last Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->photo ? url('storage/'.$user->photo) : url('assets/backend/images/users/avatar-dummy.png') }}" class="avatar-xs rounded-circle me-2">
                                                <div>
                                                    <h6 class="mb-0 fs-14">{{ $user->name }}</h6>
                                                    <p class="text-muted mb-0 fs-11">{{ $user->mobile }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->pricingPlan->name ?? 'N/A' }}</td>
                                        <td class="fw-medium">৳{{ number_format($user->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $user->payment_status == 'paid' ? 'bg-success text-white' : 'bg-danger-subtle text-danger' }}">
                                                <i class="ri-checkbox-circle-line align-middle me-1"></i> {{ strtoupper($user->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                            $statusClass = [
                                            'approved' => 'bg-info',
                                            'pending' => 'bg-warning',
                                            'rejected' => 'bg-danger'
                                            ][$user->application_status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ ucfirst($user->application_status) }}</span>
                                        </td>
                                        <td>{{ $user->created_at->format('d M, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:navigated', () => {
        var options = {
            series: [{
                name: 'Paid Revenue',
                data: @json($chartPaid)
            }, {
                name: 'Pending Amount',
                data: @json($chartPending)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($chartMonths),
            },
            yaxis: {
                title: {
                    text: '৳ (Amount)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "৳ " + val
                    }
                }
            },
            colors: ['#0ab39c', '#f06548'] // Success Green and Danger Red
        };

        var chart = new ApexCharts(document.querySelector("#financial_overview_chart"), options);
        chart.render();
    });
</script>
@endpush