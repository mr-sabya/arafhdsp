<div class="container py-5">
    <!-- Filter Section -->
    <div class="row g-3 mb-5 align-items-center">
        <div class="col-lg-4">
            <h4 class="fw-bold text-primary border-start border-4 border-primary ps-3 mb-0">
                {{ app()->getLocale() == 'bn' ? 'ডায়াগনস্টিক সেন্টারসমূহ' : 'Diagnostic Centers' }}
            </h4>
        </div>
        <div class="col-lg-8">
            <div class="row g-2 justify-content-end">
                <div class="col-md-3">
                    <select wire:model.live="division_id" class="form-select shadow-none">
                        <option value="">{{ app()->getLocale() == 'bn' ? 'বিভাগ সিলেক্ট করুন' : 'Select Division' }}</option>
                        @foreach($divisions as $div) <option value="{{ $div->id }}">{{ app()->getLocale() == 'bn' ? $div->name_bn : $div->name_en }}</option> @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select wire:model.live="district_id" class="form-select shadow-none" @disabled(!$division_id)>
                        <option value="">{{ app()->getLocale() == 'bn' ? 'জেলা সিলেক্ট করুন' : 'Select District' }}</option>
                        @foreach($districts as $dis) <option value="{{ $dis->id }}">{{ app()->getLocale() == 'bn' ? $dis->name_bn : $dis->name_en }}</option> @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control shadow-none" placeholder="{{ app()->getLocale() == 'bn' ? 'সেন্টারের নাম খুঁজুন...' : 'Search center name...' }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Centers Grid -->
    <div class="row g-4">
        @forelse($centers as $center)
        <div class="col-md-6 col-lg-4" wire:key="center-{{ $center->id }}">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden diagnostic-card-ui">
                <!-- Image Section -->
                <div class="position-relative">
                    <img src="{{ $center->photo ? asset('storage/'.$center->photo) : url('assets/frontend/images/default-hospital-search.jpg') }}"
                        class="w-100" style="height: 220px; object-fit: cover;" alt="{{ $center->display_name }}">

                    @if($center->display_badge)
                    <div class="discount-badge-new">{{ $center->display_badge }}</div>
                    @endif
                </div>

                <div class="card-body p-4">
                    <!-- Title & Location -->
                    <h5 class="fw-bold text-dark mb-1">{{ $center->display_name }}</h5>
                    <p class="text-muted small mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-1"></i>
                        {{ $center->area ? (app()->getLocale() == 'bn' ? $center->area->bn_name : $center->area->bn_name) . ', ' : '' }}
                        {{ $center->district ? (app()->getLocale() == 'bn' ? $center->district->bn_name : $center->district->bn_name) : '' }}
                    </p>

                    <hr class="opacity-10">

                    <!-- Test List from JSON -->
                    <h6 class="small fw-bold text-secondary mb-2">{{ app()->getLocale() == 'bn' ? 'উপলব্ধ পরীক্ষাসমূহ:' : 'Available Tests:' }}</h6>
                    <ul class="list-unstyled mb-4">
                        @if($center->test_list)
                        @foreach(array_slice($center->test_list, 0, 4) as $test)
                        <li class="small text-muted mb-1"><i class="fas fa-check-circle text-success me-2"></i> {{ $test }}</li>
                        @endforeach
                        @endif
                    </ul>

                    <div class="mt-auto">
                        <a href="tel:{{ $center->phone }}" class="btn btn-outline-primary w-100 rounded-pill">
                            <i class="fas fa-phone-alt me-2"></i> {{ app()->getLocale() == 'bn' ? 'কল করুন' : 'Call Now' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="alert alert-light border-0 shadow-sm py-5">
                <i class="fas fa-search text-muted mb-3 d-block fs-1 opacity-25"></i>
                <p class="text-muted mb-0 fw-bold">
                    {{ app()->getLocale() == 'bn' ? 'দুঃখিত, বর্তমানে কোন সেন্টার খুঁজে পাওয়া যায়নি।' : 'Sorry, no diagnostic centers found at the moment.' }}
                </p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $centers->links() }}
    </div>
</div>