<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">মোবাইল নম্বর যাচাই করুন</h4>
                </div>
                <div class="card-body p-4 text-center">
                    <p>আপনার <strong>{{ $mobile }}</strong> নম্বরে একটি ওটিপি পাঠানো হয়েছে।</p>

                    @if($display_otp)
                    <div class="alert alert-warning">
                        <strong>ডেভেলপমেন্ট মোড:</strong> আপনার ওটিপি হলো: <span class="badge bg-danger fs-5">{{ $display_otp }}</span>
                    </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form wire:submit.prevent="verify">
                        <div class="mb-4">
                            <label class="form-label">৪ ডিজিট ওটিপি লিখুন</label>
                            <input type="text" wire:model="otp_input" class="form-control form-control-lg text-center fw-bold" maxlength="4" placeholder="0 0 0 0" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                ভেরিফাই করুন
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <p class="small text-muted">কোড পাননি? <a href="#" class="text-decoration-none">আবার পাঠান</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>