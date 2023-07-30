<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/jquery-ui/jquery-ui.min.css">
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"><b><?= $this->baseModel->GetTampilPeriode(); ?></b></a>

                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link"><b><?= $this->baseModel->TampilHijriSekarang(); ?></b></a>

                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link pt-0" data-toggle="dropdown" href="#">
                        <b><?= $this->session->userdata('nama_user'); ?></b>
                        <img style="width: 30px;" src="<?= base_url('assets/') ?>/images/logo.jpg"
                            class="brand-image img-circle elevation-2 ml-2" style="opacity: .8">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span
                            class="dropdown-item dropdown-header"><?= $this->session->userdata('jabatan_user'); ?></span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user-circle mr-2"></i> Lihat Akun
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url() ?>login/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url('assets/') ?>/images/logo.jpg" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $this->session->userdata('jabatan_user'); ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>" class="nav-link <?= @$aktifberanda ?>">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-header pt-2">ADMINISTRATOR</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Kelola Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="display: none;">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>pengaturan" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Pengaturan Awal Tahun</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>akunkeuangan" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Akun Keuangan</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>
                                            Level 2
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fa fa-caret-right nav-icon ml-5"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>tambahpengguna" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Tambah Pengguna</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header pt-2">KESEKRETARIATAN</li>
                        <li class="nav-item has-treeview <?= @$openmenusantribaru ?>">
                            <a href="#" class="nav-link <?= @$aktifmenusantribaru ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Pendaftaran Santri
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>santribaru" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Input Santri Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>datasantribaru" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Data Santri Baru</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Data Santri
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>santribaru" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Input Santri Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>profilranting" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Data Santri Baru</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>profilranting" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Profil MMU</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>dataranting" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Data Ranting</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>
                                            Level 2
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fa fa-caret-right nav-icon ml-5"></i>
                                                <p>Level 3</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-ellipsis-h nav-icon ml-4"></i>
                                        <p>Set Periode</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>