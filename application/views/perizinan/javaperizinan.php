<!-- jQuery -->
<script src="<?= base_url('assets/') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="<?= base_url('assets/') ?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
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
		$('[data-mask]').inputmask();
	})


	toastr.options = {
		"positionClass": "toast-top-center",
		"timeOut": "1000"
	}


	async function loaddata() {
		const [
			nama,
			status,
			bulan
		] = [
			$('#nama').val(),
			$('#status').val(),
			$('#bulan').val()
		]
		try {
			const data = await $.ajax({
				url: "<?= base_url() ?>perizinan/loaddata",
				method: "post",
				data: {
					nama,
					status,
					bulan
				}
			})
			$('#tampil-data-perizinan').html(data)
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
		$('#tampil-data-perizinan').html(divLoading)
	}

	loading('<img src = "<?= base_url() ?>assets/gif/load.gif" >')

	$(function() {
		loaddata()
	})

	const getAlasan = () => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/getalasan',
			method: 'post',
			success: function(data) {
				$('#alasan').html(data)
			}
		})
	}

	const setAlasan = el => {
		let alasan = $(el).val()
		if (alasan == 'other') {
			$('#alasan').hide()
			$('.alasan-lain').show().focus()
			$('#tipe-alasan').val(1)
			return false
		}

		$('#tipe-alasan').val(0)
		$('.alasan-lain').hide()
		$('#alasan').show()
	}

	const cancelOther = () => {
		$('#tipe-alasan').val(0)
		$('.alasan-lain').hide()
		$('#alasan').show()
		$('#alasan').val('')
	}

	$('#modal-lg').on('shown.bs.modal', () => {
		$('#idsantri').focus()
	})


	$('#modal-lg').on('hidden.bs.modal', () => {
		$('#idsantri').val('')
		$('#datasantri').hide()
		$('#tombolCek').show()
		$('#tombolSimpan').hide()
		cancelOther()
	})

	$('#modal-proses').on('shown.bs.modal', () => {
		$('#id-proses').focus()
	})

	$('#modal-proses').on('hidden.bs.modal', () => {
		$('#id-proses').val('')
		$('#tampil-tanggal-kembali').hide()
		$('#tanggal').val('')
		$('#bulan').val('')
		$('#tahun').val('')
		$('#datasantri-proses').html('')
		$('#tombolCek-proses').show()
		$('#tombolSimpan-proses').hide()
	})

	$('#modal-kembali').on('shown.bs.modal', () => {
		$('#id-kembali').focus()
	})

	$('#modal-kembali').on('hidden.bs.modal', () => {
		$('#id-kembali').val('')
		$('#tampil-tanggal-kembali-perizinan').hide()
		$('#tanggal-kembali').val('')
		$('#bulan-kembali').val('')
		$('#tahun-kembali').val('')
		$('#datasantri-kembali').html('')
		$('#tombolCek-kembali').show()
		$('#tombolSimpan-kembali').hide()
	})


	const munculAlert = kata => {
		Swal.fire(
			'GAGAL',
			kata,
			'warning'
		)
	}

	const tombolCek = $('#tombolCek')
	tombolCek.on('click', () => {
		const idSantri = $('#idsantri').val()
		idSantri == '' && toastr.error('Masukkan ID Santri')
		idSantri != '' && cekIDSantri(idSantri)
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
			url: '<?= base_url() ?>perizinan/cekidsantri',
			method: 'post',
			data: {
				id
			},
			dataType: 'json',
			success: data => {
				const status = data.status
				if (status != 200) {
					$('#idsantri').select()
					toastr.error(data.message)
					return false
				}

				tombolCek.hide()
				$('#tombolSimpan').show()
				$('.tampilalasan').show()
				getAlasan()
				getDataSantri(id)
			}
		})
	}


	const getDataSantri = id => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/getDataSantri',
			method: 'post',
			data: {
				id
			},
			success: data => {
				$('#datasantri').html(data)
			}
		})
	}


	$('#formtambahboyong').on('keyup keypress', (e) => {
		const enter = e.keyCode || e.which
		enter === 13 && e.preventDefault()
	})


	$('#tombolSimpan').on('click', () => {
		const tipe = $('#tipe-alasan').val()
		const alasan = $('#alasan').val()
		const other = $('#alasan-lain').val()

		if (tipe == 0 && alasan == '') {
			toastr.error('Pastikan alasan telah dipilih')
			return false
		}

		if (tipe == 1 && other == '') {
			toastr.error('Pastikan alasan lain telah diisi')
			return false
		}

		save()
	})


	const save = () => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/save',
			method: 'post',
			data: $('#form-perizinan').serialize(),
			dataType: 'json',
			success: data => {
				let status = data.status
				if (status != 200) {
					toastr.error(data.message)
					return false
				}

				toastr.success('SIIIPP..!! Satu izin berhasil ditambahkan')
				$('#modal-lg').modal('hide')
				loaddata()

				window.open('<?= base_url() ?>perizinan/getLinkPrint/' + data.message, '_blank')
			}
		})
	}

	$('#tombolbatal').on('click', () => {
		const idsantri = $('#idsantri').val()
		if (idsantri !== '') {
			Swal.fire({
				title: 'Anda Yakin?',
				text: 'Membatalkan Proses Izin Santri',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Lanjut',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#modal-lg').modal('hide')
				}
			})
		} else {
			$('#modal-lg').modal('hide')
		}
	})

	$('#form-proses-perizinan').on('keyup keypress', (e) => {
		const enter = e.keyCode || e.which
		enter === 13 && e.preventDefault()
	})

	const tombolCekProses = $('#tombolCek-proses')
	tombolCek.on('click', () => {
		const id = $('#id-proses').val()
		id == '' && toastr.error('Masukkan ID Perizinan')
		id != '' && cekPerizinan(id)
	})


	$('#id-proses').on('keyup', function(e) {
		let id = $(this).val()
		let key = e.which
		if (key != 13) {
			return false
		}

		if (key == 13 && id == '') {
			toastr.error('Masukkan ID Perizinan')
			return false
		}

		cekPerizinan(id)
	})

	const cekPerizinan = id => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/cekperizinan',
			method: 'POST',
			data: {
				id
			},
			dataType: 'JSON',
			success: (response) => {
				let status = response.status
				if (status != 200) {
					toastr.error(`Ooppss..! ${response.message}`)
					return false
				}

				$('#tampil-tanggal-kembali').show()
				$('#tombolCek-proses').hide()
				$('#tombolSimpan-proses').show()
				getDataPerizinan(response.message)
			}
		})
	}

	const getDataPerizinan = id => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/getdataperizinan',
			method: 'POST',
			data: {
				id
			},
			success: (response) => {
				$('#datasantri-proses').html(response)
			}
		})
	}

	$('#tombolbatal-proses').on('click', () => {
		const id = $('#id-proses').val()
		if (id !== '') {
			Swal.fire({
				title: 'Anda Yakin?',
				text: 'Membatalkan Proses Izin Santri',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Lanjut',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#modal-proses').modal('hide')
				}
			})
		} else {
			$('#modal-proses').modal('hide')
		}
	})

	$('#tombolSimpan-proses').on('click', function() {
		saveIzin()
	})

	const saveIzin = () => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/saveizin',
			method: 'POST',
			data: $('#form-proses-perizinan').serialize(),
			dataType: 'JSON',
			success: (response) => {
				let status = response.status
				if (status != 200) {
					toastr.error(`Oppss..! ${ response.message }`)
					return false
				}

				toastr.success('Yeaahh.. Satu izin berhasil diaktifkan')
				loaddata()
				$('#modal-proses').modal('hide')
				window.open('<?= base_url() ?>perizinan/getLinkSurat/' + response.message, '_blank')
			}
		})
	}

	$('#form-kembali-perizinan').on('keyup keypress', (e) => {
		const enter = e.keyCode || e.which
		enter === 13 && e.preventDefault()
	})

	const tombolCekKembali = $('#tombolCek-kembali')
	tombolCek.on('click', () => {
		const id = $('#id-kembali').val()
		id == '' && toastr.error('Masukkan ID Perizinan')
		id != '' && cekPerizinanKembali(id)
	})


	$('#id-kembali').on('keyup', function(e) {
		let id = $(this).val()
		let key = e.which
		if (key != 13) {
			return false
		}

		if (key == 13 && id == '') {
			toastr.error('Masukkan ID Perizinan')
			return false
		}

		cekPerizinanKembali(id)
	})

	const cekPerizinanKembali = id => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/cekPerizinanKembali',
			method: 'POST',
			data: {
				id
			},
			dataType: 'JSON',
			success: (response) => {
				let status = response.status
				if (status != 200) {
					toastr.error(`Ooppss..! ${response.message}`)
					return false
				}

				$('#tampil-tanggal-kembali-perizinan').show()
				$('#tombolCek-kembali').hide()
				$('#tombolSimpan-kembali').show()
				getDataPerizinanKembali(response.message)
			}
		})
	}

	const getDataPerizinanKembali = id => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/getdataperizinan',
			method: 'POST',
			data: {
				id
			},
			success: (response) => {
				$('#datasantri-kembali').html(response)
			}
		})
	}

	$('#tombolbatal-kembali').on('click', () => {
		const id = $('#id-kembali').val()
		if (id !== '') {
			Swal.fire({
				title: 'Anda Yakin?',
				text: 'Membatalkan Proses Izin Santri',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Lanjut',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('#modal-kembali').modal('hide')
				}
			})
		} else {
			$('#modal-kembali').modal('hide')
		}
	})

	$('#tombolSimpan-kembali').on('click', function() {
		Swal.fire({
			title: 'Anda Yakin?',
			text: 'Pastikan tanggal kembali sudah diperiksa dengan seksama',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Lanjut',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				saveIzinKembali()
			}
		})
	})

	const saveIzinKembali = () => {
		$.ajax({
			url: '<?= base_url() ?>perizinan/saveizinkembali',
			method: 'POST',
			data: $('#form-kembali-perizinan').serialize(),
			dataType: 'JSON',
			success: (response) => {
				let status = response.status
				if (status != 200) {
					toastr.error(`Oppss..! ${ response.message }`)
					return false
				}

				toastr.success('Yeaahh.. Satu izin berhasil diaktifkan')
				loaddata()
				$('#modal-kembali').modal('hide')
			}
		})
	}
</script>
</body>

</html>