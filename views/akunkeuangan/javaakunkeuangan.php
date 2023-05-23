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
function loaddataakun() {
    $.ajax({
        url: "<?= base_url() ?>akunkeuangan/getdata",
        method: "post",
        success: function(data) {
            $('#divtampilakun').html(data)
            $('#cardScroll').overlayScrollbars({})
        }
    })
}

$(function() {
    loaddataakun()
})


$('#modal-default').on('shown.bs.modal', function() {
    $('#namaakun').focus();
})

$('#modal-default').on('hidden.bs.modal', function() {
    $(this).find('input[type="text"]').val('').end()
})


$('.tomboltambah').on('click', function() {
    const tipe = $(this).data('tipe');

    let kata = ['', 'Tambah Akun Pendapatan', 'Tambah Akun Belanja'];

    $('#judul').text(kata[tipe])
    $('#tipeakun').val(tipe)
    $('#tipeaksi').val('tambah')
})

$('#tombolsimpan').on('click', function() {
    const nama = $('#namaakun').val();
    if (nama == '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pastikan nama akun sudah diisi'
        })
    } else {
        tambahKeuangan()
    }
})


const tambahKeuangan = () => {
    $.ajax({
        url: "<?= base_url() ?>akunkeuangan/tambahakun",
        method: 'post',
        data: $('#formtambahakun').serialize(),
        dataType: 'json',
        success: data => {
            $('#modal-default').find('input[type="text"]').val('');
            $('#modal-default').modal('hide');

            const hasil = data.hasil
            hasil == 1 && toastr.success('SIIPP..!!! Satu data berhasil ditambahkan')
            hasil == 2 && toastr.success('SIIPP..!!! Satu data berhasil diubah')
            loaddataakun()
        }
    })
}


$('#divtampilakun').on('click', '.editdata', function() {
    const tipe = $(this).data('tipeedit')
    const id = $(this).data('id')
    const nama = $(this).data('nama')

    $('#namaakun').val(nama)
    $('#idedit').val(id)
    $('#tipeakun').val(tipe)
    $('#tipeaksi').val('edit')
})
</script>


</body>

</html>