<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{ asset('plugins') }}/datatables/datatables.css">
    <script src="{{ asset('plugins') }}/jquery/jquery.min.js"></script>
    <script src="{{ asset('plugins') }}/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables/datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <form method="post" action="/logout">
                        @CSRF
                        <button type="submit" class="btn btn-light" href="#">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-user mr-2"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light ml-2">Cashflow</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sparepart" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Data Sparepart
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'staff')
                        <li class="nav-item">
                            <a href="/cashier" class="nav-link">
                                <i class="nav-icon fas fa-desktop"></i>
                                <p>
                                    Kasir
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/transaction/income" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Riwayat Transaksi
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/transaction" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Keseluruhan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/transaction/income" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pemasukan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/transaction/outcome" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengeluaran</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/user" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Data Karyawan
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content pt-4">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </section>

        </div>
    </div>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="{{ asset('plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('plugins') }}/chart.js/Chart.min.js"></script>
    <script src="{{ asset('plugins') }}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{ asset('dist') }}/js/adminlte.min.js"></script>

</body>

</html>