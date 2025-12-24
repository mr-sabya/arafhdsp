<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
            <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link {{Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate>হোম</a></li>
                <li class="nav-item"><a class="nav-link {{Route::is('service') ? 'active' : '' }}" href="{{ route('service') }}" wire:navigate>সেবাসমূহ</a></li>
                <li class="nav-item"><a class="nav-link {{Route::is('diagnostic') ? 'active' : '' }}" href="{{ route('diagnostic') }}" wire:navigate>ডায়াগনস্টিক</a></li>
                <li class="nav-item"><a class="nav-link {{Route::is('hospitals') ? 'active' : '' }}" href="{{ route('hospitals') }}" wire:navigate>হাসপাতাল</a></li>
                <li class="nav-item"><a class="nav-link {{Route::is('about') ? 'active' : '' }}" href="{{ route('about') }}" wire:navigate>আমাদের সম্পর্কে</a></li>
                <li class="nav-item"><a class="nav-link {{Route::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}" wire:navigate>যোগাযোগ</a></li>

                @guest
                <!-- Shown only to logged-out users -->
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn btn-outline-primary rounded-pill px-4 fw-bold" href="{{ route('login') }}" wire:navigate>
                        <i class="fas fa-sign-in-alt me-2"></i>লগইন
                    </a>
                </li>
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" href="{{ route('register') }}" wire:navigate>
                        <i class="fas fa-user-plus me-2"></i>রেজিস্ট্রেশন
                    </a>
                </li>
                @endguest

                @auth
                <!-- Shown only to logged-in users -->
                <li class="nav-item dropdown ms-lg-3 mt-3 mt-lg-0">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-img-nav me-2">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/frontend/images/default-user.png') }}"
                                alt="User" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover; border: 2px solid #0d6efd;">
                        </div>
                        <span class="fw-bold text-dark">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('user.dashboard') }}" wire:navigate>
                                <i class="fas fa-th-large me-2 text-primary"></i> ড্যাশবোর্ড
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="#" wire:navigate>
                                <i class="fas fa-user-cog me-2 text-primary"></i> প্রোফাইল সেটিংস
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <livewire:frontend.theme.logout />
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>