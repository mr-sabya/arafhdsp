<div class="login-page py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10">
                
                <!-- কার্ড ডিজাইন শুরু -->
                <div class="card reg-card border-0 shadow-lg overflow-hidden scale-up">
                    <div class="reg-header text-center p-4">
                        <div class="login-icon-box mx-auto mb-3 bg-white text-primary rounded-circle shadow-sm">
                            <i class="fas fa-user-lock"></i>
                        </div>
                        <h3 class="fw-bold mb-1 text-white">লগইন করুন</h3>
                        <p class="mb-0 text-white-50 small">আপনার ডিজিটাল হেলথ প্রোফাইলে প্রবেশ করুন</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form wire:submit="login">
                            
                            <!-- মোবাইল নম্বর -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark small">মোবাইল নম্বর</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-phone-alt text-primary"></i>
                                    </span>
                                    <input type="tel" wire:model="phone" 
                                        class="form-control border-start-0 ps-0 @error('phone') is-invalid @enderror"
                                        placeholder="017xxxxxxxx" autofocus>
                                </div>
                                @error('phone') <span class="text-danger x-small mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- পাসওয়ার্ড -->
                            <div class="mb-3" x-data="{ show: false }">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-bold text-dark small mb-0">পাসওয়ার্ড</label>
                                    <a href="#" class="x-small text-primary text-decoration-none fw-bold">পাসওয়ার্ড ভুলে গেছেন?</a>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input :type="show ? 'text' : 'password'" wire:model="password" 
                                        class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror"
                                        placeholder="******">
                                    <span class="input-group-text bg-light border-start-0 cursor-pointer" @click="show = !show">
                                        <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </span>
                                </div>
                                @error('password') <span class="text-danger x-small mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- রিমেম্বার মি -->
                            <div class="mb-4 d-flex align-items-center">
                                <div class="form-check custom-checkbox">
                                    <input class="form-check-input" type="checkbox" wire:model="remember" id="rememberMe">
                                    <label class="form-check-label small text-muted cursor-pointer" for="rememberMe">
                                        আমাকে মনে রাখুন
                                    </label>
                                </div>
                            </div>

                            <!-- সাবমিট বাটন -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-register rounded-pill text-white fw-bold py-2 shadow-sm position-relative overflow-hidden">
                                    <span wire:loading.remove wire:target="login">
                                        প্রবেশ করুন <i class="fas fa-sign-in-alt ms-2"></i>
                                    </span>
                                    <span wire:loading wire:target="login">
                                        <span class="spinner-border spinner-border-sm me-2"></span> যাচাই করা হচ্ছে...
                                    </span>
                                </button>
                            </div>

                            <!-- রেজিস্ট্রেশন লিঙ্ক -->
                            <div class="text-center mt-5">
                                <p class="small text-muted mb-2">এখনো সদস্য হননি?</p>
                                <a href="{{ route('register') }}" wire:navigate class="btn btn-outline-primary btn-sm rounded-pill px-4 fw-bold">
                                    নতুন রেজিস্ট্রেশন করুন
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- হোমে ফিরে যান -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" wire:navigate class="text-muted small text-decoration-none hover-link">
                        <i class="fas fa-arrow-left me-1"></i> হোমে ফিরে যান
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
