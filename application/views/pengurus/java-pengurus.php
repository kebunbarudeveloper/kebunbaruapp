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

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "2000"
    }

    $('#modal-xl').on('hidden.bs.modal', function() {
        $('#showjabatan').hide()
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
            url: '<?= base_url() ?>pengurus/cekdata',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                let status = data.status
                if (status == 500) {
                    $('#showjabatan').hide()
                    $('#idsantri').focus().select()
                    $('#showresult').hide()
                    toastr.error(`Oppss...! ${data.message}`)
                    return false
                }

                getdatasantri(id)
            }
        })
    }

    const getdatasantri = id => {
        $.ajax({
            url: '<?= base_url() ?>pengurus/getdatasantri',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#showresult').show().html(data)
            }
        })
    }
</script>
</body>

</html>