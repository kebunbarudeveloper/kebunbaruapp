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
    <!-- icheck bootstrap -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
    <style>
    .login-page {
        background-image: url("<?= base_url('assets') ?>/images/bamper.jpg");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;

    }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo">
                    <img class="bamperlogin" src="<?= base_url('assets') ?>/images/logo.png"
                        alt="Login MMU Tsanawiyah PPS" style="width: 300px;">
                </div>
                <hr>
                <?php if ($this->session->flashdata('errorlogin')) : ?>
                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('errorlogin'); ?>
                </div>
                <?php endif; ?>
                <form action="<?= base_url() ?>login/proseslogin" method="post" autocomplete="off">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" autofocus
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control inputpassword" name="katasandi"
                            placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text" style="cursor: pointer;" id="lihatpassword"
                                data-toggle="tooltip" data-placement="top" title="Lihat Password">
                                <span class="fas fa-eye"></span>
                            </div>
                            <div class="input-group-text" style="cursor: pointer; display:none" id="tutuppassword"
                                data-toggle="tooltip" data-placement="top" title="Sembunyikan Password">
                                <span class="fas fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-sign-in-alt"></i> Masuk
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>

    <script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('#lihatpassword').on('click', function() {
        $(this).hide();
        $('#tutuppassword').show();
        $('.inputpassword').attr('type', 'text');
    })

    $('#tutuppassword').on('click', function() {
        $(this).hide();
        $('#lihatpassword').show();
        $('.inputpassword').attr('type', 'password');
    })
    </script>

</body>

</html>