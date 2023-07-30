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
$(document).ready(() => {
    $('#cardScroll').overlayScrollbars({})
    $('#niksantri').focus()
})

$('[data-mask]').inputmask();

$('input[name="rencanadomisili"]').on('change', function() {

    let [
        isi,
        nomorKamar,
        daerah
    ] = [
        $(this).val(),
        $('#nomorkamarsantri'),
        $('#daerahsantri')
    ]

    isi == 'LP2K' && nomorKamar.prop('disabled', true)
    isi == 'LP2K' && daerah.prop('disabled', true)
    isi == 'P2K' && nomorKamar.prop('disabled', false)
    isi == 'P2K' && daerah.prop('disabled', false)


})


const errorRelate = (message, elem) => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message
    })
    elem.prop('checked', false)
}


$('#relateFather').on('change', function() {
    const fatherName = $('#ayahsantri').val()
    const thisElem = $(this)
    if (thisElem.is(':checked')) {
        if (fatherName == '') {
            errorRelate('Pastikan nama ayah santri sudah terisi', thisElem)
        } else {
            $('#namawali').val(fatherName).prop('readOnly', true)
            $('#nomorhpwali').focus()
        }
    } else {
        $('#namawali').val('').prop('readOnly', false).focus()
    }
})


$('#checkboxPrimary1').on('change', function() {
    const thisElemen = $(this)
    const [
        provinsisantri,
        kabupatensantri,
        kecamatansantri,
        desasantri,
        dusunsantri,
        rtsantri,
        rwsantri,
        kodepossantri
    ] = [
        $('#provinsisantri').val(),
        $('#kabupatensantri').val(),
        $('#kecamatansantri').val(),
        $('#desasantri').val(),
        $('#dusunsantri').val(),
        $('#rtsantri').val(),
        $('#rwsantri').val(),
        $('#kodepossantri').val()
    ]


    let = [
        provinsiwali,
        kabupatenwali,
        kecamatanwali,
        desawali,
        dusunwali,
        rtwali,
        rwwali,
        kodeposwali
    ] = [
        $('#provinsiwali'),
        $('#kabupatenwali'),
        $('#kecamatanwali'),
        $('#desawali'),
        $('#dusunwali'),
        $('#rtwali'),
        $('#rwwali'),
        $('#kodeposwali')
    ]


    if (thisElemen.is(':checked')) {

        if (provinsisantri == '' || kabupatensantri == '' || kecamatansantri == '' || desasantri == '' ||
            dusunsantri == '' || rtsantri == '' || rwsantri == '' || kodepossantri == '') {

            errorRelate('Pastikan semua alamat santri sudah terisi', thisElemen)
        } else {
            provinsiwali.val(provinsisantri).prop('readonly', true)
            kabupatenwali.val(kabupatensantri).prop('readonly', true)
            kecamatanwali.val(kecamatansantri).prop('readonly', true)
            desawali.val(desasantri).prop('readonly', true)
            dusunwali.val(dusunsantri).prop('readonly', true)
            rtwali.val(rtsantri).prop('readonly', true)
            rwwali.val(rwsantri).prop('readonly', true)
            kodeposwali.val(kodepossantri).prop('readonly', true)
        }

    } else {
        provinsiwali.val('').prop('readonly', false).focus()
        kabupatenwali.val('').prop('readonly', true)
        kecamatanwali.val('').prop('readonly', true)
        desawali.val('').prop('readonly', true)
        dusunwali.val('').prop('readonly', true)
        rtwali.val('').prop('readonly', false)
        rwwali.val('').prop('readonly', false)
        kodeposwali.val('').prop('readonly', true)
    }

})


$('.inputdatasantri').keypress(function(e) {
    if (e.which == 13) {
        e.preventDefault()
        let $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
        if (!$next.length) {
            $next = $('[tabIndex=1]');
        }
        $next.focus();
    }
});



const getAlamat = (element, url, target, elementTarget) => {
    element.autocomplete({
        source: url,
        select: (event, ui) => {
            target.val(ui.item.description)
            elementTarget.prop('readonly', false)
            elementTarget.focus()
        }
    });
}

const [
    elementKab,
    elementKec,
    elementDesa,
    elementRT
] = [
    $('#kabupatensantri'),
    $('#kecamatansantri'),
    $('#desasantri'),
    $('#dusunsantri')
]

$(function() {
    const urlprovinsi = $('#urldataprovinsi').val();
    const element = $('#provinsisantri')
    const target = $('#idProvinsiSantri')

    getAlamat(element, urlprovinsi, target, elementKab)
})


elementKab.on('keypress', () => {

    let urlkab = $('#urldatakab').val()
    let idPro = $('#idProvinsiSantri').val()
    const targetKab = $('#idKabSantri')
    const fixUrlKab = `${urlkab}/${idPro}/`

    getAlamat(elementKab, fixUrlKab, targetKab, elementKec)
})



