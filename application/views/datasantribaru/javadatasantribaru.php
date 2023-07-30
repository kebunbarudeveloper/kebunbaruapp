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
function loaddata() {
    const urlajax = $('#urlajax').val();
    $.ajax({
        type: 'POST',
        url: urlajax,
        success: function(html) {
            $('#ajaxview').html(html);
        }
    })
}

$(function() {
    loaddata()
})

const urlpage = $('#urlpagination').val();


function searchFilter(page_num) {
    page_num = page_num ? page_num : 0;
    const keywords = $('#keywords').val();
    const pendidikan = $('#pendidikan').val();
    $.ajax({
        type: 'POST',
        url: urlpage + '/' + page_num,
        data: 'page=' + page_num + '&keywords=' + keywords + '&pendidikan=' + pendidikan,

        success: function(html) {
            $('#dataList').html(html);
        }
    });
}

const urldetail = $('#urldetail').val();
$('#ajaxview').on('click', '.detaildatasantri', function() {
    const id = $(this).data('id')
    $.ajax({
        url: urldetail,
        method: 'post',
        data: {
            id: id
        },
        success: function(data) {
            $('#divdetail').html(data)
        }
    })
})
</script>

</body>

</html>