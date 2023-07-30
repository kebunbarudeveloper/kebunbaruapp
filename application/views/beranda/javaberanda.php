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
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/countUp/countUp-jquery.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "500"
    }

    const kategori = () => {
        $.ajax({
            url: '<?= base_url() ?>beranda/kategori',
            method: 'post',
            success: function(data) {
                $('#tampilKategori').html(data)
            }
        })
    }

    $(function() {
        kategori()
    })

    const detail = kamar => {
        $.ajax({
            url: '<?= base_url() ?>beranda/detail',
            method: 'post',
            data: {
                kamar
            },
            success: function(data) {
                $('#tampilKategori').html(data)
            }
        })
    }

    $('#pilihKamar').on('change', function() {
        const kamar = $(this).val()
        if (kamar == 111) {
            kategori()
        } else {
            detail(kamar)
        }
    })

    const detailKamar = (daerah, kamar) => {
        $.ajax({
            url: '<?= base_url() ?>beranda/detailkamar',
            method: 'post',
            data: {
                daerah,
                kamar
            },
            success: function(data) {
                $('#tampilKamar').html(data)
            }
        })
    }

    $('#tampilKategori').on('click', '.detailKamar', function() {
        const daerah = $(this).data('daerah')
        const kamar = $(this).data('kamar')

        $('#judul').text(`${daerah} - ${kamar}`)
        detailKamar(daerah, kamar)
    })

    $("#tampilKamar").on('click', '.copyID', function(event) {
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