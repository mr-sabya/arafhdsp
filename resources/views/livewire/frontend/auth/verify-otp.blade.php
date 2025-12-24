<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold">মোবাইল নম্বর যাচাই করুন</h4>
                </div>
                <div class="card-body p-5 text-center">
                    <p class="text-muted">আপনার <strong>{{ $mobile }}</strong> নম্বরে একটি ওটিপি পাঠানো হয়েছে।</p>

                    @if($display_otp)
                    <div class="alert alert-soft-warning border-warning-subtle mb-4">
                        <small class="d-block text-uppercase fw-bold text-muted mb-1">ডেভেলপমেন্ট মোড:</small>
                        আপনার ওটিপি হলো: <span class="badge bg-danger fs-6">{{ $display_otp }}</span>
                    </div>
                    @endif

                    @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form wire:submit.prevent="verify">
                        <div class="mb-4">
                            <label class="form-label d-block mb-3 text-secondary">৪ ডিজিট ওটিপি লিখুন</label>
                            
                            <!-- OTP Input Group -->
                            <div class="otp-wrapper d-flex justify-content-center gap-2 mb-4" id="otp-group">
                                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-box" maxlength="1" inputmode="numeric" required>
                            </div>

                            <!-- Hidden field to sync with Livewire -->
                            <input type="hidden" id="otp_input" wire:model="otp_input">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm py-3 fw-bold">
                                ভেরিফাই করুন
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <p class="small text-muted">
                            কোড পাননি? 
                            <a href="#" class="text-decoration-none fw-bold text-primary">আবার পাঠান</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('#otp-group input');
    const hiddenInput = document.getElementById('otp_input');

    inputs.forEach((input, index) => {
        // Handle Typing
        input.addEventListener('input', (e) => {
            if (e.target.value.length > 1) {
                e.target.value = e.target.value.slice(-1);
            }
            if (e.target.value !== "" && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateLivewire();
        });

        // Handle Backspace
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && e.target.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function updateLivewire() {
        let otpValue = "";
        inputs.forEach(input => otpValue += input.value);
        hiddenInput.value = otpValue;
        // Trigger Livewire sync
        hiddenInput.dispatchEvent(new Event('input'));
    }
});
</script>