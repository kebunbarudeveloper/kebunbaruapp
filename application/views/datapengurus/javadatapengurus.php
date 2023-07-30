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
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
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
$('body').on('mousemove', function() {
    $('#cardScroll').overlayScrollbars({})
})

function loadData() {
    $.ajax({
        url: "<?= base_url() ?>datapengurus/loadData",
        success: function(data) {
            $('#tampildata').html(data)
        }
    })
}

$(function() {
    loadData()
})

$('[data-mask]').inputmask();

$('.inputdatapengurus').keyup(function(e) {
    if (e.which == 13) {
        e.preventDefault();
        var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
        if (!$next.length) {
            $next = $('[tabIndex=1]');
        }
        $next.focus();
    }
})


$('#nikpengurus').on('focusout', function() {
    const nik = $(this).val()

    $.ajax({
        url: "<?= base_url() ?>datapengurus/getIDSantri",
        method: "post",
        data: {
            nik: nik
        },
        dataType: "json",
        success: function(data) {
            if (data.hasil == 1) {
                Swal.fire({
                    title: 'NIK sudah ada di Data Santri',
                    text: 'Klik lanjut untuk isi secara otomatis',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Lanjut',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let pecah = data.data.tanggal_lahir_santri.split('-')
                        $('#tgl').val(pecah[2])
                        $('#bln').val(pecah[1])
                        $('#thn').val(pecah[0])
                        $('#namapengurus').val(data.data.nama_santri)
                        $('#tempatpengurus').val(data.data.tempat_lahir_santri)
                        $('#propengurus').val(data.data.provinsi_santri)
                        $('#kecpengurus').val(data.data.kecamatan_santri)
                        $('#dusunpengurus').val(data.data.dusun_santri)
                        $('#kabpengurus').val(data.data.kabupaten_santri)
                        $('#desapengurus').val(data.data.desa_santri)
                        $('#rtpengurus').val(data.data.rt_santri)
                        $('#rwpengurus').val(data.data.rw_santri)
                        $('#pospengurus').val(data.data.kode_pos_santri)
                    }
                })
            }
        }
    })

})


$('#propengurus').on('keypress', function() {

    $('#propengurus').autocomplete({
        source: "<?= base_url() ?>datapengurus/getprovinsi",
        select: function(event, ui) {
            $('#idPro').val(ui.item.description);
        }
    });
})

$('#kabpengurus').on('keypress', function() {
    const idPro = $('#idPro').val()

    $('#kabpengurus').autocomplete({
        source: "<?= base_url() ?>datapengurus/getkab/" + idPro,
        select: function(event, ui) {
            $('#idKab').val(ui.item.description);
        }
    });
})


$('#kecpengurus').on('keypress', function() {
    const idKab = $('#idKab').val()

    $('#kecpengurus').autocomplete({
        source: "<?= base_url() ?>datapengurus/getkec/" + idKab,
        select: function(event, ui) {
            $('#idKec').val(ui.item.description);
        }
    });
})

$('#desapengurus').on('keypress', function() {
    const idKec = $('#idKec').val()

    $('#desapengurus').autocomplete({
        source: "<?= base_url() ?>datapengurus/getdesa/" + idKec,
        select: function(event, ui) {
            $('#pospengurus').val(ui.item.description);
        }
    });
})

$('#tomboltambah').on('click', function() {
    $('#tipe').val('tambah')
    $('#modal-xl').find('input[type="text"]').val('').end()
    $('#modal-xl').find('select').val('').end()
})

$('#modal-xl').on('hidden.bs.modal', function() {
    $('#modal-xl').find('input[type="text"]').val('').end()
    $('#modal-xl').find('select').val('').end()
})

$('#modal-xl').on('shown.bs.modal', function() {
    if ($('#tipe').val() == 'tambah') {
        $('#nikpengurus').focus()
    }
})



