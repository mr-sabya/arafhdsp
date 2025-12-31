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
                    <a href="{{ route('worker.dashboard') }}" class="nav-link menu-link {{ Route::is('worker.dashboard') ? 'active' : '' }}" wire:navigate>
                        <i class="bi bi-speedometer2"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                <!-- user management -->
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Route::is('worker.user.*') ? 'collapsed active' : '' }}" href="#userManage" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="bi bi-person"></i> <span data-key="t-user">User</span>
                    </a>
                    <div class="collapse menu-dropdown {{ Route::is('worker.user.*') ? 'show' : '' }}" id="userManage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('worker.user.index') }}" class="nav-link {{ Route::is('worker.user.index') ? 'active' : '' }}" data-key="t-users" wire:navigate> Users </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('worker.user.create') }}" class="nav-link {{ Route::is('worker.user.create') ? 'active' : '' }}" data-key="t-add-new-user" wire:navigate> Add New User </a>
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