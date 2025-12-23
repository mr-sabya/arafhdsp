@extends('frontend.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Changed to col-lg-5 for a more compact login look -->
        <div class="col-lg-5 col-md-8">
            <div class="card reg-card shadow-sm border-0">
                <div class="reg-header text-center">
                    <h2 class="fw-bold mb-2">লগইন করুন</h2>
                    <p class="mb-0 opacity-75">আপনার একাউন্টে প্রবেশ করতে তথ্য দিন</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">মোবাইল নম্বর</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-phone-alt text-primary"></i>
                                </span>
                                <input type="tel" name="phone" class="form-control border-start-0 ps-0"
                                    placeholder="017xxxxxxxx" required autofocus>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label class="form-label fw-bold">পাসওয়ার্ড</label>
                                <a href="#" class="small text-primary text-decoration-none">পাসওয়ার্ড ভুলে গেছেন?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" name="password" class="form-control border-start-0 ps-0"
                                    placeholder="******" required>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label small text-muted" for="rememberMe">
                                    আমাকে মনে রাখুন
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-register rounded-pill text-white fw-bold py-2">
                                প্রবেশ করুন <i class="fas fa-sign-in-alt ms-2"></i>
                            </button>
                        </div>

                        <!-- Registration Link -->
                        <div class="text-center mt-4">
                            <p class="small text-muted mb-0">এখনো সদস্য হননি?</p>
                            <a href="{{ route('register') }}" wire:navigate class="text-primary fw-bold text-decoration-none">
                                নতুন সদস্য হিসেবে আবেদন করুন
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Optional Back to Home Link -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" wire:navigate class="text-muted small text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> হোমে ফিরে যান
                </a>
            </div>
        </div>
    </div>
</div>
@endsection