<div class="">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">আমার রেফারেল সদস্যগণ</h4>
        <a href="{{ route('worker.user.create') }}" wire:navigate class="btn btn-primary rounded-pill">
            <i class="fas fa-plus-circle me-1"></i> নতুন সদস্য যোগ করুন
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <input type="text" wire:model.live="search" class="form-control" placeholder="নাম বা মোবাইল নম্বর দিয়ে খুঁজুন...">
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>সদস্য</th>
                            <th>মোবাইল</th>
                            <th>প্যাকেজ</th>
                            <th>আবেদন স্ট্যাটাস</th>
                            <th>পেমেন্ট</th>
                            <th>নিবন্ধন তারিখ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($user->photo)
                                    <img src="{{ asset('storage/'.$user->photo) }}" class="rounded-circle me-2" width="35" height="35">
                                    @else
                                    <div class="bg-secondary text-white rounded-circle me-2 d-flex align-items-center justify-content-center" style="width:35px; height:35px">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    @endif
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->package_level }}</td>
                            <td>
                                <span class="badge bg-{{ $user->application_status == 'approved' ? 'success' : ($user->application_status == 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($user->application_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->payment_status == 'paid' ? 'success' : 'danger' }}">
                                    {{ ucfirst($user->payment_status) }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('d M, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">কোন সদস্য পাওয়া যায়নি।</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>