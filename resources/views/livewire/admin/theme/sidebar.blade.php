<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ url('assets/backend/images/logo-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ url('assets/backend/images/logo-dark.png') }}" alt="" height="26">
            </span>
        </a>
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ url('assets/backend/images/logo-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ url('assets/backend/images/logo-light.png') }}" alt="" height="26">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link menu-link {{ Route::is('admin.dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="bi bi-speedometer2"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>



                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.website.*') ? 'collapsed active' : '' }}" href="#websiteManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-journal-medical"></i> <span data-key="t-webiste">Website</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.website.*') ? 'show' : '' }}" id="websiteManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.website.hero-banner.index') }}" class="nav-link {{ Route::is('admin.website.hero-banner.index') ? 'active' : '' }}" data-key="t-hero-banner" wire:navigate> Hero Banner </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.website.service-section.index') }}" class="nav-link {{ Route::is('admin.website.service-section.index') ? 'active' : '' }}" data-key="t-service-section" wire:navigate> Service Section </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.website.service.index') }}" class="nav-link {{ Route::is('admin.website.service.index') ? 'active' : '' }}" data-key="t-services" wire:navigate> Services </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.website.skill.index') }}" class="nav-link {{ Route::is('admin.website.skill.index') ? 'active' : '' }}" data-key="t-skills" wire:navigate> Skills </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- Location Management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.locations.*') ? 'collapsed active' : '' }}" href="#locationManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-geo-alt"></i> <span data-key="t-locations">Locations</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.locations.*') ? 'show' : '' }}" id="locationManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.locations.divisions') }}" class="nav-link {{ Route::is('admin.locations.divisions') ? 'active' : '' }}" data-key="t-divisions" wire:navigate> Divisions </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.locations.districts') }}" class="nav-link {{ Route::is('admin.locations.districts') ? 'active' : '' }}" data-key="t-districts" wire:navigate> Districts </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.locations.upazilas') }}" class="nav-link {{ Route::is('admin.locations.upazilas') ? 'active' : '' }}" data-key="t-upazilas" wire:navigate> Upazilas </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.locations.areas') }}" class="nav-link {{ Route::is('admin.locations.areas') ? 'active' : '' }}" data-key="t-areas" wire:navigate> Cities/Villages </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.blood.group') }}" class="nav-link menu-link {{ Route::is('admin.blood.group') ? 'active' : '' }}" wire:navigate>
                        <i class="bi bi-droplet-half"></i> <span data-key="t-blood-group">Blood Group</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>