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
<script src="<?= base_url('assets/') ?>/plugins/autoNumeric.js"></script>
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
    })

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "1000"
    }

    $('body').on('keyup', function(e) {
        if (e.keyCode == 113) {
            $('#idSantri').focus().select()
        }
    })

    $('#tombolCek').on('click', function() {
        const id = $('#idSantri').val()
        if (id != '') {
            cekData(id)
        } else {
            toastr.error('Pastikan ID tidak kosong')
            $('#tampil').hide()
        }
    })

    const setFoto = (id, tipe, nama) => {
        const fotoAda = `<?= base_url('assets/fotosantri/') ?>${tipe}/${id}.jpg`
        const fotoGakAda = "<?= base_url('assets/fotosantri/coba.png') ?>"
        $.ajax({
            url: fotoAda,
            type: 'HEAD',
            success: function() {
                $('#gambardetail').attr('src', fotoAda)
            },
            error: function() {
                $('#gambardetail').attr('src', fotoGakAda)
            }
        })
        $('#gambardetail').attr('alt', nama)
    }

    const cekData = id => {
        $.ajax({
            url: '<?= base_url() ?>hapusdata/cekdata',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                let hasil = data.hasil
                if (hasil == 0) {
                    toastr.error('Data tidak ditemukan')
                    $('#tampil').hide()
                } else if (hasil == 1) {
                    toastr.error('Akses dicegah')
                    $('#tampil').hide()
                } else {
                    $('#tampil').show()
                    setFoto(hasil.id_santri, hasil.tipe_santri, hasil.nama_santri)
                    $('#hasilid').text(hasil.id_santri)
                    $('#induk').text(hasil.induk_santri)
                    $('#nama').text(hasil.nama_santri)
                    $('#domisili').text(hasil.domisili_santri)
                    $('#kamar').text(hasil.nomor_kamar_santri)
                    $('#kelas').text(hasil.kelas_diniyah)
                    $('#tingkat').text(hasil.tingkat_diniyah)
                    $('#kelasf').text(hasil.kelas_formal)
                    $('#tingkatf').text(hasil.tingkat_formal)
                    $('#dusun').text(hasil.dusun_santri)
                    $('#rt').text(hasil.rt_santri)
                    $('#rw').text(hasil.rw_santri)
                    $('#dusun').text(hasil.dusun_santri)
                    $('#desa').text(hasil.desa_santri)
                    $('#kec').text(hasil.kecamatan_santri)
                    $('#kab').text(hasil.kabupaten_santri)
                    $('#provinsi').text(hasil.provinsi_santri)
                    $('#pos').text(hasil.kode_pos_santri)
                    $('#ayah').text(hasil.ayah_santri)
                    $('#simpan').attr('data-id', hasil.id_santri)
                }
                $('#idSantri').val('').focus()
            }
        })
    }

    $('#batal').on('click', function() {
        $('#tampil').hide()
        $('#idSantri').focus()
    })

    $('#idSantri').on('keyup', function(e) {
        const id = $(this).val()

        if (e.keyCode === 13) {
            if (id != '') {
                if (id.length < 8) {
                    toastr.error('ID Tidak valid')
                    $('#tampil').hide()
                } else {
                    cekData(id)
                }
            } else {
                toastr.error('Bidang inputan tidak boleh kosong')
                $('#tampil').hide()
            }
        }
    })

    $('#simpan').on('click', function() {
        const id = $(this).data('id')
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Akan menghapus data secara permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Lanjut'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>hapusdata/simpan',
                    method: 'post',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        const hasil = data.hasil
                        if (hasil > 0) {
                            toastr.success('Satu data berhasil dihapus')
                        } else {
                            toastr.error('Gagal, kesalahan server')
                        }
                        $('#tampil').hide()
                        $('#idSantri').focus()
                    }
                })
            }
        })

    })
</script>
</body>

</html>