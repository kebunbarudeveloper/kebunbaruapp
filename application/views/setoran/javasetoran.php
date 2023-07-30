<!-- jQuery -->
<script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<!-- Summernote -->
<script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/jquery-blink/jquery.blink.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>
<script>
    $(document).ready(function() {
        load()
        notif()
    })

    const load = () => {
        $.ajax({
            url: '<?= base_url() ?>setoran/load',
            method: 'post',
            success: function(data) {
                $('#panel').html(data)
            }
        })
    }

    const notif = () => {
        var el = $('#total')
        el.blink({
            delay: 300
        })
    }

    $('input[type=radio][name=tipe]').change(function() {
        let el = $('#total')
        if (this.value == 'full') {
            el.html('Rp. 125.000,00')
        } else if (this.value == 'porsi') {
            el.html('Rp. 65.000,00')
        }
    });

    $('input[type=radio][name=tanggal]').change(function() {
        let el = $('#paneltanggal')
        if (this.value == 'now') {
            el.hide()
        } else if (this.value == 'manual') {
            el.show()
        }
    });

    const coba = () => {
        let tgl = $('#tanggalmanual').val()

        alert(tgl)
    }

    const warning = (pesan) => {
        Swal.fire(
            'Oppsss...',
            pesan,
            'error'
        )
    }

    $('#idSantri').on('keyup', function(e) {
        const idsantri = $(this).val()
        if (e.keyCode == 13 && idsantri != '') {
            cekidsantri(idsantri)
        }
    })

    const buttoncheck = () => {
        const id = $('#idSantri').val()
        if (id != '') {
            cekidsantri(id)
        }
    }

    const cekidsantri = id => {
        $.ajax({
            url: '<?= base_url() ?>setoran/cekid',
            method: 'post',
            data: {
                id
            },
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                if (data.result == 0) {
                    $('#error').show().html(data.message)
                    $('#panelshowdata').html('')
                    $('#pilihpaket').hide()
                    $('#idSantri').prop('readOnly', false).select()
                    $('#buttoncheck').prop('disabled', false)
                    return false
                }

                showdata(data.message)
                $('#pilihpaket').show()
                $('#idSantri').prop('readOnly', true)
                $('#buttoncheck').prop('disabled', true)
            }
        })
    }


    const showdata = id => {
        $.ajax({
            url: '<?= base_url() ?>setoran/getid',
            method: 'post',
            data: {
                id
            },
            success: function(data) {
                $('#panelshowdata').html(data)
            }
        })
    }

    $('#modalsetoran').on('shown.bs.modal', function() {
        $('#error').hide()
        $('#panelshowdata').html('')
        $('#pilihpaket').hide()
        $('#idSantri').prop('readOnly', false).focus().val('')
        $('#buttoncheck').prop('disabled', false)
    })

    $('#modalsetoran').on('hidden.bs.modal', function() {
        $('#error').hide()
        $('#panelshowdata').html('')
        $('#pilihpaket').hide()
        $('#idSantri').prop('readOnly', false).val('')
        $('#buttoncheck').prop('disabled', false)
    })
</script>
</body>

</html>