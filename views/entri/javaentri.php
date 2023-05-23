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
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "3000"
    }

    $(function() {
        loaddata()
    })

    const loaddata = () => {
        let platform = $('#resultplatform').val()
        $.ajax({
            url: '<?= base_url() ?>entridata/loaddata',
            method: 'post',
            data: {
                platform
            },
            success: function(data) {
                $('#tampil').html(data)
            }
        })
    }

    $('#changePlatform').on('change', function() {
        $('#resultplatform').val($(this).val())
        loaddata()
    })

    $('#refresh').on('click', function() {
        $('#resultplatform').val('')
        $('#changePlatform').val('')
        loaddata()
        toastr.success('Yeay..! Data berhasil diperbarui')
    })

    $('[data-mask]').inputmask();

    $('#modal-tambah').on('shown.bs.modal', () => {
        $('#noreg').focus()
    })

    const setdiv = () => {
        $('#tampilform').hide()
        $('#tampilformwali').hide()
    }

    const edit = id => {
        setdiv()
        $('#noreg').val(id).prop('disabled', true)
        setdata(id)
    }



    $('#modal-tambah').on('hidden.bs.modal', () => {
        $('#noreg').prop('disabled', false)
        $('#noreg').val('')
        $('#resultreg').val(0)
        $('#noregsantri').val('')
        $('#noregwali').val('')
        $('#alert').hide()
        $('#tampilreg').html('')
        $('#reset').prop('disabled', false).show()
        $('#simpansantri').prop('disabled', true).hide()
        $('#simpanwali').prop('disabled', true).hide()
        $('#tampilreg').html()
        $('#formsantri')[0].reset()
        $('#formwali')[0].reset()
        $('#tampilform').hide()
        $('#tampilformwali').hide()
        $('#kabupaten').prop('readonly', true)
        $('#kecamatan').prop('readonly', true)
        $('#desa').prop('readonly', true)
        $('#dusun').prop('readonly', true)
        $('#kabupatenw').prop('readonly', true)
        $('#kecamatanw').prop('readonly', true)
        $('#desaw').prop('readonly', true)
        $('#dusunw').prop('readonly', true)
        $('.message').html('')
    })

    $('#noreg').on('keypress', function(e) {
        let noreg = $(this).val()
        let resultreg = $('#resultreg').val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (noreg == 0) {
            return false
        }

        if (noreg == resultreg) {
            return false
        }

        $('#resultreg').val(noreg)
        setdata(noreg)

    })

    const setdata = noreg => {
        $.ajax({
            url: '<?= base_url() ?>entridata/ceknoreg',
            method: 'post',
            data: {
                noreg
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    $('#noreg').focus().select()
                    $('#alert').removeClass('alert-success')
                    $('#alert').addClass('alert-danger').html('Gagal! Data tidak ditemukan').show()
                    $('#tampilreg').html('')
                    $('#tampilform').hide()
                    $('#tampilformwali').hide()
                    return false
                }

                $('#alert').removeClass('alert-danger')
                $('#alert').addClass('alert-success').html('Yeayy! Data berhasil ditemukan').show()
                $('#resultreg').val(noreg)
                $('#simpansantri').prop('disabled', false).show()
                embeddata(noreg)
                loadreg(noreg)
                $('#tampilform').show()
            }
        })
    }

    const loadreg = noreg => {
        $.ajax({
            url: '<?= base_url() ?>entridata/loadnoreg',
            method: 'post',
            data: {
                noreg
            },
            success: function(data) {
                $('#tampilreg').html(data)
            }
        })
    }

    const embeddata = noreg => {
        $.ajax({
            url: '<?= base_url() ?>entridata/embeddata',
            method: 'post',
            data: {
                noreg
            },
            dataType: 'json',
            success: function(data) {

                let tetala = data.tanggal
                tanggal = ''
                bulan = ''
                tahun = ''
                if (tetala != null) {
                    let pecah = tetala.split('-')
                    tanggal = pecah[2]
                    bulan = pecah[1]
                    tahun = pecah[0]
                } else {
                    tanggal = 00
                    bulan = 00
                    tahun = 0000
                }

                $('#noregsantri').val(data.id)
                $('#kk').val(data.kk)
                $('#pendidikan').val(data.pendidikans)
                $('#tempat').val(data.tempat)
                $('#tanggal').val(tanggal)
                $('#bulan').val(bulan)
                $('#tahun').val(tahun)
                $('#provinsi').val(data.provinsi)
                $('#kabupaten').val(data.kabupaten)
                $('#kecamatan').val(data.kecamatan)
                $('#desa').val(data.desa)
                $('#dusun').val(data.dusun)
                $('#rt').val(data.rt)
                $('#rw').val(data.rw)
                $('#pos').val(data.pos)
                $('#ayah').val(data.ayah)
                $('#ibu').val(data.ibu)
                $('#noregwali').val(data.id)
                $('#pekerjaan').val(data.pekerjaan)
                $('#provinsiw').val(data.provinsiw)
                $('#kabupatenw').val(data.kabupatenw)
                $('#kecamatanw').val(data.kecamatanw)
                $('#desaw').val(data.desaw)
                $('#dusunw').val(data.dusunw)
                $('#rtw').val(data.rtw)
                $('#rww').val(data.rww)
                $('#posw').val(data.posw)
            }
        })
    }


    $('.form-control').keypress(function(e) {
        if (e.which == 13 && $(this).val() != '') {
            e.preventDefault()
            let $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            if (!$next.length) {
                $next = $('#simpansantri').focus();
            }
            $next.focus().select();
        }
    });

    const getAlamat = (element, url, target, elementTarget) => {
        element.autocomplete({
            source: url,
            select: (event, ui) => {
                target.val(ui.item.description)
                elementTarget.prop('readonly', false)
                elementTarget.focus().select()
            }
        });
    }

    const [
        kabupaten,
        kecamatan,
        desa,
        dusun,
        kabupatenw,
        kecamatanw,
        desaw,
        dusunw
    ] = [
        $('#kabupaten'),
        $('#kecamatan'),
        $('#desa'),
        $('#dusun'),
        $('#kabupatenw'),
        $('#kecamatanw'),
        $('#desaw'),
        $('#dusunw')
    ]

    $(function() {
        const urlprovinsi = '<?= base_url() ?>entridata/GetProvinsi';
        const element = $('#provinsi')
        const target = $('#resultprovinsi')

        getAlamat(element, urlprovinsi, target, kabupaten)
    })

    $(function() {
        const urlprovinsi = '<?= base_url() ?>entridata/GetProvinsi';
        const element = $('#provinsiw')
        const target = $('#resultprovinsi')

        getAlamat(element, urlprovinsi, target, kabupatenw)
    })

    kabupaten.on('keypress', () => {
        let resultprovinsi = $('#resultprovinsi').val()
        const resultkabupaten = $('#resultkabupaten')
        const url = '<?= base_url() ?>entridata/GetKab/' + resultprovinsi

        getAlamat(kabupaten, url, resultkabupaten, kecamatan)
    })

    kabupatenw.on('keypress', () => {
        let resultprovinsi = $('#resultprovinsi').val()
        const resultkabupaten = $('#resultkabupaten')
        const url = '<?= base_url() ?>entridata/GetKab/' + resultprovinsi

        getAlamat(kabupatenw, url, resultkabupaten, kecamatanw)
    })

    kecamatan.on('keypress', () => {
        const resultkabupaten = $('#resultkabupaten').val()
        const resultkecamatan = $('#resultkecamatan')
        const url = '<?= base_url() ?>entridata/GetKec/' + resultkabupaten

        getAlamat(kecamatan, url, resultkecamatan, desa)
    })

    kecamatanw.on('keypress', () => {
        const resultkabupaten = $('#resultkabupaten').val()
        const resultkecamatan = $('#resultkecamatan')
        const url = '<?= base_url() ?>entridata/GetKec/' + resultkabupaten

        getAlamat(kecamatanw, url, resultkecamatan, desaw)
    })

    desa.on('keypress', () => {
        const resultkecamatan = $('#resultkecamatan').val()
        const resultdesa = $('#pos')
        const url = '<?= base_url() ?>entridata/getdesa/' + resultkecamatan

        getAlamat(desa, url, resultdesa, dusun)
    })

    desaw.on('keypress', () => {
        const resultkecamatan = $('#resultkecamatan').val()
        const resultdesa = $('#pos')
        const url = '<?= base_url() ?>entridata/getdesa/' + resultkecamatan

        getAlamat(desaw, url, resultdesa, dusunw)
    })

    $('#simpansantri').on('click', function() {
        $.ajax({
            url: '<?= base_url() ?>entridata/simpansantri',
            method: 'post',
            data: $('#formsantri').serialize(),
            dataType: 'json',
            success: function(data) {
                let message = data.message
                if (message == 400) {
                    let error = data.errors
                    if (error) {
                        if (error.kk != '') {
                            $('#errorkk').html(error.kk)
                        } else {
                            $('#errorkk').html('')
                        }

                        if (error.pendidikan) {
                            $('#errorpendidikan').html(error.pendidikan)
                        } else {
                            $('#errorpendidikan').html('')
                        }

                        if (error.tempat) {
                            $('#errortempat').html(error.tempat)
                        } else {
                            $('#errortempat').html('')
                        }

                        if (error.tanggal) {
                            $('#errortanggal').html(error.tanggal)
                        } else {
                            $('#errortanggal').html('')
                        }

                        if (error.bulan) {
                            $('#errorbulan').html(error.bulan)
                        } else {
                            $('#errorbulan').html('')
                        }

                        if (error.tahun) {
                            $('#errortahun').html(error.tahun)
                        } else {
                            $('#errortahun').html('')
                        }

                        if (error.provinsi) {
                            $('#errorprovinsi').html(error.provinsi)
                        } else {
                            $('#errorprovinsi').html('')
                        }

                        if (error.kabupaten) {
                            $('#errorkabupaten').html(error.kabupaten)
                        } else {
                            $('#errorkabupaten').html('')
                        }

                        if (error.kecamatan) {
                            $('#errorkecamatan').html(error.kecamatan)
                        } else {
                            $('#errorkecamatan').html('')
                        }

                        if (error.desa) {
                            $('#errordesa').html(error.desa)
                        } else {
                            $('#errordesa').html('')
                        }

                        if (error.dusun) {
                            $('#errordusun').html(error.dusun)
                        } else {
                            $('#errordusun').html('')
                        }

                        if (error.rt) {
                            $('#errorrt').html(error.rt)
                        } else {
                            $('#errorrt').html('')
                        }

                        if (error.rw) {
                            $('#errorrw').html(error.rw)
                        } else {
                            $('#errorrw').html('')
                        }

                        if (error.ayah) {
                            $('#errorayah').html(error.ayah)
                        } else {
                            $('#errorayah').html('')
                        }

                        if (error.ibu) {
                            $('#erroribu').html(error.ibu)
                        } else {
                            $('#erroribu').html('')
                        }
                    }

                    return false
                }

                $('#reset').prop('disabled', true).hide()
                $('#simpansantri').prop('disabled', true).hide()
                $('#simpanwali').prop('disabled', false).show()
                $('#tampilform').hide()
                $('#tampilformwali').show()
            }
        })
    })

    $('#checkboxPrimary1').on('change', function() {
        if ($(this).is(':checked')) {
            let noreg = $('#noregwali').val()
            $.ajax({
                url: '<?= base_url() ?>entridata/getalamat',
                method: 'post',
                data: {
                    noreg
                },
                dataType: 'json',
                success: function(data) {

                    if (data.status == 400) {
                        toastr.error('Gagal! Alamat santri tidak valid')
                        return false
                    }

                    $('.message').html('')
                    $('#provinsiw').val(data.data.provinsi)
                    kabupatenw.val(data.data.kabupaten)
                    kecamatanw.val(data.data.kecamatan)
                    desaw.val(data.data.desa)
                    dusunw.val(data.data.dusun)
                    $('#rtw').val(data.data.rt)
                    $('#rww').val(data.data.rw)
                    $('#posw').val(data.data.pos)
                    toastr.success('Yeaaay! Alamat santri valid')
                }
            })
        } else {
            $('#provinsiw').val('').focus()
            kabupatenw.val('').prop('readonly', true)
            kecamatanw.val('').prop('readonly', true)
            desaw.val('').prop('readonly', true)
            dusunw.val('').prop('readonly', true)
            $('#rtw').val('')
            $('#rww').val('')
            $('#posw').val('')
        }
    })

    $('#simpanwali').on('click', function() {
        let noreg = $('#noregwali').val()
        $.ajax({
            url: '<?= base_url() ?>entridata/simpanwali',
            method: 'post',
            data: $('#formwali').serialize(),
            dataType: 'json',
            success: function(data) {
                let message = data.message
                if (message == 400) {
                    let error = data.errors
                    if (error) {
                        if (error.kk != '') {
                            $('#errorpekerjaan').html(error.pekerjaan)
                        } else {
                            $('#errorpekerjaan').html('')
                        }

                        if (error.provinsiw) {
                            $('#errorprovinsiw').html(error.provinsiw)
                        } else {
                            $('#errorprovinsiw').html('')
                        }

                        if (error.kabupatenw) {
                            $('#errorkabupatenw').html(error.kabupatenw)
                        } else {
                            $('#errorkabupatenw').html('')
                        }

                        if (error.kecamatanw) {
                            $('#errorkecamatanw').html(error.kecamatanw)
                        } else {
                            $('#errorkecamatanw').html('')
                        }

                        if (error.desaw) {
                            $('#errordesaw').html(error.desaw)
                        } else {
                            $('#errordesaw').html('')
                        }

                        if (error.dusunw) {
                            $('#errordusunw').html(error.dusunw)
                        } else {
                            $('#errordusunw').html('')
                        }

                        if (error.rtw) {
                            $('#errorrtw').html(error.rtw)
                        } else {
                            $('#errorrtw').html('')
                        }

                        if (error.rww) {
                            $('#errorrww').html(error.rww)
                        } else {
                            $('#errorrww').html('')
                        }
                    }

                    return false
                }

                $('#modal-tambah').modal('hide')
                loaddata()

                Swal.fire({
                    title: 'Satu Langkah Lagi',
                    text: 'Pilih OK, jika data akan disimpan  ke Data Santri',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setdatasantri(noreg)
                    }
                })
            }
        })
    })

    const setdatasantri = noreg => {
        $.ajax({
            url: '<?= base_url() ?>entridata/setdata',
            method: 'post',
            data: {
                noreg
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    toastr.error('Gagal! Data tidak ditemukan')
                } else if (status == 201) {
                    toastr.error('Gagal! NIK duplikat')
                } else {
                    toastr.success('Yeaayy! Satu data berhasil ditambah ke Data Santri')
                    loaddata()
                    print(data.id)
                }
            }
        })
    }

    const beforesetdatasantri = id => {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Tindakan ini hanya sekali',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                setdatasantri(id)
            }
        })
    }

    const print = id => {
        $('#idsantri').val(id)
        $('#formsetprint').submit()
    }
</script>
</body>

</html>