<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/logo.png">
	<style>
		* {
			/*font-family: 'Courier New', Courier, monospace;*/
			font-family: 'Corbel', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			font-size: 12pt;
		}

		.container {
			width: 148mm;
			height: 210mm;
			display: relative;
		}

		.row {
			display: flex;
			flex-wrap: wrap;
		}

		.col-12 {
			flex: 0 0 100%;
			max-width: 100%;
		}

		.col-10 {
			flex: 0 0 83%;
			max-width: 83%;
		}

		.col-8 {
			flex: 0 0 66.666667%;
			max-width: 66.666667%;
		}

		.col-7 {
			flex: 0 0 58.333333%;
			max-width: 58.333333%;
		}

		.col-6 {
			flex: 0 0 50%;
			max-width: 50%;
		}

		.col-5 {
			flex: 0 0 41.666667%;
			max-width: 41.666667%;
		}

		.col-4 {
			flex: 0 0 33.333333%;
			max-width: 33.333333%;
		}

		.col-2 {
			flex: 0 0 16.6%;
			max-width: 16.6%;
		}

		.logo {
			width: 100%;
			margin-top: 8px;
		}

		.h1,
		.h2,
		.h3,
		.h4,
		.h5,
		.h6,
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin-top: 0.1rem;
			margin-bottom: 0.1rem;
			margin-block-start: 0px;
			margin-block-end: 0px;
			font-family: inherit;
			font-weight: bold;
			color: inherit;
		}

		.invoice-title {
			font-size: 3.5rem;
		}

		.text-right {
			text-align: end;
		}

		hr {
			margin-top: 0.6rem;
			margin-bottom: 0.6rem;
			border: 0;
			border-top: 1px solid rgb(0 0 0 / 82%)
		}

		table {
			border-collapse: collapse;
		}

		.table {
			width: 100%;
			margin-bottom: 1rem;
			color: #212529;
			background-color: transparent;
		}

		.tablestripped {
			width: 100%;
			margin-bottom: 1rem;
			color: #212529;
			background-color: transparent;
		}

		.tablebottom {
			width: 100%;
			margin-bottom: 1rem;
			color: #212529;
			background-color: transparent;
		}

		.mb-0 {
			margin-bottom: 0px;
		}

		.mt-2 {
			margin-top: 3rem;
		}

		.mb-1 {
			margin-bottom: 1rem;
		}

		.mb-2 {
			margin-bottom: 2rem;
		}

		.tablestripped th {
			vertical-align: top;
			border-top: 1px solid #999797;
			border-bottom: 1px solid #999797;
		}

		.tablestripped td {
			vertical-align: top;
			border-top: 1px solid #999797;
		}

		.tablebottom td,
		.tablebottom th {
			vertical-align: top;
			border-top: 1px dashed #999797;
		}

		#line-bottom {
			border-top: 1px solid #999797;
		}

		.table-xl th {
			padding: 0.5rem;
		}

		.table-xl td {
			padding: 0.3rem;
		}

		.table-sm td,
		.table-sm th {
			padding: 0.2rem;
		}

		.text-center {
			text-align: center;
		}

		.text-bold {
			font-weight: bold;
		}

		.notes {
			padding-left: 25px;
			padding-top: 10px;
		}

		.mb-5 {
			margin-bottom: 40px;
		}

		.pl-5 {
			padding-left: 20px;
		}

		.align-top {
			vertical-align: top;
		}

		.pt-5 {
			padding-top: 30px;
		}

		.mb-3 {
			margin-bottom: 10px;
		}
	</style>
</head>

