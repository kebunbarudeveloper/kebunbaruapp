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
<script src="<?= base_url('assets/') ?>/plugins/autoNumeric.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/') ?>/dist/js/demo.js"></script>
<script src="<?= base_url('assets/') ?>js/jslogout.js"></script>

<script>
    $('[data-mask]').inputmask();
    $('.jenis').on('click', function() {
        const id = $(this).data('id')
        let kata = ['', 'Maulid', 'Ramadhan']

        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan mengatur Liburan ${kata[id]}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>aturliburan/aturliburan',
                    method: 'post',
                    data: {
                        id
                    },
                    success: (data) => {
                        location.reload()
                    }
                })
            }
        })
    })


    $('#jadwal').on('change', function() {
        const id = $(this).val()
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan mengatur Daerah ${id}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>aturliburan/aturjadwal',
                    method: 'post',
                    data: {
                        id
                    },
                    success: (data) => {
                        location.reload()
                    }
                })
            } else {
                $('#jadwal').val('').select()
            }
        })
    })


    $('#filterdomisili').on('change', function() {
        $('#filterDaerah').val($(this).val())
    })

    $('#pilihdomisili').on('change', function() {
        $('#filterDaerahLagi').val($(this).val())
    })


    $('#tombolprint').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan Print Out`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formPrint').submit()
                $('#filterdomisili').val('').select()
            }
        })
    })

    $('.tombolZona').on('click', function() {
        const zone = $(this).data('id')
        const zoneText = ['', 'Zona Atas', 'Zona Bawah']
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan Mengatur ke ${zoneText[zone]}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>aturliburan/zone',
                    method: 'post',
                    data: {
                        zone
                    },
                    success: function(data) {
                        location.reload()
                    }
                })
            }
        })
    })


    $('#simpanTanggal').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Pastikan semua bidang inputan sudah terisi`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formTangal').submit()
            }
        })
    })

    $('#print').on('click', function() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: `Akan Print Out`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjut',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#formPrintLagi').submit()
                $('#domisili').val('').select()
            }
        })
    })

	$('#print-banat').on('click', function() {
		Swal.fire({
			title: 'Anda Yakin?',
			text: `Akan Print Out`,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Lanjut',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				$('#form-print-banat').submit()
			}
		})
	})
</script>


</body>

</html>
