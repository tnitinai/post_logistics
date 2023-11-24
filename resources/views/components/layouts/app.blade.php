<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    @livewireStyles

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="far fa-paper-plane"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Post Logsitics</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('package') }}">
                <a class="nav-link" href="{{ route('package') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
            {{ __('Settings') }}
        </div> --}}

            <!-- Nav Item - Package Registration -->
            @can('registrator')
                <li class="nav-item {{ Nav::isRoute('package') }}">
                    <a class="nav-link" href={{ route('package') }} wire:navigate>
                        <i class="fas fa-box"></i>
                        <span>{{ __('รับพัสดุ') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Package Display -->
            <li class="nav-item {{ Nav::isRoute('package.all') }}">
                <a class="nav-link" href={{ route('package.all') }} wire:navigate>
                    <i class="fas fa-box"></i>
                    <span>{{ __('ข้อมูลพัสดุ') }}</span>
                </a>
            </li>

            <!-- Nav Item - Create Bag -->
            @can('distributor')
                <li class="nav-item {{ Nav::isRoute('show-bag') }}">
                    <a class="nav-link" href={{ route('show-bag') }} wire:navigate>
                        <i class="fas fa-archive"></i>
                        <span>{{ __('สร้างถุงไปรษณีย์') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Bag Management -->
            @can('distributor')
                <li class="nav-item {{ Nav::isRoute('manage-bag') }}">
                    <a class="nav-link" href={{ route('manage-bag') }} wire:navigate>
                        <i class="fas fa-edit"></i>
                        <span>{{ __('จัดการถุงไปรษณีย์') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Vehicle Management -->
            @can('driver')
                <li class="nav-item {{ Nav::isRoute('manage-vehicle') }}">
                    <a class="nav-link" href={{ route('manage-vehicle') }} wire:navigate>
                        <i class="fas fa-shuttle-van"></i>
                        <span>{{ __('จัดการยานพาหนะ') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Transport Management -->
            @can('driver')
                <li class="nav-item {{ Nav::isRoute('manage-transport') }}">
                    <a class="nav-link" href={{ route('manage-transport') }} wire:navigate>
                        <i class="fas fa-truck"></i>
                        <span>{{ __('จัดการการขนส่ง') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Unpackaing Management -->
            @can('distributor')
                <li class="nav-item {{ Nav::isRoute('unpack-package') }}">
                    <a class="nav-link" href={{ route('unpack-package') }} wire:navigate>
                        <i class="fas fa-dolly"></i>
                        <span>{{ __('คัดแยกถุงไปรษณีย์') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Distribution Management -->
            @can('postman')
                <li class="nav-item {{ Nav::isRoute('manage-distribution') }}">
                    <a class="nav-link" href={{ route('manage-distribution') }} wire:navigate>
                        <i class="fas fa-boxes"></i>
                        <span>{{ __('เตรียมนำจ่ายพัสดุ') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Delivery Management -->
            @can('postman')
                <li class="nav-item {{ Nav::isRoute('manage-delivery') }}">
                    <a class="nav-link" href={{ route('manage-delivery') }} wire:navigate>
                        <i class="fas fa-motorcycle"></i>
                        <span>{{ __('บันทึกการนำจ่าย') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Nav Item - Employee Management -->
            <li class="nav-item {{ Nav::isRoute('manage-employee') }}">
                <a class="nav-link" href={{ route('manage-employee') }} wire:navigate>
                    <i class="fas fa-user"></i>
                    <span>{{ __('จัดการพนักงาน') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <livewire:tracking.find-package />

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" role="button">
                                <span class="mr-2 d-none d-lg-inline">
                                    {{ Auth::user()->role->name }} | ประจำ {{Auth::user()->post_office_id}}</span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small">{{ Auth::user()->fname }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a> --}}
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Settings') }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Activity Log') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}">
                            {{ session('status.message') }}
                        </div>
                    @endif
                    {{ $slot }}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Alejandro RH {{ now()->year }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer --> --}}

            @livewireScripts
        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
