<div class="d-flex flex-column flex-shrink-0 p-3 text-white h-100">
    <!-- Toggle Button -->
    <button class="sidebar-toggle-btn mb-3" id="sidebarCollapseToggle">
        <i class="fas fa-arrows-alt-h sidebar-icon"></i>
        <span class="sidebar-text ms-2">Collapse</span>
    </button>

    <!-- Sidebar Header -->
    <a href="{{ route('dashboard') }}"
       class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <span class="fs-4 fw-bold sidebar-text" style="letter-spacing: 1px;">HRMS</span>
    </a>
    <hr class="my-2 border-white opacity-25">

    <!-- Navigation Links -->
    <ul class="nav nav-pills flex-column mb-auto">
        @auth
            <li class="nav-item mb-1">
                <a href="{{ route('dashboard') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('departments.index') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                    <i class="fas fa-building me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Departments</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('job-titles.index') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('jobs.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Jobs</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('employees.index') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <i class="fas fa-users me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Employees</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('payrolls.index') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('payrolls.*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Payrolls</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('attendances.index') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Attendances</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('leaves.index') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('leaves.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-minus me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Leaves</span>
                </a>
            </li>
        @else
            <li class="nav-item mb-1">
                <a href="{{ route('login') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('login') ? 'active' : '' }}">
                    <i class="fas fa-sign-in-alt me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Login</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('register') }}"
                   class="nav-link text-white d-flex align-items-center rounded-pill {{ request()->routeIs('register') ? 'active' : '' }}">
                    <i class="fas fa-user-plus me-2 sidebar-icon"></i>
                    <span class="sidebar-text">Register</span>
                </a>
            </li>
        @endauth
    </ul>

    <!-- Logout Button (Authenticated Users Only) -->
    @auth
    <hr class="my-2 border-white opacity-25">
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="nav-link text-white d-flex align-items-center rounded-pill w-100">
        <i class="fas fa-sign-out-alt me-2 sidebar-icon"></i>
        <span class="sidebar-text">Logout</span>
    </button>
</form>
    @endauth
</div>