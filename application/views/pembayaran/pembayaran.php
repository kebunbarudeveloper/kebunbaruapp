<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header pt-1">
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-12">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>FOR YOUR INFORMATION!</strong>
						Hey, ada fitur baru di pembayaran santri baru. Kamu bisa cek apa saja yang baru
						<a href="<?= base_url() ?>petunjuk/pembayaran"> di sini</a>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title"> <i class="fa fa-user-minus"></i> Data Pembayaran</h3>

							<div class="card-tools">
								<div class="input-group input-group-sm" style="width: 500px;">
									<input type="text" name="table_search" class="form-control float-right" placeholder="ID P2K">
									<select name="" id="" class="form-control">
										<option value="">..:Pilih Periode:..</option>
									</select>
									<button disabled type="submit" class="btn btn-primary form-control float-right">
										<i class="fas fa-file-download"></i> Eksport Data
									</button>

									<div class="input-group-append">
										<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-lg">
											<i class="fas fa-plus-circle"></i> Tambah
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-12" id="tampildataboyong">

				</div>

				<div class="col-md-3 tampildetailsantri" style="display: none;">

					<!-- Profile Image -->
					<div class="card" style="height: 70.5vh;">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid rounded" id="gambardetail" style="height: 100px; width: 80px; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Perbesar foto">
								<button data-toggle="tooltip" data-placement="left" title="Tutup detail" style="width: 30px; right: 10px; top: 10px; border-radius: 100%; position: absolute;" class="btn btn-sm btn-default" id="tutupdetail">
									<i class="far fa-times-circle"></i>
								</button>
							</div>
							<p class="text-muted text-center mt-2 mb-0">Status : <span class="text-success" id="statusdetail"> </span>
							</p>
							<hr class="mt-2 mb-2">
							<div style="overflow-y: auto; height: 35vh;" id="cardScrollDetail">
								<table>
									<thead>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<th style="width: 30%; vertical-align: top;">Nama</th>
											<th style="width: 2%; vertical-align: top;">:</th>
											<th style="width: 68%;" id="namadetail"></th>
										</tr>
									</thead>
									<tbody>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td>No. Induk</td>
											<td>:</td>
											<td id="indukdetail"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td>Diniyah</td>
											<td>:</td>
											<td id="diniyahdetail"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td>Formal</td>
											<td>:</td>
											<td id="formaldetail"></td>
										</tr>
										<tr>
											<td>Tetala</td>
											<td>:</td>
											<td id="tempatdetail">Pamekasan</td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td></td>
											<td></td>
											<td id="ttldetail"></td>
										</tr>
										<tr style="vertical-align:top">
											<td rowspan="7" style="border-bottom: 1px #d4d2d2 solid;">Alamat Santri</td>
											<td>:</td>
											<td id="dusundetail"></td>
										</tr>
										<tr>
											<td></td>
											<td id="rtrwdetail"></td>
										</tr>
										<tr>
											<td></td>
											<td id="desadetail"></td>
										</tr>
										<tr>
											<td></td>
											<td id="kecamatandetail"></td>
										</tr>
										<tr>
											<td></td>
											<td id="kabupatendetail"></td>
										</tr>
										<tr>
											<td></td>
											<td id="provinsidetail"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td></td>
											<td id="posdetail"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td style="vertical-align: top;">Ayah</td>
											<td style="vertical-align: top;">:</td>
											<td id="ayahdetail"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td style="vertical-align: top;">Ibu</td>
											<td style="vertical-align: top;">:</td>
											<td id="ibudetail"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid; font-weight: bold; vertical-align: top;">
											<td>Wali</td>
											<td>:</td>
											<td id="walidetail"></td>
										</tr>
										<tr style="vertical-align:top">
											<td rowspan="5" style="border-bottom: 1px #d4d2d2 solid;">Alamat Wali</td>
											<td>:</td>
											<td id="desadetailwali"></td>
										</tr>
										<tr>
											<td></td>
											<td id="kecamatandetailwali"></td>
										</tr>
										<tr>
											<td></td>
											<td id="kabupatendetailwali"></td>
										</tr>
										<tr>
											<td></td>
											<td id="provinsidetailwali"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td></td>
											<td id="posdetailwali"></td>
										</tr>
										<tr style="border-bottom: 1px #d4d2d2 solid ;">
											<td>Proses</td>
											<td>:</td>
											<td id="tglAngket"></td>
										</tr>
										<tr>
											<td>Boyong</td>
											<td> : </td>
											<td id="tglBoyong"></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<input type="hidden" id="iddataboyong">
						<input type="hidden" id="idsantriboyongaksi">
						<div class="card-footer">
							<div style="width: 100%;">
								<span data-toggle="tooltip" data-placement="top" title="Print Out Angket">
									<button id="printAngket" style="width: 48%;" class="btn btn-xs btn-primary">
										Print Angket
									</button>
								</span>
								<span id="divPrint" data-toggle="tooltip" data-placement="top" style="display: none;" title="Print Out Surat Boyong">
									<button id="printBoyong" style="width: 48%;" type="button" class="btn btn-xs btn-primary">
										Print Boyong
									</button>
								</span>
								<span style="display: none;" id="tampilselesaiboyong" data-toggle="tooltip" data-placement="top" title="Selesaikan Proses Boyong">
									<button id="divaksiselesai" style="width: 48%;" type="button" class="btn btn-xs btn-success">
										Selesaikan
									</button>
								</span>
							</div>

						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->


					<!-- /.card -->
				</div>
			</div>

			<!-- /.row -->
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>




