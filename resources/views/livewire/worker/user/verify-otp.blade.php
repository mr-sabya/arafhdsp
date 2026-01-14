<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-mobile-alt me-2"></i> মোবাইল নম্বর যাচাই (অফিসিয়াল)</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mb-4">
                        <p class="text-muted mb-1">সদস্যের নাম: <strong>{{ $user->name }}</strong></p>
                        <p class="text-muted">মোবাইল নম্বর: <strong>{{ $user->mobile }}</strong></p>
                        <!-- for developer mode show otp -->
                          
                    </div>

                    <!-- Development Mode OTP Display -->
                    <div class="alert alert-soft-info border-info mb-4">
                        সদস্যের ফোনে পাঠানো ওটিপি (OTP): <span class="badge bg-danger fs-6">{{ $user->otp }}</span>
                    </div>

                    @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form wire:submit.prevent="verify">
                        <div class="mb-4">
                            <label class="form-label d-block mb-3">৪ ডিজিট ওটিপি লিখুন</label>
                            <div class="otp-wrapper d-flex justify-content-center gap-2" id="otp-group">
                                <input type="text" class="form-control otp-box text-center fw-bold fs-4" style="width: 50px; height: 60px;" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="form-control otp-box text-center fw-bold fs-4" style="width: 50px; height: 60px;" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="form-control otp-box text-center fw-bold fs-4" style="width: 50px; height: 60px;" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="form-control otp-box text-center fw-bold fs-4" style="width: 50px; height: 60px;" maxlength="1" inputmode="numeric" required>
                            </div>
                            <input type="hidden" id="otp_input" wire:model="otp_input">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                <span wire:loading class="spinner-border spinner-border-sm me-2"></span>
                                ভেরিফাই সম্পন্ন করুন
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:navigated', () => {
        const inputs = document.querySelectorAll('#otp-group input');
        const hiddenInput = document.getElementById('otp_input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length > 1) e.target.value = e.target.value.slice(-1);
                if (e.target.value !== "" && index < inputs.length - 1) inputs[index + 1].focus();
                updateLivewire();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value === "" && index > 0) inputs[index - 1].focus();
            });
        });

        function updateLivewire() {
            let otpValue = "";
            inputs.forEach(input => otpValue += input.value);
            hiddenInput.value = otpValue;
            hiddenInput.dispatchEvent(new Event('input'));
        }
    });
</script>