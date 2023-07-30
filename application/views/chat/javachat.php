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
<script src="<?= base_url('assets') ?>/plugins/jquery-emoji/jquery.cssemoticons.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>
<script>
    $('.emoji').emoticonize();
    $(function() {
        scroll()
    })

    const save = () => {
        const message = $('#message').val()
        $.ajax({
            url: '<?= base_url() ?>chat/save',
            method: 'post',
            data: {
                message
            },
            success: function() {
                loadchat()
                const message = $('#message').val('').focus()
                scroll()
            }
        })
    }

    const loadchat = () => {
        $.ajax({
            url: '<?= base_url() ?>chat/load',
            method: 'get',
            success: function(data) {
                $('#panel').html(data)

            }
        })
    }

    $(document).ready(function() {
        loadchat()
        scroll()
    })

    const scroll = () => {
        $("#panel").animate({
            scrollTop: $('#panel').prop("scrollHeight")
        }, 1000);
    }

    setInterval(loadchat, 800);

    $('body').on('keyup', function(e) {
        if (e.keyCode === 13) {
            save()
        }
    })
</script>
</body>

</html>