elementKec.on('keypress', () => {

    let urlkec = $('#urldatakec').val();
    let idKab = $('#idKabSantri').val();
    const targetKec = $('#idKecSantri')
    const fixUrlKec = `${urlkec}/${idKab}/`

    getAlamat(elementKec, fixUrlKec, targetKec, elementDesa)
})


elementDesa.on('keypress', () => {

    let urldesa = $('#urldatadesa').val();
    let idKec = $('#idKecSantri').val();
    const targetDesa = $('#kodepossantri')
    const fixUrlDesa = `${urldesa}/${idKec}`
    getAlamat(elementDesa, fixUrlDesa, targetDesa, elementRT)
})



//Fungsi input data alamat wali
const [
    elementKabWali,
    elementKecWali,
    elementDesaWali,
    elementDusunWali
] = [
    $('#kabupatenwali'),
    $('#kecamatanwali'),
    $('#desawali'),
    $('#dusunwali')
]

$(function() {
    const urlprovinsiwali = $('#urldataprovinsi').val()
    const elementProWali = $('#provinsiwali')
    const targetProWali = $('#idProWali')

    getAlamat(elementProWali, urlprovinsiwali, targetProWali, elementKabWali)
})

elementKabWali.on('keypress', () => {

    const urlkabwali = $('#urldatakab').val()
    const idProwali = $('#idProWali').val()
    const fixUrlKabWali = `${urlkabwali}/${idProwali}`
    const targetKabWali = $('#idKabWali')

    getAlamat(elementKabWali, fixUrlKabWali, targetKabWali, elementKecWali)
})



elementKecWali.on('keypress', () => {

    const urlkecwali = $('#urldatakec').val()
    const idKabwali = $('#idKabWali').val()
    const fixUrlKecWali = `${urlkecwali}/${idKabwali}`
    const targetKecWali = $('#idKecWali')

    getAlamat(elementKecWali, fixUrlKecWali, targetKecWali, elementDesaWali)
})



elementDesaWali.on('keypress', () => {

    const urldesawali = $('#urldatadesa').val()
    const idKecwali = $('#idKecWali').val()
    const fixUrlDesaWali = `${urldesawali}/${idKecwali}`
    const targetDesaWali = $('#kodeposwali')

    getAlamat(elementDesaWali, fixUrlDesaWali, targetDesaWali, elementDusunWali)
})


$('#nikwali').on('focusout', function() {
    const nik = $(this).val()

    let [
        tipewali,
        namawali,
        nomorhpwali,
        provinsiwali,
        kecamatanwali,
        dusunwali,
        kabupatenwali,
        desawali,
        rtwali,
        rwwali,
        kodeposwali,
        pendidikanwali,
        pekerjaanwali,
        hubunganwali
    ] = [
        $('#tipewali'),
        $('#namawali'),
        $('#nomorhpwali'),
        $('#provinsiwali'),
        $('#kecamatanwali'),
        $('#dusunwali'),
        $('#kabupatenwali'),
        $('#desawali'),
        $('#rtwali'),
        $('#rwwali'),
        $('#kodeposwali'),
        $('#pendidikanwali'),
        $('#pekerjaanwali'),
        $('#hubunganwali')
    ]


    if (nik != '') {
        $.ajax({
            url: '<?= base_url() ?>santribaru/ceknikwali',
            method: 'post',
            data: {
                nik: nik
            },
            dataType: 'json',
            success: data => {
                let dataHasil = data[0]

                if (data.hasil == 1) {
                    Swal.fire({
                        title: 'NIK WALI SUDAH ADA',
                        text: 'Klik lanjut untuk isi data otomatis',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Lanjutkan',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            tipewali.val('lama')
                            namawali.val(data[0].nama_walisantri).prop('readonly', true)
                            nomorhpwali.val(data[0].nomor_hp_walisantri).prop('readonly',
                                true)
                            provinsiwali.val(data[0].provinsi_walisantri).prop('readonly',
                                true)
                            kecamatanwali.val(data[0].kecamatan_walisantri).prop(
                                'readonly', true)
                            dusunwali.val(data[0].dusun_walisantri).prop('readonly',
                                true)
                            kabupatenwali.val(data[0].kabupaten_walisantri).prop(
                                'readonly', true)
                            desawali.val(data[0].desa_walisantri).prop('readonly',
                                true)
                            rtwali.val(data[0].rt_walisantri).prop('readonly', true)
                            rwwali.val(data[0].rw_walisantri).prop('readonly', true)
                            kodeposwali.val(data[0].kode_pos_walisantri).prop(
                                'readonly',
                                true)
                            pendidikanwali.val(data[0].pendidikan_akhir_walisantri)
                            pekerjaanwali.val(data[0].pekerjaan_walisantri)
                            hubunganwali.val(data[0].hubungan_walisantri)
                        }
                    })
                }

            }
        })
    }
})


$('#tombolsimpansantri').on('click', e => {
    e.preventDefault()
    Swal.fire({
        title: 'Anda Yakin?',
        text: 'Pastikan semua sudah diisi lengkap dan benar',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#formtambahsantri').submit()
        }
    })
})
</script>


</body>

</html>