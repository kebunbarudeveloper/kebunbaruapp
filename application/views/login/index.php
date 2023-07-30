<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/') ?>css/main.css">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">
    <?php
    $error = $this->session->flashdata('errorlogin');
    if ($error) {
        $style = '100px';
    } else {
        $style = '150px';
    }
    ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form style="padding-top: <?= $style ?>" class="login100-form validate-form" action="<?= base_url() ?>login/proseslogin" method="post" autocomplete="off">
                    <span class="login100-form-title p-b-43">
                        Hi, Login dulu, yuk!
                    </span>
                    <?php if ($error) : ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-circle"></i>
                            <small>
                                <?= $error; ?>
                            </small>
                        </div>
                    <?php endif ?>


                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="username" autofocus>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="katasandi" id="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3" style="justify-content: end;">
                        <a href="" id="bukaPassword">
                            <div class="contact100-form-checkbox">
                                <i class="fa fa-eye"></i> <small>Show Password</small>
                            </div>
                        </a>
                        <a href="" id="tutupPassword" style="display: none;">
                            <div class="contact100-form-checkbox">
                                <i class="fa fa-eye-slash"></i> <small>Hide Password</small>
                            </div>
                        </a>
                    </div>
                    <div class="container-login100-form-btn mt-4">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>

                <div class="login100-more">
                    <div class="wrapDescription">
                        <div class="description">
                            <a href="<?= base_url() ?>beranda">
                                <img class="loginLogo" src="<?= base_url('assets/logo-login.png') ?>" alt="Logo Login">
                            </a>
                            <h5 class="description-text">
                                KebunbaruApp adalah platform basis data Pondok Pesantren Miftahul Ulum Kebun Baru, Kacok Palengaan Pamekasan Jatim
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="text-center p-b-10 fixBottom">
                    <span class="txt2">
                        &copy; Copyright <?= '2020 - ' . date('Y')  ?>
                    </span>
                </div>
            </div>
        </div>
    </div>




    <input type="hidden" id="hasilPassword" value="0">
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('assets/login/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url('assets/login/') ?>vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('assets/login/') ?>js/main.js"></script>
    <script>
        $('#bukaPassword').on('click', function(e) {
            e.preventDefault()
            $(this).hide()
            $('#tutupPassword').show()
            $('#password').attr('type', 'text')
        })

        $('#tutupPassword').on('click', function(e) {
            e.preventDefault()
            $(this).hide()
            $('#bukaPassword').show()
            $('#password').attr('type', 'password')
        })
    </script>
</body>

</html>