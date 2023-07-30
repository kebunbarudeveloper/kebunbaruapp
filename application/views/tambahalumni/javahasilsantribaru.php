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
$('[data-mask]').inputmask();

const notif = $('.flashdata').data('flashdata');
if (notif) {
    toastr.success(notif)
}

$('#modal-editsantri').on('shown.bs.modal', function() {
    $('#niksantri').focus().select();
})

$('#modal-editwali').on('shown.bs.modal', function() {
    $('#nikwali').focus().select();
})

$('.inputdatasantri').keyup(function(e) {
    if (e.which == 13) {
        e.preventDefault();
        var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
        if (!$next.length) {
            $next = $('[tabIndex=1]');
        }
        $next.focus().select();
    }
});

$('input[name="rencanadomisili"]').on('change', function() {
    const [isi,
        kamarSantri,
        daerahSantri
    ] = [
        $(this).val(),
        $('#nomorkamarsantri'),
        $('#daerahsantri')
    ]

    isi === 'LP2K' && kamarSantri.prop('disabled', true)
    isi === 'LP2K' && daerahSantri.prop('disabled', true)
    isi === 'P2K' && kamarSantri.prop('disabled', false)
    isi === 'P2K' && daerahSantri.prop('disabled', false)

})


const getAlamat = (element, url, target) => {
    element.autocomplete({
        source: url,
        select: (event, ui) => {
            target.val(ui.item.description)
        }
    });
}

$(function() {
    const [
        elementPro,
        urlprovinsi,
        targetPro
    ] = [
        $('#provinsisantri'),
        $('#urldataprovinsi').val(),
        $('#idProvinsiSantri')
    ]

    getAlamat(elementPro, urlprovinsi, targetPro)

})

const elementKab = $('#kabupatensantri')
elementKab.on('keypress', function() {
    const [
        urlkab,
        idPro,
        targetKab
    ] = [
        $('#urldatakab').val(),
        $('#idProvinsiSantri').val(),
        $('#idKabSantri')
    ]
    const fixUrlKab = `${urlkab}/${idPro}`
    getAlamat(elementKab, fixUrlKab, targetKab)
})


const elementKec = $('#kecamatansantri')
elementKec.on('keypress', function() {
    const [
        urlkec,
        idKab,
        targetKec
    ] = [
        $('#urldatakec').val(),
        $('#idKabSantri').val(),
        $('#idKecSantri')
    ]
    const fixUrlKec = `${urlkec}/${idKab}`
    getAlamat(elementKec, fixUrlKec, targetKec)
})


const elementDesa = $('#desasantri')
elementDesa.on('keypress', function() {
    const [
        urldesa,
        idKec,
        targetDesa
    ] = [
        $('#urldatadesa').val(),
        $('#idKecSantri').val(),
        $('#kodepossantri')
    ]
    const fixUrlDesa = `${urldesa}/${idKec}`
    getAlamat(elementDesa, fixUrlDesa, targetDesa)
})


$('#tombolsimpaneditsantri').on('click', function() {
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menyimpan perubahan data",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#formeditsantri').submit()
        }
    })
})


$(function() {
    const [
        elementProWali,
        urlprovinsiwali,
        targetProWali
    ] = [
        $('#provinsiwali'),
        $('#urldataprovinsi').val(),
        $('#idProWali')
    ]
    getAlamat(elementProWali, urlprovinsiwali, targetProWali)
})


const elementKabWali = $('#kabupatenwali')
elementKabWali.on('keypress', function() {
    const [
        urlkabwali,
        idProwali,
        targetKabWali
    ] = [
        $('#urldatakab').val(),
        $('#idProWali').val(),
        $('#idKabWali')
    ]
    const fixUrlKabWali = `${urlkabwali}/${idProwali}`
    getAlamat(elementKabWali, fixUrlKabWali, targetKabWali)
})


const elementKecWali = $('#kecamatanwali')
elementKecWali.on('keypress', function() {
    const [
        urlkecwali,
        idKabwali,
        targetKecWali
    ] = [
        $('#urldatakec').val(),
        $('#idKabWali').val(),
        $('#idKecWali')
    ]
    const fixUrlKecWali = `${urlkecwali}/${idKabwali}`
    getAlamat(elementKecWali, fixUrlKecWali, targetKecWali)
})


const elementDesaWali = $('#desawali')
elementDesaWali.on('keypress', function() {
    const [
        urldesawali,
        idKecwali,
        tergetDesaWali
    ] = [
        $('#urldatadesa').val(),
        $('#idKecWali').val(),
        $('#kodeposwali')
    ]
    const fixUrlDesaWali = `${urldesawali}/${idKecwali}`
    getAlamat(elementDesaWali, fixUrlDesaWali, tergetDesaWali)
})

$('#tombolsimpateditwali').on('click', function() {
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Menyimpan perubahan data",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#formeditwali').submit()
        }
    })
})
</script>


</body>

</html>