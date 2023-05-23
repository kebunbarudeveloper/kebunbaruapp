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

    async function loaddata() {
        try {
            const data = await $.ajax({
                url: "<?= base_url() ?>updatekelas/loaddata",
                method: "post"
            })
            $('#tampildata').html(data)
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
        $('#tampildata').html(divLoading)
    }

    loading('<img src = "<?= base_url() ?>assets/gif/load.gif" >')


    $(function() {
        loaddata()
    })

    const munculAlert = kata => {
        Swal.fire(
            'GAGAL',
            kata,
            'warning'
        )
    }

    async function filterdata() {
        const [
            kelas,
            tingkat
        ] = [
            $('#kelas').val(),
            $('#tingkat').val()
        ]

        try {
            const data = await $.ajax({
                url: "<?= base_url() ?>updatekelas/loaddata",
                method: "post",
                data: {
                    kelas,
                    tingkat
                }
            })
            $('#tampildata').html(data)
            $('#cardScroll').overlayScrollbars({})
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loading(kataerror)
        }

    }

    async function filterafter() {
        const [
            kelas,
            tingkat
        ] = [
            $('#kelaske').val(),
            $('#kamarke').val()
        ]

        try {
            const data = await $.ajax({
                url: "<?= base_url() ?>updatekelas/loaddata",
                method: "post",
                data: {
                    kelas,
                    tingkat
                }
            })
            $('#tampildata').html(data)
            $('#cardScroll').overlayScrollbars({})
        } catch (error) {
            const kataerror = '<h4 class="text-danger mt-5">GAGAL MEMUAT DATA</h4>'
            loading(kataerror)
        }

        $('#kelaske').val(111)
        $('#tingkatke').val(111)
        $('#kelas').val(111)
        $('#tingkat').val(111)
        $('#tombolsimpan').hide()

    }

    const showButton = () => {
        const d = $('#kelaske').val()
        const k = $('#tingkatke').val()
        let tombol = $('#tombolsimpan')

        if (d != 111 && k != 111) {
            tombol.show()
        } else {
            tombol.hide()
        }
        $('#kelasfiks').val(d)
        $('#tingkatfiks').val(k)
    }

    $('#tampildata').on('click', '.tomboltambah', function() {
        const id = $(this).data('id')
        let bidang = $('#id' + id)
        if (bidang.prop('checked') == true) {
            bidang.prop('checked', false)
        } else {
            bidang.prop('checked', true)
        }

        let total = $('#tampildata td input:checkbox:checked').length;
        if (total !== 0) {
            $('.bidangtotal').show()
            $('#total').text(total)
        } else {
            $('.bidangtotal').hide()
        }
    })

    $('#tombolsimpan').on('click', function() {
        let total = $('#tampildata td input:checkbox:checked').length;

        if (total === 0) {
            munculAlert('Pastikan Anda sudah memilih santri yang akan dimutasi')
        } else {
            Swal.fire({
                title: 'Anda Yakin?',
                text: 'Akan melakukan mutasi santri',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>updatekelas/simpan',
                        method: 'post',
                        data: $('#formmutasi').serialize(),
                        success: (data) => {
                            if (data > 0) {
                                toastr.success('Data berhasil diupdate')
                                filterafter()
                            } else {
                                toastr.error('Gagal. Kesalahan server')
                            }
                        }
                    })
                }
            })
        }
    })

    $('#kelas').on('click', function() {
        $('#kelasp').val($(this).val())
    })

    $('#tingkat').on('click', function() {
        $('#tingkatp').val($(this).val())
    })

    $('#tombolprint').on('click', function(e) {
        e.preventDefault()

        const kelas = $('#kelas').val()
        const tingkat = $('#tingkat').val()

        if (kelas == 111 || tingkat == 111) {
            munculAlert('Gagal! Pastikan domisili dan kamar asal telah dipilih')
        } else {
            $('#formPrint').submit()
        }
    })
</script>
</body>

</html>