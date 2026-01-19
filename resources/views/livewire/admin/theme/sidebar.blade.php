<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/frontend/images/favicon.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="" height="40">
            </span>
        </a>
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/frontend/images/favicon.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/frontend/images/logo-white.png') }}" alt="" height="40">
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
                                <a href="{{ route('admin.locations.areas') }}" class="nav-link {{ Route::is('admin.locations.areas') ? 'active' : '' }}" data-key="t-areas" wire:navigate> Unions </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.blood.group') }}" class="nav-link menu-link {{ Route::is('admin.blood.group') ? 'active' : '' }}" wire:navigate>
                        <i class="bi bi-droplet-half"></i> <span data-key="t-blood-group">Blood Group</span>
                    </a>
                </li>
                <!-- pricing plans and services -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.pricing.index') || Route::is('admin.service.index') ? 'collapsed active' : '' }}" href="#pricingPlans" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-tags"></i> <span data-key="t-pricing-plans">Pricing Plans</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.pricing.index') || Route::is('admin.service.index') ? 'show' : '' }}" id="pricingPlans">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.pricing.index') }}" class="nav-link {{ Route::is('admin.pricing.index') ? 'active' : '' }}" data-key="t-pricing-plans" wire:navigate> Pricing Plans </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.service.index') }}" class="nav-link {{ Route::is('admin.service.index') ? 'active' : '' }}" data-key="t-services" wire:navigate> Services </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.payment-method.index') }}" class="nav-link menu-link {{ Route::is('admin.payment-method.index') ? 'active' : '' }}" wire:navigate>
                        <i class="bi bi-credit-card"></i> <span data-key="t-payment-method">Payment Method</span>
                    </a>
                </li>

                <!-- hospital management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.hospital.*') ? 'collapsed active' : '' }}" href="#hospitalManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-hospital"></i> <span data-key="t-hospitals">Hospitals</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.hospital.*') ? 'show' : '' }}" id="hospitalManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.hospital.departments') }}" class="nav-link {{ Route::is('admin.hospital.departments') ? 'active' : '' }}" data-key="t-departments" wire:navigate> Departments </a>
                            </li>
                            <!-- test category -->
                            <li class="nav-item">
                                <a href="{{ route('admin.hospital.medical-test.category') }}" class="nav-link {{ Route::is('admin.hospital.medical-test.category') ? 'active' : '' }}" data-key="t-test-category" wire:navigate> Test Category </a>
                            </li>
                            <!-- test -->
                            <li class="nav-item">
                                <a href="{{ route('admin.hospital.medical-test.test') }}" class="nav-link {{ Route::is('admin.hospital.medical-test.test') ? 'active' : '' }}" data-key="t-tests" wire:navigate> Tests </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.hospital.doctors') }}" class="nav-link {{ Route::is('admin.hospital.doctors') ? 'active' : '' }}" data-key="t-doctors" wire:navigate> Doctors </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hospital.hospitals') }}" class="nav-link {{ Route::is('admin.hospital.hospitals') ? 'active' : '' }}" data-key="t-hospitals" wire:navigate> Hospitals </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <!-- diagnostic management -->
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.diagnostic.*') ? 'collapsed active' : '' }}" href="#diagnosticManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-heart-pulse"></i> <span data-key="t-diagnostic">Diagnostic</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.diagnostic.*') ? 'show' : '' }}" id="diagnosticManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.diagnostic.index') }}" class="nav-link {{ Route::is('admin.diagnostic.index') ? 'active' : '' }}" data-key="t-diagnostic-center" wire:navigate> Diagnostic Center </a>
                            </li>

                        </ul>
                    </div>
                </li> -->

                <!-- user management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.user.*') ? 'collapsed active' : '' }}" href="#userManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-person"></i> <span data-key="t-user">User</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.user.*') ? 'show' : '' }}" id="userManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}" data-key="t-users" wire:navigate> User </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.user.role.index') }}" class="nav-link {{ Route::is('admin.user.role.index') ? 'active' : '' }}" data-key="t-roles" wire:navigate> Roles </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <!-- member management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('admin.member.*') ? 'collapsed active' : '' }}" href="#memberManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-people"></i> <span data-key="t-member">Member</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('admin.member.*') ? 'show' : '' }}" id="memberManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.member.index') }}" class="nav-link {{ Route::is('admin.member.index') ? 'active' : '' }}" data-key="t-members" wire:navigate> Members </a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>