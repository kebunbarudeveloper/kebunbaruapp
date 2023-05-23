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
const [
    kategori,
    tipe
] = [
    $('#kategorilogin').val(),
    $('#tipelogin').val()
]

const loadDataBawahan = kategori => {
    $.ajax({
        url: "<?= base_url() ?>aturbawahan/loadDataJabatan",
        method: "post",
        data: {
            id: kategori,
            tipe: tipe
        },
        success: html => {
            $('#tampildatajabatan').html(html)
        }
    })
}

$(function() {
    loadDataBawahan(kategori)
})


$('#tombolaturjabatan').on('click', () => {
    kategori == 6 && $('.divbagianketua2').show()

    $.ajax({
        url: "<?= base_url() ?>aturbawahan/getJabatanPerkategori",
        method: "post",
        data: {
            kategori: kategori
        },
        dataType: "json",
        success: (data) => {
            var html = '';
            var i;
            html += '<option value="">..:Pilih Jabatan:..</option>'
            for (i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].id_jabatan + '">' + data[i]
                    .nama_jabatan + '</option>';
            }
            $('#jabatanatur').html(html);
        }
    })
})


$('#bagianjabatan').on('change', function() {
    let bagian = $(this).val()
    let pecahBagian = bagian.split('-')
    $('#tipeatur').val(pecahBagian[1])

    //Ambil Data Pendidikan
    $.ajax({
        url: '<?= base_url() ?>aturbawahan/getpendidikan',
        method: 'post',
        data: {
            id: bagian
        },
        dataType: 'json',
        success: (data) => {
            var tampil = '';
            var i;
            tampil += '<option value="">..:Pilih Instansi:..</option>'
            for (i = 0; i < data.length; i++) {
                tampil += '<option value="' + data[i].nama_datapendidikan + '">' + data[i]
                    .nama_datapendidikan + '</option>';
            }
            $('#instansijabatan').html(tampil);
        }
    })
})


$('#modal-lagi').on('hidden.bs.modal', () => {
    $(this).find('input[type="text"]').val('').end()
    $(this).find('input[name="indukpengurus"]').val('').end()
    $(this).find('select').val('').end()
})


$('#pengurusjabatan').on('keypress', function() {
    $('#pengurusjabatan').autocomplete({
        source: "<?= base_url() ?>aturbawahan/getpengurus",
        select: function(event, ui) {
            $('#indukpengurus').val(ui.item.description);
            $('#bagianjabatan').focus()
        }
    });
})


$('#pengurusjabatan').on('focusout', function() {
    const induk = $('#indukpengurus').val()

    if ($(this).val() != '' && induk == '') {
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
                    `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1200,height=420,left=90,top=100`;
                window.open("<?= base_url('datapengurus/alternatif') ?>", "Input Data Pengurus", param)
            }
        })
    }
})


$('#pengurusjabatan').on('focusin', function() {
    $(this).val('')
    $('#indukpengurus').val('')
})


$('#tombolsimpanatur').on('click', function() {
    const kategoriatur = $('#kategoriatur').val()
    let modalx = $('#modal-lagi');
    let inputan = modalx.find('input[type="text"]').val()
    let induk = $('#indukpengurus').val()
    let pilihan = modalx.find('select').val()
    let bagian = $('#bagianjabatan').val()
    let kategori = $('#kategoriatur').val()
    let jabatan = $('#jabatanatur').val()

    if (kategoriatur == 6) {
        if (inputan == '' || pilihan == '' || induk == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan semua inputan sudah diisi'
            })
        } else {
            tambahAturJabatan()
        }
    } else {
        if (jabatan == '' || induk == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan semua inputan sudah diisi'
            })
        } else {
            tambahAturJabatan()
        }
    }
})


const tambahAturJabatan = () => {
    $.ajax({
        url: '<?= base_url() ?>aturbawahan/tambahaturjabatan',
        method: 'post',
        data: $('#formaturjabatan').serialize(),
        dataType: 'json',
        success: function(data) {

            console.log(data)

            if (data.hasil == 1) {
                toastr.success('SIIPPPPP...!! Satu jabatan berhasil diatur')
            } else {
                toastr.error('GAGAL...!! Jabatan yang sama sudah ada')
            }

            loadDataBawahan(kategori)
            $('.tampildetailpengurus').hide()
            $('#modal-lagi').find('input[type="text"]').val('');
            $('#modal-lagi').find('select').val('');
            $('#modal-lagi').modal('hide');
        }
    })
}






$('#tampildatajabatan').on('mouseover', '.detailjabatanpengurus', function() {
    $('[data-toggle="tooltip"]').tooltip()
})


$('#tampildatajabatan').on('click', '.detailjabatanpengurus', function() {
    const induk = $(this).data('id')
    detailPengurus(induk)
})


function detailPengurus(induk) {
    $.ajax({
        url: "<?= base_url() ?>aturbawahan/getDetail",
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
            let aksi = ['Aktifkan', 'Non-Aktifkan']
            let kelas = ['btn-success', 'btn-danger']
            let isiaksi = [1, 0]

            $('#statusdetail').text(status[data.status_jabatanpengurus])
            $('#namadetail').text(data.nama_pengurus)
            $('#tempatdetail').text(data.tempat_pengurus)
            $('#ttldetail').text(tanggalIndoM(data.tanggal_pengurus))
            $('#dusundetail').text(data.dusun_pengurus + ', RT/RW ' + data.rt_pengurus + '/' + data
                .rw_pengurus)
            $('#desadetail').text(data.desa_pengurus)
            $('#kecamatandetail').text(data.kec_pengurus)
            $('#kabupatendetail').text(data.kab_pengurus)
            $('#prodetail').text(data.pro_pengurus + ', ' + data.pos_pengurus)
            $('#hpdetail').text(data.hp_pengurus)
            $('#masukdetail').text(tanggalIndoH(data.masuk_pengurus))
            $('#iddetailjabatan').val(data.id_jabatanpengurus)
            $('#indukdetailjabatan').val(data.induk_pengurus)
            $('#isiaksi').val(isiaksi[data.status_jabatanpengurus])
            $('#idjabatan').val(data.jabatan_jabatanpengurus)
            $('#idbagian').val(data.bagian_jabatanpengurus)
            $('#idinstansi').val(data.instansi_jabatanpengurus)
            $('#tombolaksi').text(aksi[data.status_jabatanpengurus])
            $('#tombolaksi').addClass(kelas[data.status_jabatanpengurus])
            $('#idtampil').val(data.induk_pengurus)
        }
    })
}


$('#tombolaksi').on('click', function() {
    const induk = $('#indukdetailjabatan').val()
    const id = $('#iddetailjabatan').val()
    const isi = $('#isiaksi').val()
    const jabatan = $('#idjabatan').val()
    const bagian = $('#idbagian').val()
    const instansi = $('#idinstansi').val()

    let kata = ['Menon-Aktifkan', 'Mengaktifkan']

    Swal.fire({
        title: 'Anda Yakin?',
        text: 'Akan ' + kata[isi] + ' pengurus ini',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lanjut',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url() ?>aturbawahan/ubahstatus',
                method: 'post',
                data: {
                    id: id,
                    aksi: isi,
                    jabatan: jabatan,
                    bagian: bagian,
                    instansi: instansi
                },
                dataType: 'json',
                success: function(data) {
                    if (data.hasil == 1) {
                        toastr.success('SIIPP..!! Satu data berhasil diubah')

                        detailPengurus(induk)
                    } else {
                        toastr.error('GAGAL..!! Ada kesalahan saat mengirim data')
                    }
                }
            })
        }
    })
})
</script>
</body>

</html>