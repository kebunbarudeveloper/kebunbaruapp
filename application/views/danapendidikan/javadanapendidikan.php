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
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
$(document).ready(function() {
    $('.formatNominal').autoNumeric('init')
})

function loaddata() {
    $.ajax({
        url: "<?= base_url() ?>danapendidikan/loaddata",
        method: "post",
        success: function(data) {
            $('#tampildatatahunan').html(data)
        }
    })
}

$(function() {
    loaddata()
})


const [
    divgru,
    kategoritahunan,
    idkategoritahunan,
    tomboltambahdanapendidikan
] = [
    $('#divgrup'),
    $('#kategoritahunan'),
    $('#idkategoritahunan'),
    $('#tomboltambahdanapendidikan')
]


const aturTampilanSetelahPilihKategori = pilihan => {
    const target = ['', 'satu', 'dua', 'tiga', 'empat']
    idkategoritahunan.val(pilihan)
    pilihan == '' && tomboltambahdanapendidikan.hide()
    pilihan != '' && tomboltambahdanapendidikan.show()
    pilihan == '' && divgru.css('width', '300px')
    pilihan != '' && divgru.css('width', '400px')
    tomboltambahdanapendidikan.attr('data-target', `#modal-${target[pilihan]}`)
}

kategoritahunan.on('click', function() {
    const kelastahunan = $(this).val()
    aturTampilanSetelahPilihKategori(kelastahunan)
})
</script>
</body>

</html>