$('#tombolsimpan').on('click', function() {
    let modal = $('#modal-xl')
    let isian = modal.find('input[type="text"]').val()
    let pilih = modal.find('select').val()
    let bln = $('#bln').val()
    let thn = $('#thn').val()
    let hp = $('#hppengurus').val()

    if (isian == '' || pilih == '' || bln == '' || thn == '' || hp == '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pastikan inputan sudah terisi semua'
        })
    } else {
        $.ajax({
            url: "<?= base_url() ?>datapengurus/tambahpengurus",
            method: "post",
            data: $('#formtambahpengurus').serialize(),
            dataType: "json",
            success: function(data) {
                if (data == 0) {
                    toastr.error('GAGAL..!! NIK yang Anda masukkan sudah Ada')
                } else if (data == 1) {
                    toastr.success('SIPPPP..!! Satu data berhasil ditambahkan')
                } else {
                    detailPengurus(data)
                    toastr.success('SIPPPP..!! Satu data berhasil diubah')
                }


                $('#modal-xl').find('input[type="text"]').val('');
                $('#modal-xl').find('select').val('');
                $('#modal-xl').modal('hide');

                loadData()
            }
        })
    }
})


$('#tampildata').on('mouseover', '.detaildatapengurus', function() {
    $('[data-toggle="tooltip"]').tooltip()
})

$('#tampildata').on('click', '.detaildatapengurus', function() {
    const induk = $(this).data('id')
    detailPengurus(induk)
})


function detailPengurus(induk) {
    $.ajax({
        url: "<?= base_url() ?>datapengurus/getDetail",
        method: "post",
        data: {
            induk: induk
        },
        dataType: "json",
        beforeSend: function() {
            $('.tampildetailpengurus').slideUp('fast')
        },
        success: function(data) {
            $('.tampildetailpengurus').slideDown('slow')
            let status = ['Non-Aktif', 'Aktif']

            $('#statusdetail').text(status[data.status_pengurus])
            $('#namadetail').text(data.nama_pengurus)
            $('#tempatdetail').text(data.tempat_pengurus)
            $('#ttldetail').text(tanggalIndoM(data.tanggal_pengurus))
            $('#dusundetail').text(data.dusun_pengurus + ', RT/RW ' + data.rt_pengurus + '/' + data
                .rw_pengurus)
            $('#desadetail').text(data.desa_pengurus)
            $('#kecamatandetail').text(data.kec_pengurus)
            $('#kabupatendetail').text(data.kab_pengurus)
            $('#prodetail').text(data.pro_pengurus + ', ' + data.pos_pengurus)
            $('#masukdetail').text(tanggalIndoH(data.masuk_pengurus))

            $('#idtampil').val(data.induk_pengurus)
        }
    })
}


$('#menueditdata').click(function() {
    const idX = $('#idtampil').val()

    $.ajax({
        url: "<?= base_url() ?>datapengurus/getDetail",
        method: "post",
        data: {
            induk: idX
        },
        dataType: "json",
        beforeSend: function() {
            $('#modal-xl').find('input[type="text"]').val('').end()
            $('#modal-xl').find('select').val('').end()
        },
        success: function(data) {
            let pecah = data.tanggal_pengurus.split('-')

            $('#tipe').val('edit')
            $('#idPengurus').val(data.induk_pengurus)
            $('#nikpengurus').val(data.nik_pengurus)
            $('#hppengurus').val(data.hp_pengurus)
            $('#tempatpengurus').val(data.tempat_pengurus)
            $('#propengurus').val(data.pro_pengurus)
            $('#kecpengurus').val(data.kec_pengurus)
            $('#dusunpengurus').val(data.dusun_pengurus)
            $('#kelaminpengurus').val(data.kelamin_pengurus)
            $('#namapengurus').val(data.nama_pengurus)
            $('#tgl').val(pecah[2])
            $('#bln').val(pecah[1])
            $('#thn').val(pecah[0])
            $('#kabpengurus').val(data.kab_pengurus)
            $('#desapengurus').val(data.desa_pengurus)
            $('#rtpengurus').val(data.rt_pengurus)
            $('#rwpengurus').val(data.rw_pengurus)
            $('#pospengurus').val(data.pos_pengurus)
        }
    })
})
</script>
</body>

</html>