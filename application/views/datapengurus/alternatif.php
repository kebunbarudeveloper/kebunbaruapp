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
                            <form autocomplete="off" id="formtambahpengurus">
                                <input type="hidden" name="tipe" id="tipe" value="tambah">
                                <input type="hidden" name="idPengurus" id="idPengurus">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="nikpengurus" class="col-sm-4 col-form-label">NIK | NO.
                                                HP</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="nikpengurus" id="nikpengurus" tabindex="1"
                                                    data-inputmask="'mask' : '9999999999999999'" data-mask="">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="hppengurus" id="hppengurus" tabindex="2"
                                                    data-inputmask="'mask' : '999-999-999-999'" data-mask="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kelaminpengurus" class="col-sm-4 col-form-label">J. KELAMIN |
                                                TMP
                                                LHR</label>
                                            <div class="col-sm-4">
                                                <select name="kelaminpengurus" id="kelaminpengurus"
                                                    class="form-control">
                                                    <option value="">..:Pilih Kelamin:..</option>
                                                    <option value="1">Laki-laki</option>
                                                    <option value="2">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="tempatpengurus" id="tempatpengurus" tabindex="4">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="propengurus" class="col-sm-4 col-form-label">PROVINSI</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="propengurus" id="propengurus" tabindex="8">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kecpengurus" class="col-sm-4 col-form-label">KECAMATAN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="kecpengurus" id="kecpengurus" tabindex="10">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="dusunpengurus" class="col-sm-4 col-form-label">DUSUN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="dusunpengurus" id="dusunpengurus" tabindex="12">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="namapengurus" class="col-sm-4 col-form-label">NAMA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="namapengurus" id="namapengurus" tabindex="3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tgl" class="col-sm-4 col-form-label">TANGGAL LAHIR</label>
                                            <div class="col-sm-2">
                                                <select name="tgl" id="tgl" class="form-control inputdatapengurus"
                                                    tabindex="5">
                                                    <option value="">.:Tgl:.</option>
                                                    <?php
                                                    $l = 1;
                                                    for ($i = 1; $i <= 31; $i++) {
                                                    ?>
                                                    <option value="<?= sprintf('%02d', $i); ?>">
                                                        <?= sprintf('%02d', $i); ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="bln" id="bln" class="form-control inputdatapengurus"
                                                    tabindex="6">
                                                    <option value="">.:Bulan:.</option>
                                                    <?php
                                                    $bulan = [
                                                        1 =>
                                                        'Januari',
                                                        'Februari',
                                                        'Maret',
                                                        'April',
                                                        'Mei',
                                                        'Juni',
                                                        'Juli',
                                                        'Agustus',
                                                        'September',
                                                        'Oktober',
                                                        'November',
                                                        'Desember'
                                                    ];
                                                    $k = 1;
                                                    for ($p = 1; $p <= 12; $p++) {
                                                    ?>
                                                    <option value="<?= sprintf('%02d', $p); ?>">
                                                        <?= $bulan[$p]; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="thn" id="thn" class="form-control inputdatapengurus"
                                                    tabindex="7">
                                                    <option value="">.:Tahun:.</option>
                                                    <?php
                                                    for ($b = 1960; $b <= 2010; $b++) {
                                                    ?>
                                                    <option value="<?= $b; ?>">
                                                        <?= $b; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kabpengurus"
                                                class="col-sm-4 col-form-label">KABUPATEN/KOTA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="kabpengurus" id="kabpengurus" tabindex="9">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="desapengurus" class="col-sm-4 col-form-label">DESA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    id="desapengurus" name="desapengurus" tabindex="11">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="rtpengurus" class="col-sm-4 col-form-label">RT/RW/KODE
                                                POS</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="rtpengurus" id="rtpengurus" tabindex="13"
                                                    data-inputmask="'mask' : '999'" data-mask="">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatapengurus"
                                                    name="rwpengurus" id="rwpengurus" tabindex="14"
                                                    data-inputmask="'mask' : '999'" data-mask="">
                                            </div>
                                            <div class="col-sm-4">
                                                <input readonly type="text" class="form-control inputdatapengurus"
                                                    name="pospengurus" id="pospengurus">
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

    $('.inputdatapengurus').keyup(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus();
        }
    })


    $('#nikpengurus').on('focusout', function() {
        const nik = $(this).val()

        $.ajax({
            url: "<?= base_url() ?>datapengurus/getIDSantri",
            method: "post",
            data: {
                nik: nik
            },
            dataType: "json",
            success: function(data) {
                if (data.hasil == 1) {
                    Swal.fire({
                        title: 'NIK sudah ada di Data Santri',
                        text: 'Klik lanjut untuk isi secara otomatis',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Lanjut',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let pecah = data.data.tanggal_lahir_santri.split('-')
                            $('#tgl').val(pecah[2])
                            $('#bln').val(pecah[1])
                            $('#thn').val(pecah[0])
                            $('#namapengurus').val(data.data.nama_santri)
                            $('#tempatpengurus').val(data.data.tempat_lahir_santri)
                            $('#propengurus').val(data.data.provinsi_santri)
                            $('#kecpengurus').val(data.data.kecamatan_santri)
                            $('#dusunpengurus').val(data.data.dusun_santri)
                            $('#kabpengurus').val(data.data.kabupaten_santri)
                            $('#desapengurus').val(data.data.desa_santri)
                            $('#rtpengurus').val(data.data.rt_santri)
                            $('#rwpengurus').val(data.data.rw_santri)
                            $('#pospengurus').val(data.data.kode_pos_santri)
                        }
                    })
                }
            }
        })

    })


    $('#propengurus').on('keypress', function() {

        $('#propengurus').autocomplete({
            source: "<?= base_url() ?>datapengurus/getprovinsi",
            select: function(event, ui) {
                $('#idPro').val(ui.item.description);
            }
        });
    })

    $('#kabpengurus').on('keypress', function() {
        const idPro = $('#idPro').val()

        $('#kabpengurus').autocomplete({
            source: "<?= base_url() ?>datapengurus/getkab/" + idPro,
            select: function(event, ui) {
                $('#idKab').val(ui.item.description);
            }
        });
    })


    $('#kecpengurus').on('keypress', function() {
        const idKab = $('#idKab').val()

        $('#kecpengurus').autocomplete({
            source: "<?= base_url() ?>datapengurus/getkec/" + idKab,
            select: function(event, ui) {
                $('#idKec').val(ui.item.description);
            }
        });
    })

    $('#desapengurus').on('keypress', function() {
        const idKec = $('#idKec').val()

        $('#desapengurus').autocomplete({
            source: "<?= base_url() ?>datapengurus/getdesa/" + idKec,
            select: function(event, ui) {
                $('#pospengurus').val(ui.item.description);
            }
        });
    })



    $('#tombolsimpan').on('click', function() {
        // window.close()
        let modal = $('#formtambahpengurus')
        let isian = modal.find('input[type="text"]').val()
        let pilih = modal.find('select').val()
        let bln = $('#bln').val()
        let thn = $('#thn').val()

        if (isian == '' || pilih == '' || bln == '' || thn == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan inputan sudah terisi semua'
            })
        } else {
            $.ajax({
                url: "<?= base_url() ?>datapengurus/tambahpengurus",
                method: "post",
                data: $('#formtambahpengurus').serialize(),
                dataType: "json",
                success: function(data) {
                    if (data == 1) {
                        toastr.success('SIPPPP..!! Satu data berhasil ditambahkan')
                    } else {
                        detailPengurus(data)
                        toastr.success('SIPPPP..!! Satu data berhasil diubah')
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