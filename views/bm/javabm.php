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
<script src="<?= base_url('assets') ?>/plugins/jquery-emoji/jquery.cssemoticons.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>
<script>
    $('[data-mask]').inputmask();
    $(function() {
        load()
    })

    const load = () => {
        $.ajax({
            url: '<?= base_url() ?>checkinpeserta/load',
            method: 'post',
            success: function(data) {
                $('#tampildata').html(data)
            }
        })
    }

    const search = (el) => {
        const id = $(el).val()
        getdata(id)
    }

    const getdata = (id) => {
        $.ajax({
            url: '<?= base_url() ?>checkinpeserta/search',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#tampildata').html(data)
            }
        })
    }

    $('#modal-coba').on('shown.bs.modal', function() {
        // $('#nikwali').focus().select();
        $('#wa').focus().select();
    })
    $('#modal-coba').on('hidden.bs.modal', function() {
        // $('#nikwali').focus().select();
        $('#wa').val('');
    })

    const getid = (el) => {
        const id = $(el).data('id')
        $('#idbm').val(id)
    }

    $('#tombolSimpanNomor').on('click', function() {
        const id = $('#idbm').val()
        const wa = $('#wa').val()
        if (wa != '') {
            $.ajax({
                url: '<?= base_url() ?>checkinpeserta/save',
                method: 'post',
                data: {
                    id,
                    wa
                },
                success: function(data) {
                    const hasil = data.hasil
                    if (hasil == 0) {
                        toastr.error('Gagal menyimpan nomor')
                        return false
                    }
                    $('#modal-coba').modal('hide')
                    toastr.success('Nomor berhasil disimpan')
                    getdata(id)
                }
            })
        } else {
            toastr.error('Pastikan nomor HP sudah diisi')
            $('#wa').focus()
        }

    })
</script>
</body>

</html>