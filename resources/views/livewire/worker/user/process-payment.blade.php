<div class="container-fluid py-4">
    <div class="row">
        <!-- Summary Card -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-file-invoice-dollar me-2"></i> পেমেন্ট সামারি</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-sm mx-auto mb-3">
                            <span class="btn btn-soft-primary rounded-circle fw-bold">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <h6 class="mb-0">{{ $user->name }}</h6>
                        <small class="text-muted">{{ $user->mobile }}</small>
                    </div>
                    <ul class="list-group list-group-flush border-top">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>প্যাকেজ:</span>
                            <strong>{{ $user->pricingPlan->name }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>সদস্য সংখ্যা:</span>
                            <strong>{{ $user->family_members }} জন</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 text-primary fw-bold fs-5">
                            <span>মোট ফি:</span>
                            <span>৳ {{ number_format($user->total_price) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Payment Input Card -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-center">পেমেন্ট মেথড ও ট্রানজেকশন</h5>

                    <div class="row g-3 mb-4 justify-content-center">
                        @foreach($paymentMethods as $method)
                        <div class="col-4 col-md-2">
                            <div wire:click="selectMethod({{ $method->id }})"
                                class="card text-center p-2 cursor-pointer border-2 transition-all {{ $selectedMethod && $selectedMethod->id == $method->id ? 'border-primary bg-light-primary' : 'border-light' }}"
                                style="cursor: pointer;">
                                <img src="{{ $method->qr_image_url ?? asset('images/gateway-icon.png') }}" class="img-fluid rounded mb-1" alt="{{ $method->name }}">
                                <span class="small d-block fw-bold" style="font-size: 10px;">{{ $method->name }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($selectedMethod)
                    <div class="bg-light p-3 rounded mb-4 border-start border-4 border-primary">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="fw-bold text-primary mb-1">{{ $selectedMethod->name }} অ্যাকাউন্ট</h6>
                                <p class="mb-0 small">পেমেন্ট গ্রহণ করার নাম্বার: <strong>{{ $selectedMethod->account_number }}</strong></p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <span class="badge bg-primary px-3 py-2">{{ strtoupper($selectedMethod->type ?? 'Personal') }}</span>
                            </div>
                        </div>
                    </div>

                    <form wire:submit.prevent="submitPayment">
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">ট্রানজেকশন আইডি (TrxID) দিন <span class="text-danger">*</span></label>
                            <input type="text" wire:model="transactionId" class="form-control form-control-lg border-2" placeholder="যেমন: 9J7K5L3M1" required>
                            @error('transactionId') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow">
                                <span wire:loading class="spinner-border spinner-border-sm me-2"></span>
                                সদস্য পেমেন্ট কনফার্ম করুন
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-hand-pointer fa-3x text-light mb-3"></i>
                        <p class="text-muted">দয়া করে ওপর থেকে একটি পেমেন্ট মেথড সিলেক্ট করুন</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

