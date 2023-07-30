<!-- jQuery -->
<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<!-- Summernote -->
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('[data-mask]').inputmask();

    toastr.options = {
        "positionClass": "toast-top-center"
    }

    const notif = $('.flashdata').data('flashdata');
    if (notif) {
        toastr.success(notif)
    }

    $('#modal-editsantri').on('shown.bs.modal', function() {
        $('#niksantri').focus().select();
    })

    $('#modal-editwali').on('shown.bs.modal', function() {
        $('#nikwali').focus().select();
        $('#tipeupdate').val(0)
        $('#customCheckbox2').prop('checked', false)
    })

    $('.inputdatasantri').keyup(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus().select();
        }
    });

    $('input[name="rencanadomisili"]').on('change', function() {
        const [isi,
            kamarSantri,
            daerahSantri
        ] = [
            $(this).val(),
            $('#nomorkamarsantri'),
            $('#daerahsantri')
        ]

        isi === 'LP2K' && kamarSantri.prop('disabled', true)
        isi === 'LP2K' && daerahSantri.prop('disabled', true)
        isi === 'P2K' && kamarSantri.prop('disabled', false)
        isi === 'P2K' && daerahSantri.prop('disabled', false)

    })


    $('#customCheckbox2').on('click', function() {
        if ($(this).is(':checked')) {
            $('#tipeupdate').val(1)
        } else {
            $('#tipeupdate').val(0)
        }
    })


    const getAlamat = (element, url, target) => {
        element.autocomplete({
            source: url,
            select: (event, ui) => {
                target.val(ui.item.description)
            }
        });
    }

    $(function() {
        const [
            elementPro,
            urlprovinsi,
            targetPro
        ] = [
            $('#provinsisantri'),
            $('#urldataprovinsi').val(),
            $('#idProvinsiSantri')
        ]

        getAlamat(elementPro, urlprovinsi, targetPro)

    })

    const elementKab = $('#kabupatensantri')
    elementKab.on('keypress', function() {
        const [
            urlkab,
            idPro,
            targetKab
        ] = [
            $('#urldatakab').val(),
            $('#idProvinsiSantri').val(),
            $('#idKabSantri')
        ]
        const fixUrlKab = `${urlkab}/${idPro}`
        getAlamat(elementKab, fixUrlKab, targetKab)
    })


    const elementKec = $('#kecamatansantri')
    elementKec.on('keypress', function() {
        const [
            urlkec,
            idKab,
            targetKec
        ] = [
            $('#urldatakec').val(),
            $('#idKabSantri').val(),
            $('#idKecSantri')
        ]
        const fixUrlKec = `${urlkec}/${idKab}`
        getAlamat(elementKec, fixUrlKec, targetKec)
    })


    const elementDesa = $('#desasantri')
    elementDesa.on('keypress', function() {
        const [
            urldesa,
            idKec,
            targetDesa
        ] = [
            $('#urldatadesa').val(),
            $('#idKecSantri').val(),
            $('#kodepossantri')
        ]
        const fixUrlDesa = `${urldesa}/${idKec}`
        getAlamat(elementDesa, fixUrlDesa, targetDesa)
    })


    $('#tombolsimpaneditsantri').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Menyimpan perubahan data",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formeditsantri').submit()
            }
        })
    })


    $(function() {
        const [
            elementProWali,
            urlprovinsiwali,
            targetProWali
        ] = [
            $('#provinsiwali'),
            $('#urldataprovinsi').val(),
            $('#idProWali')
        ]
        getAlamat(elementProWali, urlprovinsiwali, targetProWali)
    })


    const elementKabWali = $('#kabupatenwali')
    elementKabWali.on('keypress', function() {
        const [
            urlkabwali,
            idProwali,
            targetKabWali
        ] = [
            $('#urldatakab').val(),
            $('#idProWali').val(),
            $('#idKabWali')
        ]
        const fixUrlKabWali = `${urlkabwali}/${idProwali}`
        getAlamat(elementKabWali, fixUrlKabWali, targetKabWali)
    })


    const elementKecWali = $('#kecamatanwali')
    elementKecWali.on('keypress', function() {
        const [
            urlkecwali,
            idKabwali,
            targetKecWali
        ] = [
            $('#urldatakec').val(),
            $('#idKabWali').val(),
            $('#idKecWali')
        ]
        const fixUrlKecWali = `${urlkecwali}/${idKabwali}`
        getAlamat(elementKecWali, fixUrlKecWali, targetKecWali)
    })


    const elementDesaWali = $('#desawali')
    elementDesaWali.on('keypress', function() {
        const [
            urldesawali,
            idKecwali,
            tergetDesaWali
        ] = [
            $('#urldatadesa').val(),
            $('#idKecWali').val(),
            $('#kodeposwali')
        ]
        const fixUrlDesaWali = `${urldesawali}/${idKecwali}`
        getAlamat(elementDesaWali, fixUrlDesaWali, tergetDesaWali)
    })

    $('#tombolsimpateditwali').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Menyimpan perubahan data",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut'
        }).then((result) => {
            if (result.isConfirmed) {
                if ($('#hubunganwali').val() != '') {
                    $('#formeditwali').submit()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Hubungan wali belum dipilih',
                    })
                }
            }
        })
    })


    $('#nikwali').on('focusout', function() {
        const idwali = $(this).val()
        const nikwaliedit = $('#nikwaliedit').val()
        //alert(idwali)
        let [
            tipewali,
            namawali,
            nomorhpwali,
            provinsiwali,
            kecamatanwali,
            dusunwali,
            kabupatenwali,
            desawali,
            rtwali,
            rwwali,
            kodeposwali,
            pendidikanwali,
            pekerjaanwali,
            hubunganwali
        ] = [
            $('#tipewali'),
            $('#namawali'),
            $('#nomorhpwali'),
            $('#provinsiwali'),
            $('#kecamatanwali'),
            $('#dusunwali'),
            $('#kabupatenwali'),
            $('#desawali'),
            $('#rtwali'),
            $('#rwwali'),
            $('#kodeposwali'),
            $('#pendidikanwali'),
            $('#pekerjaanwali')
        ]


        if (idwali != '' && idwali !== nikwaliedit) {
            $.ajax({
                url: '<?= base_url() ?>santribaru/ceknikwali',
                method: 'post',
                data: {
                    nik: idwali
                },
                dataType: 'json',
                success: data => {
                    let dataHasil = data[0]

                    if (data.hasil == 1) {
                        Swal.fire({
                            title: 'NIK WALI SUDAH ADA',
                            text: 'Klik lanjut untuk isi data otomatis',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Lanjutkan',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                tipewali.val(1)
                                namawali.val(data[0].nama_walisantri).prop('readonly', true)
                                nomorhpwali.val(data[0].nomor_hp_walisantri).prop('readonly',
                                    true)
                                provinsiwali.val(data[0].provinsi_walisantri).prop('readonly',
                                    true)
                                kecamatanwali.val(data[0].kecamatan_walisantri).prop(
                                    'readonly', true)
                                dusunwali.val(data[0].dusun_walisantri).prop('readonly',
                                    true)
                                kabupatenwali.val(data[0].kabupaten_walisantri).prop(
                                    'readonly', true)
                                desawali.val(data[0].desa_walisantri).prop('readonly',
                                    true)
                                rtwali.val(data[0].rt_walisantri).prop('readonly', true)
                                rwwali.val(data[0].rw_walisantri).prop('readonly', true)
                                kodeposwali.val(data[0].kode_pos_walisantri).prop(
                                    'readonly',
                                    true)
                                pendidikanwali.val(data[0].pendidikan_akhir_walisantri)
                                pekerjaanwali.val(data[0].pekerjaan_walisantri)
                            }
                        })
                    }

                }
            })
        }
    })
</script>


</body>

</html>