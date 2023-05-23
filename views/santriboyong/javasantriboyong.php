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


    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "1000"
    }


    async function loaddata() {
        const [
            nama,
            status,
            bulan,
            periode
        ] = [
            $('#nama').val(),
            $('#status').val(),
            $('#bulan').val(),
            $('#periode').val()
        ]
        try {
            const data = await $.ajax({
                url: "<?= base_url() ?>santriboyong/loaddata",
                method: "post",
                data: {
                    nama,
                    status,
                    bulan,
                    periode
                }
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


    $(function() {
        loaddata()
    })


    const getdetail = id => {
        getDetailSantri(id)
    }



    function getDetailSantri(id) {
        $.ajax({
            url: '<?= base_url() ?>santriboyong/getdetail',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#modal-detail').modal('show')
                $('#tampildetaildata').html(data)
            }
        })
    }

    const selesaikan = id => {
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
                    url: '<?= base_url() ?>santriboyong/selesaikanproses',
                    method: 'post',
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: data => {
                        const hasil = data.hasil
                        if (hasil == 500) {
                            toastr.error('Opss! Server sedang sibuk nih')
                            return false
                        }
                        toastr.success('SIIP..!! Satu data berhasil diselesaikan')
                        getDetailSantri(id)
                    }
                })
            }
        })
    }


    $('#modal-lg').on('shown.bs.modal', () => {
        $('#idsantri').focus()
    })


    $('#modal-lg').on('hidden.bs.modal', () => {
        $('#idsantri').val('')
        $('.tampilhasil').hide()
        $('#tombolCek').show()
        $('#tombolSimpan').hide()
        $('#wakilwali').prop('checked', false)
        $('#idsantriboyong').val('')
        $('#alasan').val('')
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
        }, 3000);
    }


    const tombolCek = $('#tombolCek')
    tombolCek.on('click', () => {
        const idSantri = $('#idsantri').val()
        idSantri === '' && toastr.error('Masukkan ID Santri')
        idSantri !== '' && cekIDSantri(idSantri)
    })


    $('#idsantri').on('keyup', function(e) {
        let id = $(this).val()
        let key = e.which
        if (key != 13) {
            return false
        }

        if (key == 13 && id == '') {
            toastr.error('Masukkan ID Santri')
            return false
        }

        cekIDSantri(id)
    })


    const cekIDSantri = id => {
        $.ajax({
            url: '<?= base_url() ?>santriboyong/cekidsantri',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: data => {
                console.log(data);
                const hasil = data.hasil
                if (hasil !== 0) {
                    toastr.error(hasil)
                } else {
                    $('.tampilhasil').slideToggle()
                    tombolCek.hide()
                    $('#tombolSimpan').show()
                    $('#idsantriboyong').val(data.data)
                    hasilSukses(data.data)
                }
            }
        })
    }


    const hasilSukses = id => {
        $.ajax({
            url: '<?= base_url() ?>santriboyong/gethasilsukses',
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
        alasan === '' && munculAlert('Masukkan Alasan Boyong')
        alasan !== '' && simpanBoyong(alasan)
    })


    const simpanBoyong = alasan => {
        const idBoyong = $('#idsantriboyong').val()
        $.ajax({
            url: '<?= base_url() ?>santriboyong/simpanboyong',
            method: 'post',
            data: {
                id: idBoyong,
                alasan: alasan
            },
            dataType: 'json',
            success: data => {
                const hasil = data.hasil
                hasil === 1 && toastr.success('SIIIPP..!! Satu data berhasil ditambahkan')
                $('#modal-lg').modal('hide')

                loaddata()

                window.open('<?= base_url() ?>santriboyong/getLinkPrint/' + idBoyong, '_blank')
            }
        })
    }


    $('#wakilwali').on('change', function() {
        if ($(this).is(':checked')) {
            const idBoyong = $('#idsantriboyong').val()
            let param =
                `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=1000,height=370,left=150,top=100`;
            window.open("<?= base_url('santriboyong/getLink/') ?>" + idBoyong, "Input Data Wakil Wali",
                param)
        }
    })


    $('#tombolbatal').on('click', () => {
        const idBoyong = $('#idsantriboyong').val()
        if (idBoyong !== '') {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Membatalkan Proses Santri Boyong',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>santriboyong/batalkanproses',
                        method: 'post',
                        data: {
                            id: idBoyong
                        }
                    })
                    $('#modal-lg').modal('hide')
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


    const hapus = id => {
        Swal.fire({
            title: 'Anda Yakin?',
            text: 'Membatalkan Proses Santri Boyong',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>santriboyong/batalkanproses',
                    method: 'post',
                    data: {
                        id
                    },
                    success: function(data) {
                        loaddata()
                        $('#modal-detail').modal('hide')
                    }
                })
            }
        })
    }
</script>
</body>

</html>