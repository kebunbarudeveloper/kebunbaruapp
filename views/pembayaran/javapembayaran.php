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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })


    // $('#tampildataboyong').on('mouseover', '.posisimouse', function() {
    //     $(this).tooltip()
    // })


    const perkecilDiv = () => {
        $('#cardScrollDetail').overlayScrollbars({})
        $('#tampildataboyong').removeClass('col-12')
        $('#tampildataboyong').addClass('col-9')
        $('.tampildetailsantri').slideDown('slow')
        $('.hideKelas').hide()
    }


    const perbesarDiv = () => {
        $('#tampildataboyong').removeClass('col-9')
        $('#tampildataboyong').addClass('col-12')
        $('.tampildetailsantri').hide()
        $('.hideKelas').show()
    }

    async function loaddata() {
        try {
            const data = await $.ajax({
                url: "<?= base_url() ?>pembayaran/loaddata",
                method: "post"
            })
            $('#tampildataboyong').html(data)
            $('#cardScroll').overlayScrollbars({})
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loading(kataerror)
        }

    }


    function loading(kata) {
        const divLoading = `<div class="card" id="loading" style="height: 70vh;">
    <div class = "text-center" id = "gagal" >
        ${kata}
        </div>
    </div >`
        $('#tampildataboyong').html(divLoading)
    }

    loading('<img src = "<?= base_url() ?>assets/gif/load.gif" >')


    function loaddataDetail() {
        loaddata()
        perkecilDiv()
    }


    $(function() {
        loaddata()
    })


    $('#tampildataboyong').on('click', '.posisimouse', function() {
        const id = $(this).data('id')
        getDetailSantri(id)
    })


    const setFoto = (id, tipe, nama) => {
        const fotoAda = `<?= base_url('assets/fotosantri/') ?>${tipe}/${id}.jpg`
        const fotoGakAda = "<?= base_url('assets/fotosantri/coba.png') ?>"
        $.ajax({
            url: fotoAda,
            type: 'HEAD',
            success: function() {
                $('#gambardetail').attr('src', fotoAda)
            },
            error: function() {
                $('#gambardetail').attr('src', fotoGakAda)
            }
        })
        $('#gambardetail').attr('alt', nama)
    }


    function getDetailSantri(idSantri) {
        $.ajax({
            url: '<?= base_url() ?>pembayaran/getdetail',
            method: 'post',
            data: {
                id: idSantri
            },
            dataType: 'json',
            beforeSend: function() {
                $('.tampildetailsantri').slideUp('fast')
            },
            success: function(data) {
                if (data.hasil == 1) {
                    const [
                        idSantriHasil,
                        tipeSantriHasil,
                        namaSantriHasil
                    ] = [
                        data.data.id_santri,
                        data.data.tipe_santri,
                        data.data.nama_santri
                    ]
                    perkecilDiv()
                    setFoto(idSantriHasil, tipeSantriHasil, namaSantriHasil)

                    let status = ['Dalam proses', 'Resmi boyong']

                    let statusX = data.data.status_angket
                    statusX == 1 && $('#tampilselesaiboyong').hide()
                    statusX == 0 && $('#tampilselesaiboyong').show()

                    statusX == 1 && $('#divPrint').show()
                    statusX == 0 && $('#divPrint').hide()

                    // Tampilkan data
                    $('#iddataboyong').val(data.data.id_datasantriboyong)
                    $('#idsantriboyongaksi').val(data.data.id_santriboyong)
                    $('#statusdetail').text(status[data.data.status_angket])
                    $('#namadetail').text(namaSantriHasil)
                    $('#indukdetail').text(data.data.induk_santri)
                    $('#diniyahdetail').text(`${data.data.kelas_diniyah}, ${data.data.tingkat_diniyah}`)
                    $('#formaldetail').text(`${data.data.kelas_formal}, ${data.data.tingkat_formal}`)
                    $('#tempatdetail').text(data.data.tempat_lahir_santri)
                    $('#ttldetail').text(tanggalIndoM(data.data.tanggal_lahir_santri))
                    $('#dusundetail').text(data.data.dusun_santri)
                    $('#rtrwdetail').text(`RT ${data.data.rt_santri}/RW ${data.data.rw_santri}`)
                    $('#desadetail').text(data.data.desa_santri)
                    $('#kecamatandetail').text(data.data.kecamatan_santri)
                    $('#kabupatendetail').text(data.data.kabupaten_santri)
                    $('#provinsidetail').text(data.data.provinsi_santri)
                    $('#posdetail').text(data.data.kode_pos_santri)
                    $('#ayahdetail').text(data.data.ayah_santri)
                    $('#ibudetail').text(data.data.ibu_santri)
                    $('#walidetail').text(data.data.nama_wali)
                    $('#desadetailwali').text(data.data.desa_wali)
                    $('#kecamatandetailwali').text(data.data.kec_wali)
                    $('#kabupatendetailwali').text(data.data.kab_wali)
                    $('#provinsidetailwali').text(data.data.pro_wali)
                    $('#posdetailwali').text(data.data.pos_wali)
                    $('#tglAngket').text(tanggalIndoH(data.data.tanggal_angket))

                    data.data.tanggal_boyong == 0 && $('#tglBoyong').text('Belum selesai proses')
                    data.data.tanggal_boyong != 0 && $('#tglBoyong').text(tanggalIndoH(data.data
                        .tanggal_boyong))


                    $('#printAngket').attr('href', '<?= base_url() ?>pembayaran/getLinkAngket/' + data.data
                        .id_datasantriboyong)
                } else {
                    Swal.fire({
                        position: 'top',
                        icon: 'error',
                        title: 'Data tak ditemukan',
                        showConfirmButton: false,
                        timer: 800
                    })
                    perbesarDiv()
                }

            }
        })
    }


    $('#divaksiselesai').on('click', () => {
        const id = $('#iddataboyong').val()
        const idS = $('#idsantriboyongaksi').val()
        Swal.fire({
            title: 'Yakin?',
            text: 'Tindakan ini tidak bisa diubah lagi',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>pembayaran/selesaikanproses',
                    method: 'post',
                    data: {
                        id: id,
                        ids: idS
                    },
                    dataType: 'json',
                    success: data => {
                        const hasil = data.hasil
                        if (hasil !== 0) {
                            toastr.success('SIIP..!! Satu data berhasil diselesaikan')
                            loaddataDetail()
                            getDetailSantri(hasil)
                        } else {
                            loaddata()
                            toastr.error('GAGAL..!! Ada kesalahan saat proses')
                            perbesarDiv()
                        }
                    }
                })
            }
        })
    })


    $('#tutupdetail').on('click', () => {
        perbesarDiv()
    })


    $('#modal-lg').on('shown.bs.modal', () => {
        $('#idsantri').focus()
    })


    $('#modal-lg').on('hidden.bs.modal', () => {
        $('#idsantri').val('')
        $('.tampilhasil').hide()
        $('.pengurangan').hide()
        $('#tombolCek').show()
        $('#tombolSimpan').hide()
        $('#wakilwali').prop('checked', false)
        $('#idsantriboyong').val('')
    })


    const munculAlert = kata => {
        Swal.fire(
            'GAGAL',
            kata,
            'warning'
        )
    }


    const notifError = kata => {
        const divError = $('#notiferror')
        divError.slideDown('slow').text(kata)
        setTimeout(() => {
            divError.slideUp('slow')
        }, 5000);
    }


    const tombolCek = $('#tombolCek')
    tombolCek.on('click', () => {
        const idSantri = $('#idsantri').val()
        idSantri === '' && munculAlert('Masukkan ID Santri')
        idSantri !== '' && cekIDSantri(idSantri)
    })


    const cekIDSantri = idSantri => {
        $.ajax({
            url: '<?= base_url() ?>pembayaran/cekidsantri',
            method: 'post',
            data: {
                id: idSantri
            },
            dataType: 'json',
            success: data => {
                const hasil = data.hasil
                if (hasil !== 0) {
                    notifError(hasil)
                } else {
                    $('.tampilhasil').slideToggle()
                    $('#alasan').focus().val('')
                    tombolCek.hide()
                    $('#tombolSimpan').show()
                    $('#idsantriboyong').val(data.data)
                    $('#idpemasukan').val(data.idpemasukan)
                    $('#totaltarif').html(data.nominal)
                    $('#nominalval').val(data.nominalval)
                    $('#pendidikan').val(data.pendidikan)

                    let p = data.pengurangan
                    if (p !== 0) {
                        $('.pengurangan').slideToggle()
                        $('#pengurangan').val(data.pengurangan)
                        $('#idpengurangan').val(data.pengurangan)
                        $('#jenispengurangan').html(data.teks)
                        $('#idpotongan').html(data.potongan)
                        $('#potonganval').val(data.potonganval)
                    } else if (p === 0) {
                        $('#pengurangan').val('')
                        $('#pengurangan').prop('checked', false)
                        $('#idpengurangan').val('')
                        $('#potonganval').val('')
                    }
                    hasilSukses(data.data)
                }
            }
        })
    }


    const hasilSukses = id => {
        $.ajax({
            url: '<?= base_url() ?>pembayaran/gethasilsukses',
            method: 'post',
            data: {
                id: id
            },
            success: data => {
                $('#databoyong').html(data)
            }
        })
    }


    $('#formtambahboyong').on('keyup keypress', (e) => {
        const enter = e.keyCode || e.which
        enter === 13 && e.preventDefault()
    })


    $('#tombolSimpan').on('click', () => {
        const alasan = $('#alasan').val()
        const alasani = parseInt($('#alasan').val())
        const tarif = parseInt($('#nominalval').val())

        // alert(tarif)
        if (alasan === '') {
            munculAlert('Masukkan Nominal Pembayaran')
        } else if (alasani > tarif) {
            munculAlert('Pastikan Nominal tidak lebih besar dari biaya tahunan')
        } else {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Melanjutkan Proses Pembayaran',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    simpanBoyong(alasan)
                }
            })

        }

    })


    const simpanBoyong = alasan => {
        const id = $('#idpemasukan').val()
        const pendidikan = $('#pendidikan').val()
        const idpengurangan = $('#idpengurangan').val()
        const penguranganValue = $('#pengurangan')
        const potongan = $('#potonganval').val()
        let pengurangan = 0
        if (penguranganValue.is(':checked')) {
            pengurangan = idpengurangan
        }

        $.ajax({
            url: '<?= base_url() ?>pembayaran/simpanboyong',
            method: 'post',
            data: {
                id,
                alasan,
                pendidikan,
                pengurangan,
                potongan
            },
            dataType: 'json',
            success: data => {
                const hasil = data.hasil
                //console.log(hasil)
                hasil === 1 && toastr.success('SIIIPP..!! Satu data berhasil ditambahkan')
                $('#modal-lg').modal('hide')

                loaddata()
                perbesarDiv()

                window.open('<?= base_url() ?>pembayaran/getlinkangket/' + id, '_blank')
            }
        })
    }




    $('#tombolbatal').on('click', () => {
        const idpemasukan = $('#idpemasukan').val()
        if (idpemasukan !== '') {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Membatalkan Proses Pembayaran',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>pembayaran/batalkanproses',
                        method: 'post',
                        data: {
                            id: idpemasukan
                        }
                    })
                    $('#modal-lg').modal('hide')
                    $('#pengurangan').prop('checked', false)
                }
            })
        } else {
            $('#modal-lg').modal('hide')
        }
    })


    $('#refreshdata').on('click', () => {
        const idBoyong = $('#idsantriboyong').val()
        hasilSukses(idBoyong)
    })


    $('#printAngket').on('click', () => {
        const id = $('#iddataboyong').val()
        window.open(`<?= base_url() ?>pembayaran/getLinkAngket/${id}`)
    })


    let [
        img,
        modalImg,
        nama
    ] = [
        $('#gambardetail'),
        $('#gambarBesar'),
        $('#namaBesar')
    ]

    img.on('click', function() {
        $('#myModal').modal('show')
        modalImg.attr('src', $(this).attr('src'))
        nama.text($(this).attr('alt'))
    })
</script>
</body>

</html>