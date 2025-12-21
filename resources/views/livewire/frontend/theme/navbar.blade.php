<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="index.html">
            <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- 'align-items-center' added for vertical alignment -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}" wire:navigate>হোম</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('service') }}" wire:navigate>সেবাসমূহ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('diagnostic') }}" wire:navigate>ডায়াগনস্টিক</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('hospitals') }}" wire:navigate>হাসপাতাল</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}" wire:navigate>আমাদের সম্পর্কে</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}" wire:navigate>যোগাযোগ</a></li>

                <!-- New Register Button with Design -->
                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <a class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold" href="register.html">
                        <i class="fas fa-user-plus me-2"></i>রেজিস্ট্রেশন
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>