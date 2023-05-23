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
function loaddataprofilranting() {
    const urlprofilranting = $('#urlprofilranting').val();
    $.ajax({
        url: urlprofilranting,
        method: 'post',
        success: function(data) {
            $('#ajaxprofilranting').html(data)
        }
    })
}

$(function() {
    loaddataprofilranting()
})


$('#ajaxprofilranting').on('click', '#tombolmodaledit', function() {
    const urldataajax = $('#urldataajaxranting').val()

    $.ajax({
        url: urldataajax,
        method: "post",
        dataType: "json",
        success: function(data) {
            $('#nostatistik').val(data.no_statistik)
            $('#noidentitas').val(data.no_identitas)
            $('#noperanting').val(data.nope_ranting)
            $('#namayayasan').val(data.nama_yayasan)
            $('#akteyayasan').val(data.akte_yayasan)
            $('#pengasuh').val(data.pengasuh_yayasan)
            $('#tahunberdiriranting').val(data.tahun_berdiri)
            $('#tahunberdiriyayasan').val(data.tahun_berdiri_yayasan)
            $('#provinsiranting').val(data.pro_ranting)
            $('#kabranting').val(data.kab_ranting)
            $('#kecranting').val(data.kec_ranting)
            $('#desaranting').val(data.desa_ranting)
            $('#dusunranting').val(data.dusun_ranting)
            $('#rtranting').val(data.rt_ranting)
            $('#rwranting').val(data.rw_ranting)
            $('#posranting').val(data.pos_ranting)
            $('#emailranting').val(data.email_ranting)
        }
    })
})

$('[data-mask]').inputmask()



$(function() {
    const urlprovinsi = $('#urldataprovinsi').val();
    $('#provinsiranting').autocomplete({
        source: urlprovinsi,
        select: function(event, ui) {
            $('#idProvinsi').val(ui.item.description);
            // $('#kabranting').focus()

        }
    });
})


$('#kabranting').on('keypress', function() {

    let urlkab = $('#urldatakab').val();
    let idPro = $('#idProvinsi').val();

    $('#kabranting').autocomplete({
        source: urlkab + '/' + idPro + '/',
        select: function(event, ui) {
            $('#idKab').val(ui.item.description);
            // $('#kecranting').focus()
        }
    });
})


$('#kecranting').on('keypress', function() {

    let urlkec = $('#urldatakec').val();
    let idKab = $('#idKab').val();

    $('#kecranting').autocomplete({
        source: urlkec + '/' + idKab + '/',
        select: function(event, ui) {
            $('#idKec').val(ui.item.description);
            // $('#desaranting').focus()
        }
    });
})


$('#desaranting').on('keypress', function() {

    let urldesa = $('#urldatadesa').val();
    let idKec = $('#idKec').val();

    $('#desaranting').autocomplete({
        source: urldesa + '/' + idKec + '/',
        select: function(event, ui) {
            $('#posranting').val(ui.item.description);
            // $('#dusunranting').focus()
        }
    });
})



$('.inputeditranting').keyup(function(e) {
    if (e.which == 13) {
        e.preventDefault();
        var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
        if (!$next.length) {
            $next = $('[tabIndex=1]');
        }
        $next.focus();
    }
});


$('#tombolsimpaneditranting').on('click', function() {
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Akan melakukan perubahan data",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjutkan'
    }).then((result) => {
        if (result.isConfirmed) {
            let urlsimpanedit = $('#urleditranting').val();
            $.ajax({
                url: urlsimpanedit,
                method: "post",
                data: $('#formeditranting').serialize(),
                success: function() {
                    $('#modal-xl').modal('hide');

                    toastr.success('SIIIIP....!! Data berhasil diperbarui')

                    loaddataprofilranting()
                }
            })
        }
    })
})
</script>


</body>

</html>