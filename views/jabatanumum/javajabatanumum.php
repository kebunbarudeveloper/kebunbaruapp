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
$('body').on('mousemove', function() {
    $('#cardScroll').overlayScrollbars({})
})


const loadData = () => {
    $.ajax({
        url: "<?= base_url() ?>jabatanumum/loadDataJabatan",
        success: (data) => {
            $('#tampildatajabatan').html(data)
        }
    })
}


$(function() {
    loadData()
})


$('#tampildatajabatan').on('mouseover', '.detailjabatanpengurus', function() {
    $(this).tooltip()
})


let [
    kategori,
    jabatan,
    divtombol,
    idkategori,
    divakses,
    divjabatan
] = [
    $('#pilihkategori'),
    $('#tipejabatan'),
    $('#divtomboltambahmenu'),
    $('#idkategori'),
    $('#divakses'),
    $('#divjabatan')
]

kategori.on('change', function() {
    const id = $(this).val()
    id != '' && divtombol.show()
    id == '' && divtombol.hide()
    idkategori.val(id)

    id == 5 && divakses.show()
    id != 5 && divakses.hide()

    id == 5 && divjabatan.hide()
    id != 5 && divjabatan.show()

    id != 5 && getJabatan({
        id: id
    })

})


jabatan.on('change', function() {
    const akses = $(this).val()
    const id = 5

    divjabatan.show()
    getJabatan({
        id: id,
        akses: akses
    })
})


const getJabatan = (id) => {
    $.ajax({
        url: "<?= base_url() ?>jabatanumum/getjabatan",
        method: "post",
        data: id,
        dataType: "json",
        success: data => {
            let [html, i] = ['', ]
            html += '<option value="">..:Pilih Jabatan:..</option>'
            for (let i = 0; i < data.length; i++) {
                html += `<option value="${data[i].id_jabatan}">${data[i].nama_jabatan}</option>`
            }

            $('#jabatan').html(html)
        }
    })
}


$('#modal-default').on('hidden.bs.modal', function() {
    $(this).find('input[type="text"]').val('').end()
    $(this).find('select').val('').end()

    divjabatan.hide()
})


let [namapengurus, indukpengurus] = [$('#namapengurus'), $('#indukpengurus')]
namapengurus.on('keypress',
    function() {
        indukpengurus.val('');
        namapengurus.autocomplete({
            source: "<?= base_url() ?>jabatanumum/getpengurus",
            select: function(event, ui) {
                indukpengurus.val(ui.item.description);
            }
        });
    })



$('#tombolsimpan').on('click', function() {

    if (namapengurus.val() != '' && indukpengurus.val() == '') {
        Swal.fire({
            title: 'Ada Masalah',
            text: 'Nama yang Anda masukkan belum terdata sebagai pengurus',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah Data Pengurus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let param =
                    `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1200,height=400,left=90,top=100`;
                window.open("<?= base_url('datapengurus/alternatif') ?>", "Input Data Pengurus",
                    param)
            }
        })
    } else {
        let [
            jabatan,
            akses
        ] = [
            $('#jabatan').val(),
            $('#tipejabatan')
        ]

        idkategori.val() != 5 && akses.val(1)
        if (namapengurus.val() == '' || indukpengurus.val() == '' || jabatan == '' || akses.val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan semuan sudah terisi'
            })
        } else {
            $.ajax({
                url: "<?= base_url() ?>jabatanumum/tambahjabatanumum",
                method: "post",
                data: $('#formtambahjabatan').serialize(),
                dataType: "json",
                success: data => {
                    const hasil = data.hasil

                    if (hasil === 1) {
                        Swal.fire({
                            title: 'Mohon dicatat!',
                            html: `Nama : ${data.data.nama_pengguna} <br /> Username : ${data.data.username} | Password : 12345`,
                            icon: 'success',
                            allowOutsideClick: false
                        })
                    }

                    hasil == 0 && toastr.error(
                        'GAGAL..!! Jabatan sudah diisi dan masih aktif')

                    $('#modal-default').find('input[type="text"]').val('');
                    $('#modal-default').find('select').val('');
                    $('#modal-default').modal('hide');


                    $('.tampildetailpengurus').slideUp('fast')

                    loadData()
                }
            })
        }
    }
})


const getDetail = id => {
    let divdetail = $('.tampildetailpengurus')
    let kata = ['Non-Aktif', 'Aktif']

    $.ajax({
        url: "<?= base_url() ?>jabatanumum/getdetailjabatan",
        method: "post",
        data: {
            id: id
        },
        dataType: "json",
        beforeSend: () => {
            divdetail.slideUp('fast')
        },
        success: data => {
            const status = data.status_jabatanpengurus
            status == 0 && $('#tombolaksi').prop('disabled', true)
            status == 1 && $('#tombolaksi').prop('disabled', false)

            $('#statusdetail').text(kata[status])
            $('#namadetail').text(data.nama_pengurus)
            $('#tempatdetail').text(data.tempat_pengurus)
            $('#ttldetail').text(tanggalIndoM(data.tanggal_pengurus))
            $('#dusundetail').text(data.dusun_pengurus)
            $('#rtdetail').text(`RT ${data.rt_pengurus}/RW ${data.rw_pengurus}`)
            $('#desadetail').text(data.desa_pengurus)
            $('#kecamatandetail').text(data.kec_pengurus)
            $('#kabupatendetail').text(data.kab_pengurus)
            $('#prodetail').text(`${data.pro_pengurus}, ${data.pos_pengurus}`)
            $('#hpdetail').text(data.hp_pengurus || '--')
            $('#skdetail').text(`${tanggalIndoH(data.tanggal_jabatanpengurus)} H`)
            $('#idjabatandetail').val(data.id_jabatanpengurus)

            divdetail.slideDown('slow')
        }
    })
}

$('#tampildatajabatan').on('click', '.detailjabatanpengurus', function() {
    const id = $(this).data('id')
    getDetail(id)
})



$('#tombolaksi').on('click', function() {
    const id = $('#idjabatandetail').val()
    Swal.fire({
        title: 'Anda Yakin?',
        text: 'Tindakan ini tidak bisa diubah kembali',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url() ?>jabatanumum/nonaktif",
                method: "post",
                data: {
                    id: id
                },
                success: () => {
                    toastr.success(
                        'SIIPP..!! Satu data jabatan berhasil dinon-Aktifkan')

                    loadData()
                    $('.tampildetailpengurus').slideUp('fast')
                }
            })
        }
    })
})
</script>
</body>

</html>