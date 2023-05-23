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
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "3000"
    }

    $(function() {
        loaddata()
    })

    const loaddata = () => {
        let platform = $('#resultplatform').val()
        $.ajax({
            url: '<?= base_url() ?>registrasipendidikan/loaddata',
            method: 'post',
            data: {
                platform
            },
            success: function(data) {
                $('#tampil').html(data)
            }
        })
    }

    $('#changePlatform').on('change', function() {
        $('#resultplatform').val($(this).val())
        loaddata()
    })

    $('#refresh').on('click', function() {
        $('#changePlatform').val('')
        $('#resultplatform').val('')
        loaddata()
        toastr.success('Data berhasil dimuat ulang')
    })

    $('[data-mask]').inputmask();

    $('#modal-tambah').on('shown.bs.modal', () => {
        $('#idd').focus()
    })

    $('#modal-tambah').on('hidden.bs.modal', () => {
        $('#formtambah')[0].reset();
        $('#simpan').prop('disabled', false)
        $('.messages').html('')
    })

    $('#simpan').on('click', function() {
        let idd = $('#idd').val()
        let kelasd = $('#kelasd').val()
        let tingkatd = $('#tingkatd').val()

        if (idd == '' || kelasd == '' || tingkatd == '') {
            toastr.error('Opppss.! Pastikan semua bidang inputan sudah diisi')
            return false
        }

        Swal.fire({
            title: 'Pastikan Data Sudah Valid',
            text: "Data yang Anda kirim tidak bisa diedit ulang",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>registrasipendidikan/simpan',
                    method: 'post',
                    data: $('#formtambah').serialize(),
                    dataType: 'json',
                    success: function(data) {

                        let status = data.status
                        if (status != 200) {
                            toastr.error(`Oppsss..! ${data.message}`)
                            return false
                        }

                        toastr.success(`Sukses! Satu murid baru diniyah ditambahkan`)
                        $('#modal-tambah').modal('hide')
                        loaddata()
                    }
                })
            }
        })

    })

    $('#modal-tambah-f').on('shown.bs.modal', () => {
        $('#idf').focus()
    })

    $('#modal-tambah-f').on('hidden.bs.modal', () => {
        $('#formtambahf')[0].reset();
        $('#simpanf').prop('disabled', false)
        $('.messages').html('')
    })

    $('#simpanf').on('click', function() {
        let idf = $('#idf').val()
        let kelasf = $('#kelasf').val()
        let tingkatf = $('#tingkatf').val()

        if (idf == '' || kelasf == '' || tingkatf == '') {
            toastr.error('Opppss.! Pastikan semua bidang inputan sudah diisi')
            return false
        }

        Swal.fire({
            title: 'Pastikan Data Sudah Valid',
            text: "Data yang Anda kirim tidak bisa diedit ulang",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>registrasipendidikan/simpanf',
                    method: 'post',
                    data: $('#formtambahf').serialize(),
                    dataType: 'json',
                    success: function(data) {

                        let status = data.status
                        if (status != 200) {
                            toastr.error(`Oppsss..! ${data.message}`)
                            return false
                        }

                        toastr.success(`Sukses! Satu murid baru formal ditambahkan`)
                        $('#modal-tambah-f').modal('hide')
                        loaddata()
                    }
                })
            }
        })

    })
</script>
</body>

</html>