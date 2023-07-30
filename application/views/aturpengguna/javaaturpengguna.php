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
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
function loadDataAwal() {
    $.ajax({
        url: "<?= base_url() ?>aturpengguna/loaddataawal",
        method: "post",
        success: function(html) {
            $('#tampildatapengguna').html(html)
        }
    })
}

$(function() {
    loadDataAwal()
})

function loadDataPengguna(kategori) {
    $.ajax({
        url: "<?= base_url() ?>aturpengguna/loaddatapengguna",
        method: "post",
        data: {
            id: kategori
        },
        success: function(html) {
            $('#tampildatapengguna').html(html)
        }
    })
}



$('#pilihkategori').on('change', function() {
    const kategori = $(this).val()

    let katax = ['', 'Administrator', 'Pengasuh', 'Yayasan', 'Umum', 'Komisi I', 'Komisi II', 'Komisi III',
        'Komisi IV',
        'Komisi V', 'Komisi VI', 'IASBA'
    ]
    if (kategori != '') {
        $('#juduldata').text(katax[kategori])

        loadDataPengguna(kategori)
    } else {
        $('#juduldata').text('')

        loadDataAwal()
    }

})




$('#tampildatapengguna').on('click', '.aksipengguna', function() {
    const [
        aksi,
        id,
        kategori,
        status
    ] = [
        $(this).data('aksi'),
        $(this).data('id'),
        $(this).data('kategori'),
        $(this).data('status')
    ]

    let kata = ['ditangguhkan', 'dibuka tangguhan', 'diaktifkan']

    Swal.fire({
        title: 'Anda Yakin?',
        text: `Pengguna ini akan ${kata[status]}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjutkan',
        cancelButtonText: 'Batal',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url() ?>aturpengguna/aksipengguna",
                method: "post",
                data: {
                    id: id,
                    aksi: aksi,
                    status: status
                },
                dataType: 'JSON',
                success: function(data) {
                    loadDataPengguna(kategori)

                    toastr.success(data)
                }
            })
        }
    })

})
</script>
</body>

</html>