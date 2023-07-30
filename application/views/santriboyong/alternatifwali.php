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
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/crop/dropzone.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/crop/cropper.css">
    <?php
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


    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->

            <!-- /.row -->
            <!-- /.row (main row) -->



            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <form autocomplete="off" id="formtambahwakilwali">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="namawakilwali" class="col-sm-4 col-form-label">NAMA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatawakilwali"
                                                    name="namawakilwali" id="namawakilwali" tabindex="1" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="prowakilwali" class="col-sm-4 col-form-label">PROVINSI</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatawakilwali"
                                                    name="prowakilwali" id="prowakilwali" tabindex="3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kecwakilwali" class="col-sm-4 col-form-label">KECAMATAN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatawakilwali"
                                                    name="kecwakilwali" id="kecwakilwali" tabindex="5">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="poswakilwali" class="col-sm-4 col-form-label">KODE POS</label>
                                            <div class="col-sm-4">
                                                <input readonly type="text" class="form-control inputdatawakilwali"
                                                    name="poswakilwali" id="poswakilwali">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="pekerjaanwakilwali"
                                                class="col-sm-4 col-form-label">PEKERJAAN</label>
                                            <div class="col-sm-8">
                                                <select name="pekerjaanwakilwali" id="pekerjaanwakilwali"
                                                    class="form-control inputdatasantri" tabindex="2">
                                                    <option value="">..:Pilih Pekerjaan:..</option>
                                                    <option value="BELUM/TIDAK BEKERJA">
                                                        BELUM/TIDAK BEKERJA</option>
                                                    <option value="USTADZ/MUBALIGH">
                                                        USTADZ/MUBALIGH</option>
                                                    <option value="WIRASWASTA">WIRASWASTA
                                                    </option>
                                                    <option value="NELAYAN/PERIKANAN">
                                                        NELAYAN/PERIKANAN</option>
                                                    <option value="PETANI/PEKEBUN">
                                                        PETANI/PEKEBUN</option>
                                                    <option value="PELAJAR/MAHASISWA">
                                                        PELAJAR/MAHASISWA</option>
                                                    <option value="KARYAWAN SWASTA">KARYAWAN
                                                        SWASTA</option>
                                                    <option value="KARYAWAN HONORER">KARYAWAN
                                                        HONORER</option>
                                                    <option value="LAINNYA">LAINNYA</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kabwakilwali"
                                                class="col-sm-4 col-form-label">KABUPATEN/KOTA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatawakilwali"
                                                    name="kabwakilwali" id="kabwakilwali" tabindex="4">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="desawakilwali" class="col-sm-4 col-form-label">DESA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatawakilwali"
                                                    id="desawakilwali" name="desawakilwali" tabindex="6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="idsantriboyong" value="<?= $id; ?>">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="batal">Batal</button>
                            <button type="button" class="btn btn-primary" id="tombolsimpan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="idPro">
            <input type="hidden" id="idKab">
            <input type="hidden" id="idKec">
        </div><!-- /.container-fluid -->
    </section>


    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="<?= base_url('assets/') ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
    <script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
    <script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

    <script>
    $('[data-mask]').inputmask();

    $('.inputdatawakilwali').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus();
        }
    })


    $('#prowakilwali').on('keypress', function() {

        $('#prowakilwali').autocomplete({
            source: "<?= base_url() ?>datapengurus/getprovinsi",
            select: function(event, ui) {
                $('#idPro').val(ui.item.description);
                $('#kabwakilwali').focus()
            }
        });
    })

    $('#kabwakilwali').on('keypress', function() {
        const idPro = $('#idPro').val()

        $('#kabwakilwali').autocomplete({
            source: "<?= base_url() ?>datapengurus/getkab/" + idPro,
            select: function(event, ui) {
                $('#idKab').val(ui.item.description)
                $('#kecwakilwali').focus()
            }
        });
    })


    $('#kecwakilwali').on('keypress', function() {
        const idKab = $('#idKab').val()

        $('#kecwakilwali').autocomplete({
            source: "<?= base_url() ?>datapengurus/getkec/" + idKab,
            select: function(event, ui) {
                $('#idKec').val(ui.item.description)
                $('#desawakilwali').focus()
            }
        });
    })

    $('#desawakilwali').on('keypress', function() {
        const idKec = $('#idKec').val()

        $('#desawakilwali').autocomplete({
            source: "<?= base_url() ?>datapengurus/getdesa/" + idKec,
            select: function(event, ui) {
                $('#poswakilwali').val(ui.item.description)
            }
        });
    })



    $('#tombolsimpan').on('click', function() {
        let dataForm = $('#formtambahwakilwali')
        let isian = dataForm.find('input[type="text"]').val()
        let pilih = dataForm.find('select').val()

        if (isian == '' || pilih == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan inputan sudah terisi semua'
            })
        } else {
            $.ajax({
                url: "<?= base_url() ?>santriboyong/ubahdatawali",
                method: "post",
                data: dataForm.serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.hasil === 1) {
                        toastr.success('SIPPPP..!! Berhasil. Klik tombol refresh')
                    }

                    window.close()
                }
            })
        }
    })

    $('#batal').on('click', function() {
        window.close()
    })
    </script>
</body>

</html>