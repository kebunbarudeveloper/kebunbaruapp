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
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('body').on('keyup', function(e) {
        if (e.keyCode == 113) {
            $('#namafilter').focus().select()
        }
    })

    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "500"
    }

    $(function() {
        loadData(nama = '')
    })


    const loadData = nama => {
        $.ajax({
            url: '<?= base_url() ?>cekdata/loaddata',
            method: 'post',
            data: {
                nama
            },
            success: function(data) {
                $('#tampildata').html(data)
                $('#namafilter').focus()
            }
        })
    }


    $('#namafilter').on('keyup', function(e) {
        const nama = $(this).val()
        if (e.keyCode == 13) {
            loadData(nama)
        }
    })

    $('#tombolCari').on('click', function() {
        const nama = $('#namafilter').val()
        loadData(nama)
    })

    $("#tampildata").on('click', '.copyID', function(event) {
        var $tempElement = $("<input>");
        $("body").append($tempElement);
        $tempElement.val($(this).closest(".copyID").find("span").text()).select();
        document.execCommand("Copy");
        $tempElement.remove();

        toastr.success('ID berhasil disalin')
    });
</script>
</body>

</html>