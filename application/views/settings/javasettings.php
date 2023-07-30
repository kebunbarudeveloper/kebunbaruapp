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
        "timeOut": "1000"
    }

    $(document).ready(function() {
        loadsetoran()
    })

    const loadsetoran = () => {
        $.ajax({
            url: '<?= base_url() ?>settings/loadsetoran',
            method: 'get',
            success: function(data) {
                $('#panelsetsetoran').html(data)
            }
        })
    }

    const settingsetoran = () => {
        const setoran = $('#setoran').val()
        const batas = $('#batas').val()


        if (setoran == 111 || setoran == '' || batas == '') {
            $('#error').show()
            return false
        }

        $('#error').hide()

        $.ajax({
            url: '<?= base_url() ?>settings/setoran',
            method: 'post',
            data: {
                setoran,
                batas
            },
            dataType: 'json',
            success: function(data) {
                if (data.hasil == 0) {
                    $('#error').show().html(data.pesan)
                    return false
                }
                $('#error').hide()
                toastr.success(data.pesan)
                loadsetoran()
            }
        })
    }

    const resetsetoran = () => {
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Tindakan ini tidak bisa dicancel',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>settings/resetsetoran',
                    method: 'post',
                    success: function(data) {
                        if (data == 0) {
                            toastr.error('Gagal! Kesalahan server');
                        } else {
                            loadsetoran()
                            toastr.success('Sukses! Data berhasil direset')
                        }
                    }
                })
            }
        })

    }
</script>
</body>

</html>