<div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Form Tambah Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<div class="alert alert-warning" role="alert" id="notiferror" style="display: none;"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<form autocomplete="off" id="formtambahboyong">
							<div class="form-group row">
								<label for="idsantri" class="col-sm-4 col-form-label">ID P2K</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="idsantri" autofocus>
								</div>
							</div>
							<div class="form-group row mb-0 tampilhasil" style="display: none;">
								<label for="alasan" class="col-sm-4 col-form-label">Nominal</label>
								<div class="col-sm-8">
									<input class="form-control" id="alasan">
								</div>
							</div>
							<input type="hidden" id="idsantriboyong" value="">
							<input type="hidden" id="idpemasukan" value="">
							<input type="hidden" id="nominalval" value="">
							<input type="hidden" id="pendidikan" value="">
							<input type="hidden" id="idpengurangan" value="">
							<input type="hidden" id="potonganval" value="">
						</form>
						<div class="form-group clearfix mt-4 tampilhasil" style="display: none;">
							<span class="text-success">Biaya Pendidikan Satu Tahun</span>
							<h4 class="text-danger">Rp. <span id="totaltarif"></span></h4>
						</div>
						<div class="form-group clearfix mt-4 mb-0 pengurangan" style="display: none;">
							<span class="fa fa-exclamation-circle text-danger"></span> <span class="text-danger">Berpotensi pengurangan <b id="jenispengurangan"></b></span>
						</div>
						<div class="form-check clearfix pengurangan" style="display: none;">
							<input type="checkbox" class="form-check-input" id="pengurangan">
							<label class="form-check-label" for="pengurangan">Pilih untuk pengurangan sebesar
								<b class="text-success"> Rp. <span id="idpotongan"></span></b></label>
						</div>
					</div>
					<div class="col-5 ml-3">
						<div class="form-group row tampilhasil" id="databoyong" style="display: none;">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="tombolbatal" class="btn btn-danger">Batal</button>
				<button type="button" class="btn btn-primary" id="tombolCek">Lakukan Pengecekan</button>
				<button style="display: none;" class="btn btn-primary" id="tombolSimpan">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<div class="modal fade" id="myModal">
	<d iv class="modal-dialog modal-sm" style="max-width: 400px;">
		<div class="modal-content">
			<div class="modal-body">
				<img class="modal-content" id="gambarBesar">
			</div>
			<div class="modal-footer justify-content-center">
				<h4 id="namaBesar"></h4>
			</div>
		</div>
		<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
