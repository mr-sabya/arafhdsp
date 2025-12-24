<div class="container py-5">
    <!-- Filter & Search Header -->
    <div class="row mb-5 align-items-center g-3">
        <div class="col-lg-4">
            <h4 class="fw-bold text-primary mb-0 ps-2 border-start border-4 border-primary">
                {{ app()->getLocale() == 'bn' ? 'আমাদের বিশেষজ্ঞ ডাক্তারগণ' : 'Our Specialist Doctors' }}
            </h4>
        </div>
        <div class="col-lg-8">
            <div class="row g-2 justify-content-lg-end">
                <!-- Department Filter -->
                <div class="col-md-4">
                    <select wire:model.live="selectedDepartment" class="form-select shadow-none border-primary-subtle">
                        <option value="">{{ app()->getLocale() == 'bn' ? 'সকল বিভাগ' : 'All Departments' }}</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Search Box -->
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-primary-subtle text-primary">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            class="form-control shadow-none border-primary-subtle"
                            placeholder="{{ app()->getLocale() == 'bn' ? 'ডাক্তারের নাম দিয়ে খুঁজুন...' : 'Search by doctor name...' }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Doctors Grid -->
    <div class="row g-4">
        @forelse($doctors as $doctor)
        <div class="col-md-6 col-lg-3" wire:key="doc-{{ $doctor->id }}">
            <div class="doctor-card h-100 border-0 shadow-sm bg-white rounded-4 overflow-hidden position-relative" style="transition: 0.3s;">
                <!-- Discount Badge -->
                @if($doctor->display_badge)
                <div class="discount-badge" style="position: absolute; top: 15px; right: 15px; background: #ff3e3e; color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; z-index: 2;">
                    {{ $doctor->display_badge }}
                </div>
                @endif

                <!-- Doctor Image -->
                <div class="doctor-img-box" style="height: 250px; overflow: hidden;">
                    <img src="{{ $doctor->photo ? asset('storage/'.$doctor->photo) : asset('assets/images/default-doctor.jpg') }}"
                        alt="{{ $doctor->display_name }}"
                        class="w-100 h-100 object-fit-cover">
                </div>

                <div class="p-3 text-center">
                    <h5 class="fw-bold mb-1 text-dark">{{ $doctor->display_name }}</h5>
                    <p class="text-muted small mb-1">{{ $doctor->display_degree }}</p>

                    <span class="badge bg-primary bg-opacity-10 text-primary mb-3 px-3">
                        {{ $doctor->display_designation }}
                    </span>

                    <!-- Fee Display -->
                    <div class="fee-box mb-3">
                        @if($doctor->discount_percentage > 0)
                        <small class="text-muted text-decoration-line-through">৳{{ number_format($doctor->base_fee) }}</small>
                        <span class="fw-bold text-primary ms-1">৳{{ number_format($doctor->discounted_fee) }}</span>
                        @else
                        <span class="fw-bold text-primary">৳{{ number_format($doctor->base_fee) }}</span>
                        @endif
                    </div>

                    <div class="d-grid">
                        <a href="#" class="btn btn-primary rounded-pill btn-sm py-2 fw-bold">
                            {{ app()->getLocale() == 'bn' ? 'সিরিয়াল নিন' : 'Appointment' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State Display -->
        <div class="col-12">
            <div class="alert alert-light border-0 shadow-sm text-center py-5">
                <i class="fas fa-user-md text-muted mb-3 d-block fs-1 opacity-25"></i>
                <p class="text-muted mb-0 fw-bold">
                    {{ app()->getLocale() == 'bn' ? 'দুঃখিত, বর্তমানে কোন ডাক্তার খুঁজে পাওয়া যায়নি।' : 'Sorry, no doctors were found at the moment.' }}
                </p>
                <button wire:click="$set('search', '')" class="btn btn-link btn-sm text-decoration-none mt-2">
                    {{ app()->getLocale() == 'bn' ? 'সার্চ ক্লিয়ার করুন' : 'Clear Search' }}
                </button>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $doctors->links() }}
    </div>
</div>
