<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS - @yield('title')</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            overflow-x: hidden;
            padding-top: 56px; /* Navbar height */
        }
        .main-content {
            min-height: calc(100vh - 56px);
            margin-left: 250px; /* Sidebar width */
            transition: margin-left 0.3s ease;
        }
        .top-navbar {
            height: 56px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }
        .sidebar {
            width: 250px;
            height: calc(100vh - 56px);
            position: fixed;
            top: 56px;
            left: 0;
            overflow-y: auto;
            transition: width 0.3s ease;
            z-index: 1020;
            background: linear-gradient(180deg, #007bff, #0056b3); /* Gradient background */
        }
        .sidebar.collapsed {
            width: 70px; /* Collapsed width */
        }
        .sidebar.collapsed .sidebar-text {
            display: none; /* Hide text when collapsed */
        }
        .sidebar.collapsed .sidebar-icon {
            font-size: 1.2rem;
            margin: 0 auto; /* Center icons */
        }
        .main-content.expanded {
            margin-left: 70px; /* Adjusted for collapsed sidebar */
        }
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
                transform: translateX(-250px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .sidebar.collapsed {
                width: 70px;
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .main-content.expanded {
                margin-left: 70px;
            }
        }
        .sidebar-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .nav-link {
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
        }
        .sidebar-toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 10px;
            width: 100%;
            text-align: left;
        }
        .sidebar-toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>
    @auth
    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand top-navbar bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Left side items -->
            <div class="d-flex align-items-center">
                <button class="btn btn-sm me-2 d-lg-none" id="sidebarMobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="navbar-brand fw-bold text-primary">HRMS</span>
            </div>
            
            <!-- Right side items -->
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                            <span class="fw-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    @auth
    <!-- Sidebar -->
    <div class="sidebar bg-primary text-white" id="sidebar">
        <div class="sidebar-content">
            @include('layouts.side')
        </div>
    </div>
    @endauth
    
    <!-- Main Content -->
    <main class="main-content @if(!auth()->check()) expanded @endif" id="mainContent">
        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar for mobile view
        document.getElementById('sidebarMobileToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('mainContent').classList.toggle('expanded');
        });

        // Toggle sidebar collapse
        document.getElementById('sidebarCollapseToggle')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded', sidebar.classList.contains('collapsed'));
        });
    </script>
</body>
</html>