<body>
	<div class="container">
		<?php
		if ($data) {
		?>
			<div class="row">
				<div class="col-12" style="margin-bottom: 30px;">
					<img src="<?= base_url() ?>assets/images/logo-slip.png" style="width: 70%;">
				</div>
				<div class="col-12 text-center mb-3">
					<h6>
						<u>SALINAN SURAT IZIN</u>
					</h6>
					<i>Nomor: <?= $data->registrasi ?></i>
				</div>
				<div class="col-12">
					<p>Yang bertanda tangan di bawah ini, Kami pengurus Pondok Pesantren Miftahul Ulum Kebun baru menerangkan bahwa anak tersebut di bawah ini:</p>
				</div>
				<div class="col-12">
					<table class="table mb-0" border="0">
						<tbody>
							<tr>
								<td class="pl-5">Nama</td>
								<td>:</td>
								<td><b><?= $data->nama_santri ?></b></td>
							</tr>
							<tr>
								<td class="pl-5">ID P2K</td>
								<td>:</td>
								<td><?= $data->id_santri ?></td>
							</tr>
							<tr>
								<td class="pl-5">Tetala</td>
								<td>:</td>
								<td><?= $data->tempat_lahir_santri . ', ' . tanggalIndo($data->tanggal_lahir_santri) ?></td>
							</tr>
							<tr>
								<td class="pl-5">Usia</td>
								<td>:</td>
								<td><?= ageCounter($data->tanggal_lahir_santri) ?></td>
							</tr>
							<tr>
								<td class="pl-5 align-top">Alamat</td>
								<td class="align-top">:</td>
								<td>
									<?= $data->desa_santri . ' ' . $data->kecamatan_santri ?>
									<?= str_replace(['Kota ', 'Kabupaten '], '', $data->kabupaten_santri) ?>
								</td>
							</tr>
							<tr>
								<td class="pl-5">Domisili</td>
								<td>:</td>
								<td><?= $data->status_domisili_santri . ', ' . $data->domisili_santri, ' - ' . $data->nomor_kamar_santri ?></td>
							</tr>
							<tr>
								<td class="pl-5">Pend. Diniyah</td>
								<td>:</td>
								<td><?= $data->kelas_diniyah . ' - ' . $data->tingkat_diniyah ?></td>
							</tr>
							<tr>
								<td class="pl-5">Pend. Formal</td>
								<td>:</td>
								<td><?= $data->kelas_formal . ' - ' . $data->tingkat_formal ?></td>
							</tr>
							<tr>
								<td class="pl-5"><?= ($data->alasan == 'Sakit') ? 'Dikarenakan' : 'Keperluan' ?></td>
								<td>:</td>
								<td><?= $data->alasan ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-12">
				<p>
					Telah diberi izin untuk pulang/bepergian selama <b><?= diffDayCounter($data->created_at, $data->active_to) ?></b> hari, berlaku sejak tanggal ditetapkan
					dan harus kembali ke pondok pesantren selambat-lambatnya : <br> <?= dateDisplayWithDay($data->active_to, TampilHijri($data->updated_at)) ?>
				</p>
			</div>
			<div class="col-12">
				<p>Demikian mohon maklum adanya.</p>
			</div>
			<div class="row">
				<div class="col-6"></div>
				<div class="col-6">
					<table class="table" style="margin-bottom: 8px">
						<tr>
							<td class="text-right">Kebun baru</td>
							<td>,</td>
							<td><?= TampilHijri($data->created_at_hijri) ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<?php
					$idUser = $this->session->userdata('id_user');
					if ($idUser == '84002100823dd0c' || $idUser == '129091ae4d9f266') {
						$before = 'Sekretaris I';
					} else {
						$before = 'Staf Sekretaris I';
					}
					?>
					<table class="table">
						<tr>
							<td>
								<i><?= $before ?></i>
								<br><br><br><br><br>
								<b><u>( <?= $data->user ?> )</u></b>
							</td>
						</tr>
					</table>
				</div>
				<div class="col-12">
					<div class="row">
						<div class="col-6" style="font-style: italic">
							<ol type="1">
								<li>Yang bersangkutan</li>
								<li>Sekolah Formal</li>
								<li>Madrasah Diniyah</li>
								<li>Arsip</li>
							</ol>
						</div>
						<div class="col-6" style="padding-top: 70px">
							<div style="display: block">
								<?= $barcode ?>
							</div>
							<div style="display: block; margin-top: 50px; text-align: right; padding-right: 10px">
								<i>No. Reg. <?= $data->id ?></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
	<p style="page-break-after: always;">&nbsp;</p>

	<script>
		window.print()
		setTimeout(() => {
			window.close()
		}, 2000);
	</script>
</body>

</html>