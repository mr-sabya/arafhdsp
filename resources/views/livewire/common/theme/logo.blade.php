<div class="navbar-brand-box horizontal-logo">
    <a href="{{ $url }}" wire:navigate class="logo logo-dark">
        <span class="logo-sm">
            <img src="{{ asset('assets/frontend/images/favicon.png') }}" alt="Favicon" height="22">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="Logo Dark" height="25">
        </span>
    </a>

    <a href="{{ $url }}" wire:navigate class="logo logo-light">
        <span class="logo-sm">
            <img src="{{ asset('assets/frontend/images/favicon.png') }}" alt="Favicon" height="22">
        </span>
        <span class="logo-lg">
            <img src="{{ asset('assets/frontend/images/logo-white.png') }}" alt="Logo Light" height="25">
        </span>
    </a>
</div>