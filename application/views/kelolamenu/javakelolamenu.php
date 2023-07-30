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
function LoadAwal() {
    $.ajax({
        url: "<?= base_url() ?>kelolamenu/loadawal",
        method: "post",
        success: function(html) {
            $("#divtampildatamenu").html(html)
        }
    })
}

$(function() {
    LoadAwal()
})


function LoadDataMenu(kategori) {
    $("#divtampildatamenu").slideUp();
    $.ajax({
        url: "<?= base_url() ?>kelolamenu/LoadDataMenu",
        method: "post",
        data: {
            id: kategori
        },
        success: function(html) {
            $("#divtampildatamenu").slideDown('slow');
            $("#divtampildatamenu").html(html);
        }
    })
}


$('#pilihkategori').on('change', function() {
    const kategori = $(this).val()
    let katax = ['', 'Administrator', 'Pengasuh', 'Yayasan', 'Umum', 'Komisi I', 'Komisi II', 'Komisi III',
        'Komisi IV', 'Komisi V', 'Komisi VI', 'IASBA'
    ]
    if (kategori != '') {
        $('#divtomboltambahmenu').fadeIn('slow')
        $('#judultampilan').text(katax[kategori])
        $('#judulform').text(katax[kategori])
        $('#tomboltambahmenu').attr('data-id', kategori)
        $('#idkategori').val(kategori)

        LoadDataMenu(kategori)

        $.ajax({
            url: "<?= base_url() ?>kelolamenu/getjabatan",
            method: "post",
            data: {
                id: kategori
            },
            dataType: "json",
            success: function(data) {
                //console.log(data)
                var html = '';
                var i;
                html += '<option value="">..:Pilih Jabatan:..</option>'
                for (i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_jabatan + '">' + data[i]
                        .nama_jabatan + '</option>';
                }
                $('#namajabatan').html(html);
            }
        })
    } else {
        $('#divtomboltambahmenu').fadeOut('slow')
        $('#judultampilan').text('Perkategori')
        $('#judulform').text('Perkategori')

        LoadAwal()
    }

})


$('#modal-default').on('hidden.bs.modal', function() {
    $(this).find('input[type="text"]').val('').end()
    $(this).find('input[type="number"]').val('').end()
    $(this).find('select').val('').end()
})

$('#tombolsimpanmenu').on('click', function() {
    const jabatan = $('#namajabatan').val();
    const menu = $('#namamenu').val();
    const icon = $('#iconmenu').val();
    const urut = $('#urutmenu').val();
    if (jabatan == '' || menu == '' || icon == '' || urut == '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pastikan semua inputan sudah diisi'
        })
    } else {
        $.ajax({
            url: "<?= base_url() ?>kelolamenu/tambahmenu",
            method: 'post',
            data: $('#formtambahmenu').serialize(),
            dataType: 'json',
            success: function(data) {
                $('#modal-default').find('input[type="text"]').val('');
                $('#modal-default').find('input[type="number"]').val('');
                $('#modal-default').find('select').val('');
                $('#modal-default').modal('hide');

                if (data.id == 'gagal') {
                    toastr.error('Menu sudah ada sebelumnya')
                } else {
                    toastr.success('Satu data berhasil ditambahkan')
                    LoadDataMenu(data.id)
                }

            }
        })
    }
})

$('#divtampildatamenu').on('click', '.tombolubahstatusmenu', function() {
    const id = $(this).data('id')
    const status = $(this).data('status')
    const kategori = $(this).data('kategori')

    Swal.fire({
        title: 'Anda yakin?',
        text: 'Akan melakukan tindakan ini',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjutkan'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url() ?>kelolamenu/ubahstatus",
                method: "post",
                data: {
                    id: id,
                    status: status
                },
                dataType: 'json',
                success: function(data) {

                    if (data.hasil != 3) {
                        let kata = ['Dinon-Aktifkan', 'Diaktifkan']
                        Swal.fire(
                            'Siippp!',
                            'Satu menu berhasil ' + kata[data.hasil],
                            'success'
                        )
                        LoadDataMenu(kategori)
                    } else {
                        Swal.fire(
                            'Oopss!',
                            'Gagal update. Terjadi kesalahan',
                            'error'
                        )
                    }


                }
            })
        }
    })


})
</script>
</body>

</html>