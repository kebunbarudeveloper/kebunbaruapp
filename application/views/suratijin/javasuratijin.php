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
<script src="<?= base_url('assets/') ?>/plugins/autoNumeric.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
        tampilAwal()
    })

    toastr.options = {
        "positionClass": "toast-top-center"
    }

    async function tampilAwal() {
        try {
            const result = await $.ajax({
                url: '<?= base_url() ?>suratijin/getdata',
                method: 'post',
            })
            $('#tampilData').html(result)
        } catch (error) {
            const kataerror = '<div class="col-12"><div class="card">< class="card-body"><h6 class="text-danger text-center">Gagal Memuat Data..........</h6></div></div></div>'
            $('#tampilData').html(kataerror)
        }

    }

    saveData = id => {
        $.ajax({
            url: '<?= base_url() ?>suratijin/save',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                const hasil = data.hasil
                if (hasil == 1) {
                    toastr.error('Gagal! ID tidak ditemukan')
                } else if (hasil == 2) {
                    toastr.error('Gagal! Santri dengan ID tersebut sudah tidak aktif')
                } else if (hasil == 3) {
                    toastr.error('Gagal! Anda tidak punya hak akses untuk melayani')
                } else if (hasil == 4) {
                    toastr.error('Gagal! Santri dengan ID tersebut sudah mengambil surat ijin')
                } else if (hasil == 5) {
                    toastr.error('Gagal! Jadwal Daerah Pengambil Surat Belum Diset')
                } else if (hasil == 6) {
                    toastr.error('Gagal! Jenis Liburan belum diset')
                } else if (hasil == 7) {
                    toastr.error('Gagal! Daerah santri tidak cocok dengan jadwal')
                } else {
                    toastr.success('Satu data berhasil ditambahkan')
                    tampilData(id)
                    tampilAwal()
                }

                if (hasil != 0) {
                    $('#tampil').html('')
                }
                $('#idSantri').val('').focus()
            }
        })
    }

    tampilData = id => {
        $.ajax({
            url: '<?= base_url() ?>suratijin/getid',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#tampil').html(data)
            }
        })
    }

    $('#idSantri').on('keyup', function(e) {
        const id = $(this).val()
        if (e.keyCode === 13) {
            if (id != '') {
                if (id.length < 8) {
                    toastr.error('ID Tidak valid')
                } else {
                    saveData(id)
                }
            } else {
                toastr.error('Bidang inputan tidak boleh kosong')
            }
            $('#tampil').html('')
        }
    })


    $('#setliburanlagi').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan pergi ke pengaturan liburan`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '<?= base_url() ?>aturliburan'
            }
        })
    })


    const getSantriJadwal = kamar => {
        const liburan = $('#hiddenLiburan').val()
        const jadwal = $('#hiddenJadwal').val()
        $.ajax({
            url: '<?= base_url() ?>suratijin/getsantrijadwal',
            method: 'post',
            data: {
                kamar,
                liburan,
                jadwal
            },
            success: function(data) {
                $('#tampilPertama').html(data)
            }
        })
    }

    const getSantriJadwalStatus = (kamar, status) => {
        const liburan = $('#hiddenLiburan').val()
        const jadwal = $('#hiddenJadwal').val()
        $.ajax({
            url: '<?= base_url() ?>suratijin/getsantrijadwalstatus',
            method: 'post',
            data: {
                kamar,
                liburan,
                jadwal,
                status
            },
            success: function(data) {
                status == 1 && $('#tampilSudah').html(data)
                status == 2 && $('#tampilBelum').html(data)
            }
        })
    }


    $('#tampilData').on('click', '#jumlahPengambil', function() {
        const kamar = '';
        getSantriJadwal(kamar)
    })

    $('#tampilData').on('click', '#pilihkamarsemua', function() {
        const kamar = $(this).val()
        getSantriJadwal(kamar)
    })

    $('#tampilData').on('hidden.bs.modal', '#modal-kosong', function() {
        $('#pilihkamarsemua').val('')
    })

    $('#tampilData').on('click', '.jumlahStatus', function() {
        const kamar = '';
        const status = $(this).data('id')
        $('#hiddenStatus').val(status)
        getSantriJadwalStatus(kamar, status)
    })

    $('#tampilData').on('click', '#pilihkamarsudah', function() {
        const kamar = $(this).val()
        const status = $('#hiddenStatus').val()
        getSantriJadwalStatus(kamar, status)
    })

    $('#tampilData').on('hidden.bs.modal', '#modal-satu', function() {
        $('#pilihkamarsudah').val('')
    })


    $('#tampilData').on('click', '#pilihkamarbelum', function() {
        const kamar = $(this).val()
        const status = $('#hiddenStatus').val()
        getSantriJadwalStatus(kamar, status)
    })

    $('#tampilData').on('hidden.bs.modal', '#modal-dua', function() {
        $('#pilihkamarbelum').val('')
    })


    $('#tampil').on('click', '#batalSurat', function() {
        const id = $(this).data('id')
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan membatalkan proses`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>suratijin/batal',
                    method: 'post',
                    data: {
                        id
                    },
                    success: function(data) {
                        toastr.warning('Satu data berhasil dibatalkan')
                        $('#tampil').html('')
                        $('#idSantri').focus().val()
                        tampilAwal()
                    }
                })
            }
        })
    })
</script>
</body>

</html>