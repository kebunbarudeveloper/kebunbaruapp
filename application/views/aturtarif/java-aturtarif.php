<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/autoNumeric.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('[data-mask]').inputmask();

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "3000"
    }

    $('.form-control').keypress(function(e) {
        if (e.which == 13 && $(this).val() != '') {
            e.preventDefault()
            let $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('[tabIndex=1]');
            }
            $next.focus().select();
        }
    });

    $('.rupiahFormat').autoNumeric('init', {
        aSep: '.',
        aDec: ',',
        aForm: true,
        vMax: '999999999',
        vMin: '-999999999'
    });

    $(function() {
        load()
    })

    const load = () => {
        $.ajax({
            url: '<?= base_url() ?>aturtarif/load',
            method: 'post',
            success: function(data) {
                $('#tampilindex').html(data)
            }
        })
    }

    $('#modal-tambah').on('shown.bs.modal', function() {
        $('.tombolSimpan').hide()
    })

    $('#modal-tambah').on('hidden.bs.modal', function() {
        $('.tombolSimpan').hide()
        $('#formPendaftaran')[0].reset();
        $('#formInfaq')[0].reset();
        $('#formPesantren')[0].reset();
        $('#divPendaftaran').hide()
        $('#divInfaq').hide()
        $('#divPesantren').hide()
        $('#changeJenis').val('')
    })

    $('#modal-madrasah').on('hidden.bs.modal', function() {
        $('#formMadrasah')[0].reset();
        $('#pilihkelas').val('')
        $('#pilihtingkat').val('')
        $('#tampilform').hide()
        $('#resetdata').hide()
    })

    $('#changeJenis').on('change', function() {
        let jenis = $(this).val()
        if (jenis == '') {
            $('.divTampil').hide()
            $('.tombolSimpan').hide()
            $('#title').html('Pilih Jenis')
            return false
        }

        if (jenis == 1) {
            getPendaftaran()
            $('#title').html('Tarif Pendaftaran')
        } else if (jenis == 2) {
            getInfaq()
            $('#title').html('Tarif Infaq')
        } else {
            getPesantren()
            $('#title').html('Tarif Pesantren')
        }
    })

    const getPendaftaran = () => {
        let elemen = $('#divPendaftaran')
        let tombol = $('#tombolPendaftaran')
        getData(elemen, tombol)
    }

    const getInfaq = () => {
        let elemen = $('#divInfaq')
        let tombol = $('#tombolInfaq')
        getData(elemen, tombol)
    }

    const getPesantren = () => {
        let elemen = $('#divPesantren')
        let tombol = $('#tombolPesantren')
        getData(elemen, tombol)
    }

    const getData = (elemen, tombol) => {
        $('.divTampil').hide()
        elemen.show()
        $('.tombolSimpan').hide()
        tombol.show()
    }

    $('#tombolPendaftaran').on('click', function() {
        let nominalp2k = $('#nominalp2k').val()
        let nominallp2k = $('#nominallp2k').val()
        if (nominalp2k == '' || nominallp2k == '') {
            alert(0)
            return false
        }

        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan semua bidang sudah diisi',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                savePendaftaran()
            }
        })
    })

    const savePendaftaran = () => {
        $.ajax({
            url: '<?= base_url() ?>aturtarif/setpendaftaran',
            method: 'post',
            data: $('#formPendaftaran').serialize(),
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    toastr.error('Gagal! Tarif sudah diatur sebelumnya')
                    return false
                }

                if (status == 500) {
                    toastr.error('Gagal! Kesalahan server')
                    return false
                }

                toastr.success('Yeay! Tarif pendaftaran berhasil diatur')
                $('#nominalp2k').val('')
                $('#nominallp2k').val('')
            }
        })
    }

    $('#tombolInfaq').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan semua bidang sudah diisi',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                saveInfaq()
            }
        })
    })

    const saveInfaq = () => {
        $.ajax({
            url: '<?= base_url() ?>aturtarif/setinfaq',
            method: 'post',
            data: $('#formInfaq').serialize(),
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    toastr.error('Gagal! Tarif sudah diatur sebelumnya')
                    return false
                }

                if (status == 500) {
                    toastr.error('Gagal! Kesalahan server')
                    return false
                }

                toastr.success('Yeay! Tarif infaq berhasil diatur')
                $('#formInfaq')[0].reset();
            }
        })
    }

    $('#tombolPesantren').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan semua bidang sudah diisi',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                savePesantren()
            }
        })
    })

    const savePesantren = () => {
        $.ajax({
            url: '<?= base_url() ?>aturtarif/setPesantren',
            method: 'post',
            data: $('#formPesantren').serialize(),
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    toastr.error('Gagal! Tarif sudah diatur sebelumnya')
                    return false
                }

                if (status == 500) {
                    toastr.error('Gagal! Kesalahan server')
                    return false
                }

                toastr.success('Yeay! Tarif pesantren berhasil diatur')
                $('#formPesantren')[0].reset();
            }
        })
    }


    $('#pilihtingkat').on('change', function() {
        let tingkat = $(this).val()
        $('#texttingkat').html(tingkat)
        if (tingkat == '') {
            $('#tingkat').val(0)
        } else {
            $('#tingkat').val(tingkat)
        }

        if (tingkat == '') {
            return false
        }

        setformdiv()
    })

    $('#pilihkelas').on('change', function() {
        let kelas = $(this).val()
        $('#textkelas').html(kelas)
        if (kelas == '') {
            $('#kelas').val(0)
        } else {
            $('#kelas').val(kelas)
        }

        setformdiv()
    })

    const setformdiv = () => {
        let tingkat = $('#tingkat').val()
        let kelas = $('#kelas').val()
        if (tingkat == 0 || kelas == 0) {
            $('#tampilform').hide()
            $('#resetdata').hide()
            return false
        }
        $('#tampilform').show()
        $('#resetdata').show()
        $('#imda').focus().select()
    }

    $('#simpanMadrasah').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Tindakan ini tidak bisa diedit ulang',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                savetarifMadrasah()
            }
        })
    })

    const savetarifMadrasah = () => {
        $.ajax({
            url: '<?= base_url() ?>aturtarif/setmadrasah',
            method: 'post',
            data: $('#formMadrasah').serialize(),
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    toastr.error('Gagal! Tarif sudah diatur sebelumnya')
                    return false
                }

                if (status == 500) {
                    toastr.error('Gagal! Kesalahan server')
                    return false
                }

                toastr.success('Yeay! Tarif berhasil diatur')
                $('#formMadrasah')[0].reset();
            }
        })
    }

    $('#resetdata').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Tindakan ini tidak bisa diedit ulang',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                resetdata()
            }
        })
    })

    const resetdata = () => {
        let tingkat = $('#tingkat').val()
        let kelas = $('#kelas').val()
        if (tingkat == 0 || kelas == 0) {
            return false
        }
        $.ajax({
            url: '<?= base_url() ?>aturtarif/resetdata',
            method: 'post',
            data: {
                kelas,
                tingkat
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status

                if (status == 500) {
                    toastr.error('Gagal! Kesalahan server')
                    return false
                }

                toastr.success('Yeay! Tarif berhasil direset')
                $('#formMadrasah')[0].reset();
            }
        })
    }

    $('#tutup').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Tindakan ini tidak bisa diubah lagi',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url() ?>aturtarif/tutuppengaturan'
            }
        })

    })

    $('#filterumum').on('change', function() {
        let filter = $(this).val()
        if (filter == '') {
            $('#tampildaftar').html('')
            $('#filtertingkat').hide().val('')
            $('#filterkelas').hide().val('')
            return false
        }

        //Berfungsi untuk load ulang setelah berhasil edit
        $('#hasilfilterumum').val(filter)

        if (filter == 4) {
            $('#filtertingkat').show().val('')
            $('#filterkelas').show().val('')
            $('#tampildaftar').html('')
        } else {
            $('#filtertingkat').hide().val('')
            $('#filterkelas').hide().val('')
            setfilterumum(filter)
        }
    })

    const setfilterumum = filter => {
        $.ajax({
            url: '<?= base_url() ?>aturtarif/setfilterumum',
            method: 'post',
            data: {
                filter
            },
            success: function(data) {
                $('#tampildaftar').html(data)
            }
        })
    }

    const setfiltermadrasah = () => {
        let kelas = $('#resultkelas').val()
        let tingkat = $('#resulttingkat').val()
        if (kelas != '' && tingkat != '') {
            $.ajax({
                url: '<?= base_url() ?>aturtarif/setfiltermadrasah',
                method: 'post',
                data: {
                    kelas,
                    tingkat
                },
                success: function(data) {
                    $('#tampildaftar').html(data)
                }
            })
        }
    }

    $('#filtertingkat').on('change', function() {
        let hasil = $(this).val()
        $('#resulttingkat').val(hasil)
        if (hasil == '') {
            $('#tampildaftar').html('')
            return false
        }
        setfiltermadrasah()
    })

    $('#filterkelas').on('change', function() {
        let hasil = $(this).val()
        $('#resultkelas').val(hasil)
        if (hasil == '') {
            $('#tampildaftar').html('')
            return false
        }
        setfiltermadrasah()
    })

    $('#edit-umum').on('hidden.bs.modal', function() {
        $('#formeditumum')[0].reset();
        $('#labeleditumum').html('')
        $('#nominalold').val('')
    })

    $('#edit-umum').on('shown.bs.modal', function() {
        $('#nominaledit').val('').focus()
    })

    const editumum = (id, el) => {
        $('#labeleditumum').html($(el).data('akun'))
        $('#nominalold').val($(el).data('nominal'))
        $('#idedit').val(id)
        $('#urlaksi').val($(el).data('table'))
    }

    $('#simpaneditumum').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan data valid',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>aturtarif/editumum',
                    method: 'post',
                    data: $('#formeditumum').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        let status = data.status
                        if (status == 500) {
                            toastr.error('Gagal! Kesalahan server')
                            return false
                        }

                        $('#edit-umum').modal('hide')
                        toastr.success('Yeay! Satu data berhasil diedit')
                        let hasilFilter = $('#hasilfilterumum').val()
                        if (hasilFilter != 4) {
                            setfilterumum(hasilFilter)
                        } else {
                            setfiltermadrasah()
                        }

                    }
                })
            }
        })
    })
</script>
</body>

</html>