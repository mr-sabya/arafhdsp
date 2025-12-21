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

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.html">
                        <i class="bi bi-hdd-stack"></i> <span data-key="t-widgets">Widgets</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="components.html" target="_blank">
                        <i class="bi bi-layers"></i> <span data-key="t-components">Components</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="https://themesbrand.com/hybrix/laravel/docs/index.html"
                        target="_blank">
                        <i class="bi bi-file-earmark-text"></i> <span
                            data-key="t-documentation">Documentation</span> <span
                            class="badge badge-pill bg-secondary" data-key="t-v1.0">v1.0</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-apps">Apps</span></li>

                <li class="nav-item">
                    <a href="apps-calendar.html" class="nav-link menu-link"> <i class="bi bi-calendar3"></i>
                        <span data-key="t-calendar">Calendar</span> </a>
                </li>

                <li class="nav-item">
                    <a href="apps-api-key.html" class="nav-link menu-link"> <i class="bi bi-key"></i> <span
                            data-key="t-api-key">API Key</span> </a>
                </li>

                <li class="nav-item">
                    <a href="apps-contact.html" class="nav-link menu-link"> <i class="bi bi-person-square"></i>
                        <span data-key="t-contact">Contact</span> </a>
                </li>

                <li class="nav-item">
                    <a href="apps-leaderboards.html" class="nav-link menu-link"> <i class="bi bi-gem"></i> <span
                            data-key="t-leaderboard">LeaderBoard</span> </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-layouts">Layouts</span>
                </li>
                <li class="nav-item">
                    <a href="layouts-horizontal.html" class="nav-link menu-link" target="_blank"> <i
                            class="bi bi-window"></i> <span data-key="t-horizontal">Horizontal</span> </a>
                </li>
                <li class="nav-item">
                    <a href="layouts-detached.html" class="nav-link menu-link" target="_blank"> <i
                            class="bi bi-layout-sidebar-inset"></i> <span data-key="t-detached">Detached</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="layouts-two-column.html" class="nav-link menu-link" target="_blank"> <i
                            class="bi bi-layout-three-columns"></i> <span data-key="t-two-column">Two
                            Column</span> </a>
                </li>
                <li class="nav-item">
                    <a href="layouts-vertical-hovered.html" class="nav-link menu-link" target="_blank"> <i
                            class="bi bi-layout-text-sidebar-reverse"></i> <span
                            data-key="t-hovered">Hovered</span> </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="bi bi-share"></i> <span data-key="t-multi-level">Multi Level</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-level-1.1"> Level 1.1 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAccount"
                                    data-key="t-level-1.2"> Level
                                    1.2
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-2.1"> Level 2.1 </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCrm" class="nav-link" data-bs-toggle="collapse"
                                                role="button" aria-expanded="false" aria-controls="sidebarCrm"
                                                data-key="t-level-2.2"> Level 2.2
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-3.1">
                                                            Level 3.1
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-3.2">
                                                            Level 3.2
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
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