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

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    $(function() {
        load()
    })

    const load = () => {
        $.ajax({
            url: '<?= base_url() ?>fotosantri/load',
            method: 'post',
            success: function(data) {
                $('#load').html(data)
            }
        })
    }

    $('#modal-lg').on('hidden.bs.modal', function() {
        $('#tombolsimpan').prop('disabled', true)
        $('#tampilupload').hide()
        $('#tampildata').hide()
        $('#idsantri').val('')
        $('#labelFoto').text('Pilih foto santri');
        $('#foto').val(0)
        $('#labelttd').text('Pilih foto ttd');
        $('#ttd').val(0)
        $('#id').val(0)
        $('#idttd').val(0)
    })

    $('#modal-lg').on('shown.bs.modal', function() {
        $('#idsantri').val('').focus()
    })

    $('#idsantri').on('keyup', function(e) {
        let id = $(this).val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (key == 13 && id == '') {
            return false
        }

        cekdata(id)
    })

    const cekdata = id => {
        $.ajax({
            url: '<?= base_url() ?>fotosantri/cekdata',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 500) {
                    toastr.error(`Oppss! ${ data.message }`);
                    return false
                }

                toastr.success('Yeayy.. Data berhasil ditemukan')
                $('#nama').html(data.nama)
                $('#domisili').html(data.domisili)
                $('#desa').html(data.desa)
                $('#kabupaten').html(data.kabupaten)
                $('#wali').html(data.wali)
                $('#nomor').html(data.nomor)
                $('#tampilupload').show()
                $('#tampildata').show()
                $('#tombolsimpan').prop('disabled', false)
                $('#id').val(id)
                $('#idttd').val(id)
            }
        })
    }

    $('#customFile').change(function() {
        var file = $('#customFile')[0].files[0].name;
        $('#labelFoto').text(file);
        $('#foto').val(1)
    });

    $('#fotottd').change(function() {
        var file = $('#fotottd')[0].files[0].name;
        $('#labelttd').text(file);
        $('#ttd').val(1)
    });

    $('#tombolsimpan').on('click', function() {
        let foto = $('#foto').val()
        let ttd = $('#ttd').val()
        if (foto != 1 || ttd != 1) {
            toastr.error('Pastikan foto santri dan ttd sudah dipilih')
            return false
        }

        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan foto santri dan ttd sudah dipilih',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                simpan()
                simpanttd()
            }
        })
    })

    const simpan = () => {
        let formData = new FormData($('#formupload')[0]);

        $.ajax({
            url: '<?= base_url() ?>fotosantri/simpan',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 500) {
                    toastr.error('Opppss.. Kesalahan server')
                    return false
                }

                toastr.success('Yeaahh... Foto berhasil diupload')
                $('#modal-lg').modal('hide')
                load()
            }
        })
    }

    const simpanttd = () => {
        let formData = new FormData($('#formuploadttd')[0]);

        $.ajax({
            url: '<?= base_url() ?>fotosantri/simpanttd',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 500) {
                    toastr.error('Opppss.. Kesalahan saat simpan foto ttd')
                    return false
                }
            }
        })
    }

    const hapus = id => {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Tindakan ini tidak bisa dibatalkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                action(id)
            }
        })
    }

    const selesai = id => {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Pastikan edit foto dan simpan ke folder foto santri',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                action(id)
            }
        })
    }

    const action = id => {
        $.ajax({
            url: '<?= base_url() ?>fotosantri/hapus',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 500) {
                    toastr.error('Oppss.. Kesalahan server')
                    return false
                }

                toastr.success('Yaahh.. Satu data berhasil dihapus')
                load()
            }
        })
    }
</script>
</body>

</html>