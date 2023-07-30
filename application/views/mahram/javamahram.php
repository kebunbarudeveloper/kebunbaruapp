<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url('assets/') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<!-- FILEPOND -->
<script src="<?= base_url('assets') ?>/plugins/filepond/filepond.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/filepond/filepond-plugin.js"></script>
<script src="<?= base_url('assets') ?>/plugins/filepond/filepond.js"></script>

<script>
    $('[data-mask]').inputmask()

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "3000"
    }

    async function loaddata() {
        const nama = $('#nama').val()
        const status = $('#status').val()
        const print = $('#print').val()
        try {
            const data = await $.ajax({
                url: "<?= base_url() ?>mahram/loaddata",
                method: "post",
                data: {
                    nama,
                    status,
                    print
                }
            })
            $('#tampildatamahram').html(data)
            $('#cardScroll').overlayScrollbars({})
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loading(kataerror)
        }

    }


    function loading(kata) {
        const divLoading = `<div class="card" id="loading" style="height: 70vh;">
    <div class = "text-center" id = "gagal" >
        ${kata}
        </div>
    </div >`
        $('#tampildatamahram').html(divLoading)
    }

    loading('<img src = "<?= base_url() ?>assets/gif/load.gif" >')


    $(function() {
        loaddata()
    })

    $('#modal-lg').on('shown.bs.modal', () => {
        $('#idsantri').focus()
        $('#cekFoto').val(0)
        $('#tipewali').val(0)
        $('#idwalistatis').val('1')
        $('#opsifiroq').val(111)
        $('#idsantri').prop('readOnly', false);
        $('#opsifiroq').prop('disabled', false);
    })

    $('#modal-lg').on('hidden.bs.modal', () => {
        $('#tipewali').val(0)
        $('#idsantri').val('')
        $('#tampilSuksesData').html(`<div class="col-6">
                        <div class="callout callout-warning">
                            <h6>WARNING!</h6>
                            <ol>
                                <li>Pastikan Nomor HP Wali sudah valid</li>
                                <li>Setelah proses pengecekan sukses, pastikan foto diupload</li>
                            </ol>
                        </div>
                    </div>`)
        $('#tombolCek').show()
        $('#tombolSimpan').hide()
        $('#idwali').val('')
        $('#tampilFoto').hide()
        $('#idwalistatis').val(0)
        $('#opsifiroq').val(111)
        $('#idsantri').prop('readOnly', false);
        $('#opsifiroq').prop('disabled', false);
    })

    $('#modal-default').on('shown.bs.modal', () => {
        $('#nomorhpwali').val('').focus()
    })

    $('#modal-default').on('hidden.bs.modal', () => {
        $('#nomorhpwali').val('')
    })


    const munculAlert = kata => {
        Swal.fire(
            'GAGAL',
            kata,
            'warning'
        )
    }


    const tombolCek = $('#tombolCek')
    tombolCek.on('click', () => {
        const idSantri = $('#idsantri').val()
        const opsiFiroq = $('#opsifiroq').val()

        if (idSantri === '' || opsiFiroq == 111) {
            if (idSantri === '') {
                $('#idsantri').addClass('is-invalid')
            } else {
                $('#idsantri').removeClass('is-invalid')
            }

            if (opsiFiroq == 111) {
                $('#opsifiroq').addClass('is-invalid')
            } else {
                $('#opsifiroq').removeClass('is-invalid')
            }

            munculAlert('Pastikan ID dan Opsi Firoq sudah diisi')
        } else {
            cekIDSantri(idSantri, opsiFiroq)
        }
    })

    $('#modal-lg').on('hidden.bs.modal', () => {
        $('#opsifiroq').removeClass('is-invalid')
        $('#idsantri').removeClass('is-invalid')
    })


    const cekIDSantri = (idSantri, opsiFiroq) => {
        $.ajax({
            url: '<?= base_url() ?>mahram/cekidsantri',
            method: 'post',
            data: {
                id: idSantri,
                opsi: opsiFiroq
            },
            dataType: 'json',
            success: data => {
                const hasil = data.hasil
                if (hasil !== 0) {
                    toastr.error(hasil)
                } else {
                    $('#tampilFoto').show()
                    $('#labelFoto').text('Pilih foto wali');
                    tombolCek.hide()
                    $('#tombolSimpan').show()
                    $('#idwali').val(data.data.wali_santri)
                    $('#idwalinope').val(data.data.wali_santri)
                    $('#hasilfiroq').val(opsiFiroq)
                    $('#idsantri').prop('readOnly', true);
                    $('#opsifiroq').prop('disabled', true);
                    hasilSukses(data.data.wali_santri)
                }
            }
        })
    }


    const hasilSukses = nik => {
        $.ajax({
            url: '<?= base_url() ?>mahram/gethasilsukses',
            method: 'post',
            data: {
                nik
            },
            success: data => {
                $('#tampilSuksesData').show().html(data)
            }
        })
    }


    $('#formtambahboyong').on('keyup keypress', (e) => {
        const enter = e.keyCode || e.which
        enter === 13 && e.preventDefault()
    })


    $('#tombolSimpan').on('click', () => {
        const id = $('#nama').val()
        const cekFoto = $('#cekFoto').val()
        if (cekFoto == 0) {
            munculAlert('Foto belum dipilih')
        } else {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Pastikan foto sudah dipilih',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = new FormData($('#formupload')[0]);
                    $.ajax({
                        url: '<?= base_url() ?>mahram/upload',
                        method: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        dataType: 'json',
                        success: function(data) {
                            if (data >= 1) {
                                toastr.success('Data berhasil ditambah')
                                loaddata()
                            } else {
                                toastr.error('Gagal. Kesalahan server')
                            }
                            $('#modal-lg').modal('hide')

                        }
                    })
                }
            })
        }

    })

    $('#tombolbatal').on('click', () => {
        const idwali = $('#idwali').val()
        if (idwali !== '') {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Membatalkan Proses',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#modal-lg').modal('hide')
                }
            })
        } else {
            $('#modal-lg').modal('hide')
        }
    })

    $('#tombolSimpanNomor').on('click', function() {
        const nomor = $('#nomorhpwali').val()
        const nik = $('#idwalinope').val()
        if (nomor == '') {
            munculAlert('Pastikan nomor HP telah diisi dengan benar')
        } else {
            $.ajax({
                url: '<?= base_url() ?>mahram/updatenomor',
                method: 'post',
                data: {
                    nomor,
                    nik
                },
                dataType: 'json',
                success: function(data) {
                    if (data >= 1) {
                        hasilSukses(nik)
                        toastr.success('Nomor HP berhasil diupdate')
                    } else {
                        toastr.error('Gagal Update. Kesalahan Server')
                    }
                    $('#modal-default').modal('hide')
                }
            })
        }
    })

    $('#customFile').change(function() {
        var file = $('#customFile')[0].files[0].name;
        $('#labelFoto').text(file);
        $('#cekFoto').val(1)
    });

    $('#tombolsimpanwalistatis').on('click', function() {
        const [
            nama,
            nope,
            desa,
            kab
        ] = [
            $('#namawalistatis').val(),
            $('#nopewalistatis').val(),
            $('#desawalistatis').val(),
            $('#kabwalistatis').val()
        ]

        if (nama == '' || nope == '' || desa == '' || kab == '') {
            munculAlert('Pastikan semua inputan sudah terisi')
            return false
        }

        $.ajax({
            url: '<?= base_url() ?>mahram/walistatis',
            method: 'post',
            data: {
                nama,
                nope,
                desa,
                kab
            },
            dataType: 'json',
            success: function(data) {
                $('#tipewali').val(1)
                $('#idwalistatis').val(data.hasil)

                $('#namawalistatis').val('')
                $('#nopewalistatis').val('')
                $('#desawalistatis').val('')
                $('#kabwalistatis').val('')
                $('#modal-wakil').modal('hide')

                toastr.success('Wakil wali berhasil ditambahkan')
            }
        })
    })

    $('#modal-wakil').on('shown.bs.modal', () => {
        $('#namawalistatis').val('').focus()
        $('#nopewalistatis').val('')
        $('#desawalistatis').val('')
        $('#kabwalistatis').val('')
    })

    $('#modal-wakil').on('hidden.bs.modal', () => {
        $('#namawalistatis').val('')
        $('#nopewalistatis').val('')
        $('#desawalistatis').val('')
        $('#kabwalistatis').val('')
    })

    const editdatamahram = i => {
        const id = $(i).data('id')

        $.ajax({
            url: '<?= base_url() ?>mahram/getdatamahram',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                const hasil = data.message
                if (hasil == 0) {
                    toastr.error('Kesalahan Server');
                    return false
                }

                $('#modal-edit').modal('show')
                $('#kabupatenmahram').val(data.data.kab)
                $('#desamahram').val(data.data.desa)
                $('#namamahram').val(data.data.nama)
                $('#nopemahram').val(data.data.nope)
                $('#idmahramedit').val(id)
            }
        })
    }


    $('#simpaneditmahram').on('click', function() {
        const kab = $('#kabupatenmahram').val()
        const desa = $('#desamahram').val()
        const nama = $('#namamahram').val()
        const nope = $('#nopemahram').val()
        if (kab == '' || desa == '' || nama == '' || nope == '') {
            munculAlert('Pastikan semua sudah terisi')
        } else {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Akan mengubah data',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    simpanedit()
                }
            })
        }

    })

    const simpanedit = () => {
        $.ajax({
            url: '<?= base_url() ?>mahram/simpanedit',
            method: 'post',
            data: $('#editdatamahram').serialize(),
            dataType: 'json',
            success: function(data) {
                const hasil = data.message
                if (hasil == 500) {
                    toastr.error('Gagal! Kesalahan server')
                    return false
                }
                const id = ''
                loaddata()
                toastr.success('Yeayy!! Satu data berhasil diubah')
                $('#modal-edit').modal('hide')
            }
        })
    }

    const pengajuan = element => {
        const id = $(element).data('id')

        $.ajax({
            url: '<?= base_url() ?>mahram/getdatamahram',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                const hasil = data.message
                if (hasil == 0) {
                    toastr.error('Kesalahan Server');
                    return false
                }

                $('#modal-pengajuan').modal('show')
                $('#alasanpengajuan').val('000')
                $('#idpengajuan').val(id)
            }
        })
    }

    $('#kirimpengajuan').on('click', function() {
        const alasan = $('#alasanpengajuan').val()
        if (alasan == '000') {
            munculAlert('Pastikan alasan sudah dipilih')
            $('#alasanpengajuan').addClass('is-invalid')
            return false
        }

        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Akan mengajukan duplikasi kartu',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>mahram/simpanpengajuan',
                    method: 'post',
                    data: $('#formpengajuan').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        const hasil = data.message
                        if (hasil == 500) {
                            toastr.error('Gagal! Kesalahan server')
                            return false
                        }
                        const id = ''
                        loaddata()
                        Swal.fire(
                            'Yeaaahh....',
                            'Pengajuan telah dikirim',
                            'success'
                        )
                        $('#modal-pengajuan').modal('hide')

                    }
                })
            }
        })
    })

    $('#modal-pengajuan').on('hidden.bs.modal', () => {
        $('#alasanpengajuan').removeClass('is-invalid')
    })

    const setaduan = el => {
        const id = $(el).data('id')
        const aduan = $(el).data('aduan')
        let kataaduan = ['', '', 'HILANG', 'RUSAK/SALAH DATA']

        $('#idaduan').val(id)
        $('#isiaduan').val(aduan)
        $('#teks-aduan').text(kataaduan[aduan])
    }

    const terimaaduan = () => {
        const id = $('#idaduan').val()
        const aduan = $('#isiaduan').val()
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Tindakan ini akan permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>mahram/terimaaduan',
                    method: 'post',
                    data: {
                        id,
                        aduan
                    },
                    dataType: 'json',
                    success: function(data) {

                        const hasil = data.message
                        if (hasil == 500) {
                            toastr.error('Gagal! Kesalahan server')
                            return false
                        }

                        loaddata()

                        Swal.fire({
                            title: 'Satu Lagi',
                            text: 'Langsung Print Out?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Lanjut',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open('<?= base_url() ?>mahram/print/' + data.id);
                            }
                        })
                        $('#modal-aduan').modal('hide')
                        $('#idaduan').val('')
                        $('#isiaduan').val('')
                    }
                })
            }
        })
    }

    $('#modal-print').on('shown.bs.modal', () => {
        $('#idkartu').val('').focus()
    })

    $('#modal-print').on('hidden.bs.modal', () => {
        loaddata()
    })

    const filterid = (el, e) => {
        if (e.keyCode == 13) {
            const id = $(el).val()
            if (id != '') {
                $.ajax({
                    url: '<?= base_url() ?>mahram/updateprint',
                    method: 'post',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(data) {
                        const hasil = data.hasil
                        if (hasil == 500) {
                            toastr.error('Gagal! Kesalahan server')
                            return false
                        }

                        toastr.success('Yes! Satu kartu berhasil diubah status')
                        $(el).val('').focus()
                    }
                })
            }
        }
    }

    const detail = el => {
        const id = $(el).data('id')
        $.ajax({
            url: '<?= base_url() ?>mahram/getdatamahram',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                const hasil = data.message
                if (hasil == 0) {
                    toastr.error('Kesalahan Server');
                    return false
                }

                getdetail(id)

                $('#modal-detail').modal('show')
            }
        })
    }

    const getdetail = id => {
        $.ajax({
            url: '<?= base_url() ?>mahram/getdetail',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#tampildetail').html(data)
            }
        })
    }
</script>
</body>

</html>