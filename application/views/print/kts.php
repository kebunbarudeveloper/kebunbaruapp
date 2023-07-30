<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
	<title>Print Out KTS</title>
	<style type="text/css">
		* {
			font-family: ebrima;
			font-size: 60pt;
		}

		.back {
			width: 870mm;
			height: 548mm;
			background-image: url(<?= base_url('assets/images/front-kts.jpg') ?>);
			background-repeat: no-repeat;
			background-size: cover;
		}


		.belakang {
			width: 870mm;
			height: 547.5mm;
			background-image: url(<?= base_url('assets/images/back-kts.jpg') ?>);
			background-repeat: no-repeat;
			background-size: cover;
		}

		img {
			width: 100%;
			height: 100%;
		}

		.atas {
			width: 100%;
			height: 500px;
			/*background-color: red;*/
			margin-bottom: 140px;
			text-align: right;
			position: relative;
		}

		#bottom {
			position: absolute;
			bottom: 0;
			right: 100px;
			font-size: 50pt;
			font-weight: bold;
			color: #C0E2D9;
		}


		.tengah {
			/*background-color: red;*/
			height: 1050px;
			width: 870mm;
		}

		.bidang {
			/*background-color: white;*/
			width: 85%;
			margin: 0 auto;
			height: 100%;
			display: flex;
		}

		.bidangsatu {
			/*background-color: yellow;*/
			width: 80%;
			height: 100%;
			color: #1A332A;
		}

		.bidangdua {
			/*background-color: purple;*/
			width: 20%;
			height: 100%;
			justify-content: space-between;
		}


		.isi {
			width: 100%;
			/*background-color: orange;*/
		}

		.isiatas {
			background-color: #C0E2D9;
			border-radius: 20px;
			margin-bottom: 20px;
			width: 95%;
			display: flex;
			justify-content: space-between;
		}

		.isibawah {
			line-height: 1.2;
		}

		.bagianatas {
			width: 50%;
			display: inline;
			padding: 0px 50px;
		}

		.isiitem {
			display: inline-block;
			vertical-align: top;
		}

		.item {
			width: 20%;
		}

		.titik {
			width: 1%;
		}

		.bahan {
			width: 76%;
		}

		.indentasi {
			text-indent: 40px;
		}

		.isittd {
			position: relative;
		}

		.ttdawal {
			width: 43%;
		}

		.tanggal {
			font-size: 40pt;
			width: 55%;
			text-align: center;
			vertical-align: top;
		}

		.itemttd {
			display: inline-block;
		}

		.nama {
			font-weight: bold;
		}

		.foto {
			height: 70%;
			width: 100%;
			/*background-color: yellow;*/
			float: right;
		}

		.ttd {
			height: 30%;
			width: 100%;
			/*background-color: orange;*/
		}

		.frame {
			width: 90%;
			margin: 0 auto;
		}

		.fotosantri {
			border-radius: 20px;
		}

		.framebawah {
			width: 65%;
			margin: 0 auto;
		}

		.bawah {
			/*background-color: red;*/
			height: 250px;
			width: 280mm;
		}


		.framecode {
			width: 65%;
			margin: 0 auto;
		}
	</style>
</head>

<body>
	<div class="back">
		<div class="atas">
			<div id="bottom"><?= $datanya->periode_masuk ?> H</div>
		</div>

		<div class="tengah">
			<div class="bidang">
				<div class="bidangsatu">
					<div class="isiatas">
						<div class="bagianatas noid">
							ID P2K : <b><?= $datanya->id_santri ?></b>
						</div>
						<div class="bagianatas induk">
							Nomor Induk : <b><?= $datanya->induk_santri ?></b>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item">Nama</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan nama">
							<?= $datanya->nama_santri ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item">Kelahiran</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= ucwords($datanya->tempat_lahir_santri) . ', ' . tanggalIndo($datanya->tanggal_lahir_santri) ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item">Wali</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= $datanya->nama_walisantri ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item">Alamat</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= ucwords($datanya->dusun_santri) . ', RT ' . $datanya->rt_santri . '/RW ' . $datanya->rw_santri ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item indentasi">Desa/Kel.</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= $datanya->desa_santri ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item indentasi">Kecamatan</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= $datanya->kecamatan_santri ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item indentasi">Kab./Kota</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= str_replace(['Kabupaten ', 'Kota '], '', $datanya->kabupaten_santri) ?>
						</div>
					</div>
					<div class="isi isibawah">
						<div class="isiitem item indentasi">Provinsi</div>
						<div class="isiitem titik">:</div>
						<div class="isiitem bahan">
							<?= $datanya->provinsi_santri ?>
						</div>
					</div>
					<div class="isi isittd">
						<div class="ttdawal itemttd"></div>
						<div class="tanggal itemttd">
							Kebun Baru, <?= TampilHijri($date) ?> H
						</div>
					</div>
				</div>
				<div class="bidangdua">
					<div class="foto">
						<div class="frame">
							<img src="<?= base_url() ?>assets/fotosantri/<?= $this->session->userdata('tipe_user') . '/' . $datanya->id_santri ?>.jpg" width="50" class="fotosantri">
						</div>
					</div>
					<div class="ttd">
						<div class="framebawah">
							<img src="<?= base_url() ?>assets/ttd/<?= $this->session->userdata('tipe_user') . '/' . $datanya->id_santri ?>.png">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bawah">
			<?= $barcode ?>
		</div>
	</div>
	<div class="belakang">

	</div>
	<script>
		window.print()
		setTimeout(function() {
			window.close()
		}, 2000);
	</script>
</body>

</html>