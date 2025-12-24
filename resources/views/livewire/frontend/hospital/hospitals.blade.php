<div class="container py-5">
    <!-- Header & Search -->
    <div class="row mb-5 align-items-center g-3">
        <div class="col-md-6">
            <h4 class="fw-bold text-success mb-0 ps-2 border-start border-4 border-success">
                {{ app()->getLocale() == 'bn' ? 'পার্টনার হাসপাতালসমূহ' : 'Partner Hospitals' }}
            </h4>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-white border-success-subtle text-success">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" wire:model.live.debounce.300ms="search"
                    class="form-control shadow-none border-success-subtle"
                    placeholder="{{ app()->getLocale() == 'bn' ? 'হাসপাতালের নাম বা এলাকা দিয়ে খুঁজুন...' : 'Search by hospital name or location...' }}">
            </div>
        </div>
    </div>

    <!-- Hospitals Grid -->
    <div class="row g-4">
        @forelse($hospitals as $hospital)
        <div class="col-md-6" wire:key="hosp-{{ $hospital->id }}">
            <div class="hospital-card d-flex flex-column flex-md-row align-items-center p-3 h-100 shadow-sm border rounded-4 bg-white" style="transition: 0.3s;">
                <!-- Hospital Image -->
                <div class="flex-shrink-0">
                    <img src="{{ $hospital->photo ? asset('storage/'.$hospital->photo) : asset('assets/frontend/images/demo-hospital.png') }}"
                        class="rounded-3 mb-3 mb-md-0 me-md-4"
                        style="width: 130px; height: 130px; object-fit: cover;"
                        alt="{{ $hospital->display_name }}">
                </div>

                <!-- Content -->
                <div class="flex-grow-1 text-center text-md-start">
                    <h5 class="fw-bold mb-1 text-dark">{{ $hospital->display_name }}</h5>

                    <p class="text-muted small mb-1 d-flex align-items-start gap-2">
                        <i class="fas fa-map-marker-alt me-1 text-success mt-1"></i>
                    <span class="text"> {{ $hospital->display_address }}<br>

                        {{-- এরিয়া থাকলে দেখাবে এবং ডিস্ট্রিক্ট থাকলে কমা দিবে --}}
                        {{ $hospital->area ? $hospital->area->bn_name . ($hospital->district ? ', ' : '') : '' }}

                        {{-- ডিস্ট্রিক্ট থাকলে দেখাবে --}}
                        {{ $hospital->district->bn_name ?? '' }}
                    </span>
                    </p>

                    @if($hospital->phone)
                    <p class="text-muted small mb-2 d-flex align-items-start gap-2">
                        <i class="fas fa-phone-alt me-1 text-success mt-1"></i> {{ $hospital->phone }}
                    </p>
                    @endif

                    <!-- Benefits Badges (Looping through JSON array) -->
                    <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                        @if($hospital->benefits)
                        @foreach($hospital->benefits as $benefit)
                        <span class="badge {{ $benefit['class'] ?? 'bg-success bg-opacity-10 text-success' }} rounded-pill px-3 py-2 border-0">
                            {{ app()->getLocale() == 'bn' ? ($benefit['text_bn'] ?? '') : ($benefit['text_en'] ?? '') }}
                        </span>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="ms-md-3 mt-3 mt-md-0">
                    <a href="#" class="btn btn-outline-success btn-sm rounded-pill px-4">
                        {{ app()->getLocale() == 'bn' ? 'বিস্তারিত' : 'Details' }}
                    </a>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="col-12">
            <div class="alert alert-light border-0 shadow-sm text-center py-5">
                <i class="fas fa-hospital-alt text-muted mb-3 d-block fs-1 opacity-25"></i>
                <p class="text-muted mb-0 fw-bold">
                    {{ app()->getLocale() == 'bn' ? 'দুঃখিত, বর্তমানে কোন পার্টনার হাসপাতাল খুঁজে পাওয়া যায়নি।' : 'Sorry, no partner hospitals found at the moment.' }}
                </p>
                @if($search)
                <button wire:click="$set('search', '')" class="btn btn-link btn-sm text-success text-decoration-none mt-2">
                    {{ app()->getLocale() == 'bn' ? 'সার্চ রিসেট করুন' : 'Reset Search' }}
                </button>
                @endif
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination links -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $hospitals->links() }}
    </div>
</div>