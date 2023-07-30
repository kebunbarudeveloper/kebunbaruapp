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
            url: '<?= base_url() ?>verifikasiberkas/loaddata',
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
        $('#changePlatform').val('')
        $('#resultplatform').val('')
        loaddata()
        toastr.success('Data berhasil dimuat ulang')
    })

    $('[data-mask]').inputmask();

    $('#modal-tambah').on('shown.bs.modal', () => {
        $('#nik').focus()
    })

    $('#modal-tambah').on('hidden.bs.modal', () => {
        $('#formtambah')[0].reset();
        $('#formtitle').html('Form Tambah Data')
        $('#simpan').prop('disabled', false)
        $('#id').val(0)
        $('.messages').html('')
        $('#niklama').val('')
        $('#niklamaw').val('')
        $('#kamar').prop('disabled', false)
        $('#daerah').prop('disabled', false)
    })

    $('#nik').on('focusout', function() {
        let id = $('#id').val()
        let nik = $('#niklama').val()
        if ($(this).val() != '') {
            if ($(this).val() != nik) {
                $.ajax({
                    url: '<?= base_url() ?>verifikasiberkas/ceknik',
                    method: 'post',
                    data: {
                        nik: $(this).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        let hasil = data.hasil
                        if (hasil == 400) {
                            $('#simpan').prop('disabled', false)
                            return false
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'NIK sudah ada di database'
                        })
                        $('#simpan').prop('disabled', true)
                    }
                })
            }
        }
    })

    $('input[name="domisili"]').on('change', function() {
        let [
            isi,
            nomorKamar,
            daerah
        ] = [
            $(this).val(),
            $('#kamar'),
            $('#daerah')
        ]

        isi == 'LP2K' && nomorKamar.prop('disabled', true)
        isi == 'LP2K' && daerah.prop('disabled', true)
        isi == 'P2K' && nomorKamar.prop('disabled', false)
        isi == 'P2K' && daerah.prop('disabled', false)
    })

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

    $('#nikw').on('focusout', function() {
        let id = $('#id').val()
        let nik = $('#niklamaw').val()
        if ($(this).val() != '') {
            if ($(this).val() != nik) {
                $.ajax({
                    url: '<?= base_url() ?>verifikasiberkas/ceknikwali',
                    method: 'post',
                    data: {
                        nik: $(this).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        let hasil = data.hasil
                        if (hasil == 400) {
                            return false
                        }

                        Swal.fire({
                            icon: 'warning',
                            title: 'Yeaayy...',
                            text: 'Data wali sudah ada dan bidang inputan diisi otomatis'
                        })

                        $('#namaw').val(data.data.nama_walisantri)
                        $('#hp').val(data.data.nomor_hp_walisantri)
                        $('#wa').val(data.data.nomor_wa_walisantri)
                        $('#pendidikan').val(data.data.pendidikan_akhir_walisantri)

                    }
                })
            }
        }
    })

    $('#simpan').on('click', function() {
        Swal.fire({
            title: 'Pastikan Data Sudah Valid',
            text: "Data yang Anda kirim tidak bisa diedit ulang",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>verifikasiberkas/simpan',
                    method: 'post',
                    data: $('#formtambah').serialize(),
                    dataType: 'json',
                    success: function(data) {

                        let message = data.message
                        if (message == 400) {
                            let error = data.errors
                            if (error) {
                                if (error.nik != '') {
                                    $('#errornik').html(error.nik)
                                } else {
                                    $('#errornik').html('')
                                }

                                if (error.nama) {
                                    $('#errornama').html(error.nama)
                                } else {
                                    $('#errornama').html('')
                                }

                                if (error.domisili) {
                                    $('#errordomisili').html(error.domisili)
                                } else {
                                    $('#errordomisili').html('')
                                }

                                if (error.kelasd) {
                                    $('#errorkelasd').html(error.kelasd)
                                } else {
                                    $('#errorkelasd').html('')
                                }

                                if (error.tingkatd) {
                                    $('#errortingkatd').html(error.tingkatd)
                                } else {
                                    $('#errortingkatd').html('')
                                }

                                if (error.kelasf) {
                                    $('#errorkelasf').html(error.kelasf)
                                } else {
                                    $('#errorkelasf').html('')
                                }

                                if (error.tingkatf) {
                                    $('#errortingkatf').html(error.tingkatf)
                                } else {
                                    $('#errortingkatf').html('')
                                }

                                if (error.nikw) {
                                    $('#errornikw').html(error.nikw)
                                } else {
                                    $('#errornikw').html('')
                                }

                                if (error.namaw) {
                                    $('#errornamaw').html(error.namaw)
                                } else {
                                    $('#errornamaw').html('')
                                }

                                if (error.hp) {
                                    $('#errorhp').html(error.hp)
                                } else {
                                    $('#errorhp').html('')
                                }

                                if (error.wa) {
                                    $('#errorwa').html(error.wa)
                                } else {
                                    $('#errorwa').html('')
                                }

                                if (error.pendidikan) {
                                    $('#errorpendidikan').html(error.pendidikan)
                                } else {
                                    $('#errorpendidikan').html('')
                                }

                                if (error.hubungan) {
                                    $('#errorhubungan').html(error.hubungan)
                                } else {
                                    $('#errorhubungan').html('')
                                }
                            }
                        } else if (message == 0) {
                            toastr.error('Gagal! Kesalahan server')
                        } else if (message == 3) {
                            toastr.error('Gagal! NIK yang Anda masukkan sudah ada di database')
                        } else {
                            let kata = ['', 'ditambah', 'diubah'];
                            toastr.success(`Sukses! Satu data berhasil ${kata[message]}`)
                            $('#modal-tambah').modal('hide')
                            $('#resultplatform').val('')
                            loaddata()
                        }
                    }
                })
            }
        })

    })

    const edit = id => {
        $.ajax({
            url: '<?= base_url() ?>verifikasiberkas/getid',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    return false
                }
                $('#formtitle').html('Form Edit Data')
                let domisili = data.data.domisili
                let tipe = data.data.tipe
                if (domisili == 'P2K') {
                    if (tipe == 1) {
                        $('#kamar').prop('disabled', true).val(data.data.kamar)
                        $('#daerah').prop('disabled', true).val(data.data.daerah)
                    } else {
                        $('#kamar').prop('disabled', false).val(data.data.kamar)
                        $('#daerah').prop('disabled', false).val(data.data.daerah)
                    }
                    $('#p2k').prop('checked', true)
                    $('#lp2k').prop('checked', false)
                } else {
                    $('#kamar').prop('disabled', true)
                    $('#daerah').prop('disabled', true)
                    $('#p2k').prop('checked', false)
                    $('#lp2k').prop('checked', true)
                }
                $('#id').val(data.data.id)
                $('#niklama').val(data.data.nik)
                $('#niklamaw').val(data.data.nikw)
                $('#nik').val(data.data.nik)
                $('#nama').val(data.data.nama)
                $('#kelasd').val(data.data.kelas)
                $('#tingkatd').val(data.data.tingkat)
                $('#kelasf').val(data.data.kelasf)
                $('#tingkatf').val(data.data.tingkatf)
                $('#nikw').val(data.data.nikw)
                $('#namaw').val(data.data.namaw)
                $('#hp').val(data.data.hp)
                $('#wa').val(data.data.wa)
                $('#pendidikan').val(data.data.pendidikan)
                $('#hubungan').val(data.data.hubungan)

                $('#modal-tambah').modal('show')
            }
        })
    }

    $('#modal-online').on('shown.bs.modal', () => {
        $('#noreg').focus()
    })

    $('#modal-online').on('hidden.bs.modal', () => {
        $('#alert').hide()
        $('#noreg').val('')
        $('#resultnoreg').val('')
        $('#tampilreg').html('')
        $('#simpanreg').prop('disabled', true)
    })

    $('#noreg').on('keypress', function(e) {
        e.preventDefault()
        let noreg = $(this).val()
        let resultnoreg = $('#resultnoreg').val()
        let key = e.which
        if (key !== 13) {
            return false
        }

        if (noreg == '') {
            return false
        }

        if (noreg == resultnoreg) {
            return false
        }

        $.ajax({
            url: '<?= base_url() ?>verifikasiberkas/ceknoreg',
            method: 'post',
            data: {
                noreg
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 400) {
                    $('#alert').removeClass('alert-success')
                    $('#alert').addClass('alert-danger').show().html('Gagal! Data tidak ditemukan')
                    $('#noreg').focus().select()
                    return false
                }

                $('#alert').removeClass('alert-danger')
                $('#alert').addClass('alert-success').show().html('Yeaayy! Data berhasil ditemukan')
                $('#resultnoreg').val(noreg)
                $('#simpanreg').prop('disabled', false)
                loadDataReg(noreg)
            }
        })
    })

    const loadDataReg = noreg => {
        $.ajax({
            url: '<?= base_url() ?>verifikasiberkas/loaddatareg',
            method: 'post',
            data: {
                noreg
            },
            success: function(data) {
                $('#tampilreg').html(data)
            }
        })
    }

    $('#simpanreg').on('click', function() {
        let noreg = $('#resultnoreg').val()
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Data yang sudah disimpan tidak bisa digagalkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjut!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>verifikasiberkas/setreg',
                    method: 'post',
                    data: {
                        noreg
                    },
                    success: function(data) {
                        let status = data.status
                        if (status == 400) {
                            toastr.error('Gagal! Kesalahan server')
                            return false
                        }

                        toastr.success('Yeaay! Satu data berhasil ditambahkan')
                        $('#modal-online').modal('hide')
                        $('#resultplatform').val()
                        loaddata()
                    }
                })
            }
        })
    })
</script>
</body>

</html>