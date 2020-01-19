<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Defect LOOKER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('meta')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet'>
    @stack('ui')
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Rubik', sans-serif;">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light mb-2">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link text-dark" data-toggle="dropdown" href="#">{{ ucfirst(session('full_name')) }}</a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 180px; max-width: 220px;">
                        <a href="#" class="dropdown-item text-center">
                            <img class="img-circle img-bordered img-fluid" src="/images/{{ session()->get('userImage') }}">
                        </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-lock mr-2"></i> Change Password
                        </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                        </a>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('dashboard') }}" class="brand-link mt-1 ml-1">
            <img src="{{ asset('dist/img/buglogo.jpg') }}" alt="Defect LOOKER Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Defect Looker</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2 ml-1">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{ (Route::is(['build', 'employee', 'project'])) ? 'menu-open' : '' }} {{ (session('grpid') === 1) ? '' : 'd-none' }}">
                        <a href="#" class="nav-link {{ (Route::is(['build', 'employee', 'project'])) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Setup
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{  route('build') }}" class="nav-link {{ (Route::is('build')) ? 'active' : '' }}">
                                    <i class="fab fa-simplybuilt nav-icon"></i>
                                    <p>Builds</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{  route('project') }}" class="nav-link {{ (Route::is('project')) ? 'active' : '' }}">
                                    <i class="fab fa-product-hunt nav-icon"></i>
                                    <p>Projects</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{  route('employee') }}" class="nav-link {{ (Route::is('employee')) ? 'active' : '' }}">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Employees</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ (Route::is(['tasks', 'tasks-create'])) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (Route::is(['tasks', 'tasks-create'])) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Task
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{  route('tasks') }}" class="nav-link {{ (Route::is('tasks')) ? 'active' : '' }}">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{  route('tasks-create') }}" class="nav-link {{ (Route::is('tasks-create')) ? 'active' : '' }}">
                                    <i class="far fa-calendar-plus nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ (Route::is(['functionpoints', 'functionpoints-create'])) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (Route::is(['functionpoints', 'functionpoints-create'])) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Function Points
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{  route('functionpoints') }}" class="nav-link {{ (Route::is('functionpoints')) ? 'active' : '' }}">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{  route('functionpoints-create') }}" class="nav-link {{ (Route::is('functionpoints-create')) ? 'active' : '' }}">
                                    <i class="far fa-calendar-plus nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{ (Route::is(['defects', 'defects-create'])) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (Route::is(['defects', 'defects-create'])) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Defects
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{  route('defects') }}" class="nav-link {{ (Route::is('defects')) ? 'active' : '' }}">
                                    <i class="fas fa-list-ol nav-icon"></i>
                                    <p>List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('defects-create')}}" class="nav-link {{ (Route::is('defects-create')) ? 'active' : '' }}">
                                    <i class="far fa-calendar-plus nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2019-2020
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </strong>
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script>
    // $.widget.bridge('uibutton', $.ui.button)
</script>

@stack('addons')

</body>
</html>
