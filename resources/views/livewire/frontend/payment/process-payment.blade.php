<div class="container py-5">
    <div class="row justify-content-center">
        <!-- বাম পাশে সামারি -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-dark text-white py-3 rounded-top-4">
                    <h5 class="mb-0 text-center">পেমেন্ট সামারি</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>প্যাকেজ:</span>
                            <strong>{{ $user->pricingPlan->name }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>লেভেল:</span>
                            <span class="badge bg-info text-dark">{{ $user->package_level }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>সদস্য সংখ্যা:</span>
                            <strong>{{ $user->family_members }} জন</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between fs-5 text-primary">
                            <span>মোট টাকা:</span>
                            <strong>৳ {{ number_format($user->total_price, 2) }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ডান পাশে পেমেন্ট গেটওয়ে -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4 text-center">পেমেন্ট মেথড সিলেক্ট করুন</h4>

                    <!-- পেমেন্ট আইকনসমূহ -->
                    <div class="row g-3 mb-4">
                        @foreach($paymentMethods as $method)
                        <div class="col-6 col-sm-4 col-md-3">
                            <div wire:click="selectMethod({{ $method->id }})"
                                class="payment-card {{ $selectedMethod && $selectedMethod->id == $method->id ? 'active' : '' }}">
                                <img src="{{ $method->qr_image_url ?? asset('images/gateway-icon.png') }}" alt="{{ $method->name }}" class="img-fluid mb-2">
                                <span class="small fw-bold">{{ $method->name }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($selectedMethod)
                    <div class="instruction-box p-3 mb-4 rounded-3 bg-light border-start border-4 border-primary">
                        <h6 class="fw-bold text-primary mb-2">কিভাবে পেমেন্ট করবেন?</h6>
                        <p class="small text-muted mb-1">{{ $selectedMethod->instruction }}</p>
                        <p class="mb-0">আমাদের নাম্বার: <strong>{{ $selectedMethod->account_number }}</strong></p>
                    </div>

                    <form wire:submit.prevent="submitPayment">
                        <div class="mb-3">
                            <label class="form-label fw-bold">আপনার ট্রানজেকশন আইডি (TrxID)</label>
                            <input type="text" wire:model="transactionId" class="form-control form-control-lg" placeholder="যেমন: 8N7A6S5D4F" required>
                            @error('transactionId') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold rounded-3">
                                পেমেন্ট সম্পন্ন করুন
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-warning text-center">
                        অনুগ্রহ করে একটি পেমেন্ট মাধ্যম বেছে নিন।
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
