<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/crop/dropzone.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/jquery-emoji/jquery.cssemoticons.css">

    <?php
    $userLoged = $this->session->userdata('id_user');
    if (@$aktifprofil) {
    ?>
        <style>
            .image_area {
                position: relative;
            }

            img {
                display: block;
                max-width: 100%;
            }

            .modal-lg {
                max-width: 600px !important;
            }

            #imageprofilnav {
                display: inline;
            }
        </style>
    <?php
    }
    ?>
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
                    <a class="nav-link"><b><?= $this->baseModel->TampilHijriSekarang() . ' | ' . tanggalIndo(date('Y-m-d')); ?></b></a>

                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php
                if (!$userLoged) {
                ?>
                    <div class="nav-item">
                        <a href="<?= base_url() ?>login" class="btn btn-success btn-sm">
                            <i class="fa fa-sign-in-alt"></i> Login
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link pt-0" data-toggle="dropdown" href="#">
                            <b class="text-success"><?= $this->session->userdata('namajabatan_user'); ?></b> |
                            <b class="text-dark"><?= $this->session->userdata('nama_user'); ?></b>
                            <img style="width: 30px;" src="<?= base_url('assets/') ?>/fotopengguna/<?= $this->session->userdata('gambar_user') ?>" class="brand-image img-circle elevation-2 ml-2" id="imageprofilnav" style="opacity: .8">
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">Login sebagai
                                <?= $this->session->userdata('namajabatan_user'); ?></span>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url() ?>profilakun" class="dropdown-item">
                                <i class="fas fa-user-circle mr-2"></i> Lihat Akun
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url() ?>logout" class="dropdown-item tombollogout">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url('assets/') ?>images/logop2k.png" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PPMU KEBUN BARU</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>" class="nav-link <?= @$aktifberanda ?>" style="padding-top: 10px;padding-left: 15px;">
                                <i class="nav-icon fas fa-home" style="text-align: left;"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <?php

                        if ($userLoged) {
                            $data = getKategri();
                            $menu = getMenu();

                        ?>
                            <li class="nav-header pt-2"><?= $data->nama_kategori; ?></li>
                            <?php
                            $datauri = $this->uri->segment(1);
                            $tipeUser = $this->session->userdata('tipe_user');
                            // echo $datauri;
                            if ($menu) {
                                foreach ($menu as $dm) {
                                    $idM = $dm->id_datamenu;

                                    if ($dm->url_menu == $datauri) {
                                        $aktif = 'active';
                                    } else {
                                        $aktif = '';
                                    }
                            ?>
                                    <li class="<?= ($idM == 26 && $tipeUser == 2 || $idM == 53 && $tipeUser == 1) ? 'nav-item d-none' : 'nav-item' ?>">
                                        <a style="padding-top: 10px;padding-left: 15px;" href="<?= base_url($dm->url_menu) ?>" class="nav-link <?= $aktif ?>">
                                            <i class="nav-icon <?= $dm->icon_menu ?>" style="text-align: left;"></i>
                                            <p><?= $dm->nama_menu; ?></p>
                                        </a>
                                    </li>
                        <?php
                                }
                            }
                        }
                        ?>
                        <li class="nav-header pt-2">UTILITAS</li>
                        <?php
                        if ($userLoged) {
                        ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>profilakun" class="nav-link <?= @$aktifprofil ?>" style="padding-top: 10px;padding-left: 15px;">
                                    <i class="nav-icon fas fa-user-circle" style="text-align: left;"></i>
                                    <p>Profil Akun</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url() ?>development" class="nav-link <?= @$aktifdev ?>" style="padding-top: 10px;padding-left: 15px;">
                                    <i class="nav-icon fas fa-newspaper" style="text-align: left;"></i>
                                    <p>News</p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>tentang" class="nav-link <?= @$aktiftentang ?>" style="padding-top: 10px;padding-left: 15px;">
                                <i class="nav-icon fas fa-info-circle" style="text-align: left;"></i>
                                <p>Tentang</p>
                            </a>
                        </li>
                        <?php
                        if ($userLoged) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link tombollogout" href="<?= base_url() ?>logout" style="padding-top: 10px;padding-left: 15px;">
                                    <i class="nav-icon fas fa-sign-out-alt" style="text-align: left;"></i>
                                    <p>Log Out</p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if (!$userLoged) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url() ?>login" style="padding-top: 10px;padding-left: 15px;">
                                    <i class="nav-icon fas fa-sign-in-alt" style="text-align: left;"></i>
                                    <p>Login</p>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>