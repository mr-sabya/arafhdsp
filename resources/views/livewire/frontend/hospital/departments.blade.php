<div class="container mb-5">
    <h4 class="fw-bold text-secondary mb-4 ps-2 border-start border-4 border-primary">
        {{ app()->getLocale() == 'bn' ? 'বিভাগসমূহ' : 'Departments' }}
    </h4>

    <div class="row g-3">
        @forelse($departments as $dept)
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card dept-card border-0 shadow-sm text-center p-3 h-100">
                <div class="dept-icon-box mx-auto">
                    <i class="{{ $dept->icon }}"></i>
                </div>
                <h6 class="fw-bold">{{ $dept->display_name }}</h6>
            </div>
        </div>
        @empty
        <!-- This section shows if the $departments collection is empty -->
        <div class="col-12">
            <div class="alert alert-light border-0 shadow-sm text-center py-4">
                <i class="fas fa-info-circle text-muted mb-2 d-block fs-4"></i>
                <p class="text-muted mb-0">
                    {{ app()->getLocale() == 'bn' ? 'কোন বিভাগ খুঁজে পাওয়া যায়নি।' : 'No departments found.' }}
                </p>
            </div>
        </div>
        @endforelse
    </div>
</div>