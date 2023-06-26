<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />

    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/styles.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="shortcut icon" href="{{ URL::asset('user-assets/images/assets/dark-kumpisalan-32.png') }}" type="image/x-icon">

    @stack('stylesheets')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('user-assets/images/assets/dark-kumpisalan.png') }}" width="200"
                            alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">GENERAL</span>
                        </li>
                        @auth('admin')
                            @can('view_users_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="/admin/users" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-users"></i>
                                        </span>
                                        <span class="hide-menu">Users</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        @auth('admin')
                            @can('view_representatives_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.representatives.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user-plus"></i>
                                        </span>
                                        <span class="hide-menu">Parish Representatives</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        @auth('admin')
                            @can('view_churches_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.churches.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-building-church"></i>
                                        </span>
                                        <span class="hide-menu">Churches</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        @auth('admin')
                            @can('view_admins_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.admins.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user"></i>
                                        </span>
                                        <span class="hide-menu">Admins</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        @auth('admin')
                            @can('view_roles_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.roles.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user-circle"></i>
                                        </span>
                                        <span class="hide-menu">Roles</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        @auth('admin')
                            @can('view_permissions_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.permissions.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-user-circle"></i>
                                        </span>
                                        <span class="hide-menu">Permissions</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">SUPPORT</span>
                        </li>
                        @auth('admin')
                            @can('view_contact_messages_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.contact_messages.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-mail"></i>
                                        </span>
                                        <span class="hide-menu">Contact Messages</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">LOGS</span>
                        </li>
                        @auth('admin')
                            @can('view_admins_list')
                                <li class="sidebar-item">
                                    <a class="sidebar-link" href="{{ route('admin.logs.list') }}" aria-expanded="false">
                                        <span>
                                            <i class="ti ti-folder"></i>
                                        </span>
                                        <span class="hide-menu">Logs</span>
                                    </a>
                                </li>
                            @endcan
                        @endauth
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header" style="background: #331f14 !important;">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('admin-assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('admin.profile') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="{{ route('admin.logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form method="POST" action="{{ route('admin.logout') }}" id="logout-form" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
           @yield('content')
        </div>
    </div>
    <script src="{{ asset('admin-assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin-assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin-assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('admin-assets/js/dashboard.js') }}"></script>

    {{-- CDNs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEmTK1XpJ2VJuylKczq2-49A6_WuUlfe4&libraries=places&callback=initialize"></script>

    @stack('scripts')

    @if (Session::get('authenticated-but-login'))
        <script>
            toastr.error("{{ Session::get('authenticated-but-login') }}", "Fail");
        </script>
    @endif
</body>

</html>
