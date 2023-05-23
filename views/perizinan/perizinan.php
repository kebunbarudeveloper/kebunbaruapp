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
					<div class="card card-default">
						<div class="card-header py-2 pr-2">
							<h3 class="card-title mt-1"> <i class="fas fa-stamp"></i> Perizinan</h3>
							<button type="submit" class="btn btn-success btn-sm px-5 float-right ml-2" data-toggle="modal" data-target="#modal-lg">
								<i class="fas fa-plus-circle"></i> Tambah
							</button>
							<button type="submit" class="btn btn-default btn-sm px-4 ml-2 float-right" data-toggle="modal" data-target="#modal-proses">
								<i class="fas fa-file-alt"></i> Surat
							</button>
							<button type="submit" class="btn btn-default btn-sm px-4 float-right" data-toggle="modal" data-target="#modal-kembali">
								<i class="fas fa-arrow-alt-circle-down"></i> Kembali
							</button>
							<select onchange="loaddata()" id="bulan" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 130px;">
								<option value="">Semua Bulan</option>
								<option value="01">Muharram</option>
								<option value="02">Shafar</option>
								<option value="03">Rabi'ul Awal</option>
								<option value="04">Rabi'ul Tsani</option>
								<option value="05">Jumadal Ula</option>
								<option value="06">Jumadal Akhirah</option>
								<option value="07">Rajab</option>
								<option value="08">Sya'ban</option>
								<option value="09">Ramadhan</option>
								<option value="10">Syawal</option>
								<option value="11">Dzul Qo'dah</option>
								<option value="12">Dzul Hijjah</option>
							</select>
							<select onchange="loaddata()" class="form-control form-control-sm float-right mr-2" id="status" style="width: 130px">
								<option value="">..:Pilih Status:..</option>
								<option value="0">Pengajuan</option>
								<option value="1">Aktif</option>
								<option value="2">Kembali</option>
							</select>
							<input type="text" onkeyup="loaddata()" class="form-control form-control-sm mr-2 float-right" id="nama" autofocus autocomplete="off" placeholder="Cari nama santri" style="width: 220px">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12" id="tampil-data-perizinan">

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

</div>

<div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header py-2">
				<h6 class="modal-title">Form Tambah Perizinan</h6>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form autocomplete="off" id="form-perizinan">
							<div class="row">
								<div class="col-4">
									<div class="form-group row">
										<label for="idsantri" class="col-sm-4 col-form-label text-right">ID P2K</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" data-inputmask="'mask' : '99999999'" data-mask="" id="idsantri" autofocus name="idsantri">
											<small class="text-danger">Tekan ENTER untuk cek data</small>
										</div>
									</div>
								</div>
								<div class="col-8">
									<div class="form-group row mb-0 tampilalasan" style="display: none;">
										<label for="alasan" class="col-sm-4 col-form-label text-right">Alasan</label>
										<div class="col-sm-8">
											<input type="hidden" name="tipe_alasan" id="tipe-alasan" value="">
											<input style="display: none;" type="text" class="form-control alasan-lain" id="alasan-lain" name="alasan_lain">
											<select class="form-control" name="alasan" id="alasan" onchange="setAlasan(this)">
											</select>
											<small onclick="cancelOther()" style="display: none; cursor: pointer" class="text-danger alasan-lain">
												Batal
											</small>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-12">
						<div class="row" id="datasantri"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer py-1">
				<button type="button" id="tombolbatal" class="btn btn-danger btn-sm">Batal</button>
				<button type="button" class="btn btn-primary btn-sm" id="tombolCek">Lakukan Pengecekan</button>
				<button style="display: none;" class="btn btn-primary btn-sm" id="tombolSimpan">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-proses" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header py-2">
				<h6 class="modal-title">Form Proses Perizinan</h6>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form autocomplete="off" id="form-proses-perizinan">
							<div class="row">
								<div class="col-4">
									<div class="form-group row">
										<label for="id-proses" class="col-sm-4 col-form-label text-right">No. Reg.</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" data-inputmask="'mask' : '99999999999'" data-mask="" id="id-proses" autofocus name="id_proses">
											<small class="text-danger">Tekan ENTER untuk cek data</small>
										</div>
									</div>
								</div>
								<div class="col-8" id="tampil-tanggal-kembali" style="display:none;">
									<div class="form-group row">
										<label for="tanggal" class="col-sm-3 col-form-label text-right">Berlaku s.d.</label>
										<div class="col-sm-2">
											<select name="tanggal" id="tanggal" class="form-control">
												<option value="">---</option>
												<?php
												for ($i = 1; $i < 31; $i++) {
												?>
													<option value="<?= sprintf('%02d', $i) ?>"><?= sprintf('%02d', $i) ?>
													</option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="col-sm-4">
											<select name="bulan" id="bulan" class="form-control" tabindex="6">
												<option value="">..::..</option>
												<?php
												$bulan = [
													1 => 'Muharram',
													'Shafar',
													'Rabi\'ul Awal',
													'Rabi\'ul Tsani',
													'Jumadal Ula',
													'Jumadal Akhirah',
													'Rajab',
													'Sya\'ban',
													'Ramadhan',
													'Syawal',
													'Dzul Qo\'dah',
													'Dzul Hijjah'
												];
												$k = 1;
												for ($p = 1; $p <= 12; $p++) {
												?>
													<option value="<?= sprintf('%02d', $p); ?>">
														<?= $bulan[$p]; ?>
													</option>
												<?php } ?>
											</select>
										</div>

										<div class="col-sm-3">
											<select name="tahun" id="tahun" class="form-control" tabindex="7">
												<option value="">..::..</option>
												<?php
												$sekarang = 1445;
												for ($b = 1444; $b <= $sekarang; $b++) {
												?>
													<option value="<?= $b; ?>"><?= $b; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-12">
						<div class="row" id="datasantri-proses"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer py-1">
				<button type="button" id="tombolbatal-proses" class="btn btn-danger btn-sm">Batal</button>
				<button type="button" class="btn btn-primary btn-sm" id="tombolCek-proses">Lakukan Pengecekan</button>
				<button style="display: none;" class="btn btn-primary btn-sm" id="tombolSimpan-proses">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-kembali" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header py-2">
				<h6 class="modal-title">Form Kembali Perizinan</h6>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-12">
						<form autocomplete="off" id="form-kembali-perizinan">
							<div class="row">
								<div class="col-4">
									<div class="form-group row">
										<label for="id-kembali" class="col-sm-4 col-form-label text-right">No. Reg.</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" data-inputmask="'mask' : '99999999999'" data-mask="" id="id-kembali" autofocus name="id">
											<small class="text-danger">Tekan ENTER untuk cek data</small>
										</div>
									</div>
								</div>
								<div class="col-8" id="tampil-tanggal-kembali-perizinan" style="display: none;">
									<div class="row">
										<div class="col-12">
											<div class="form-group row mb-1">
												<label for="tanggal-kembali" class="col-sm-2 col-form-label text-right">Tanggal</label>
												<div class="col-sm-2">
													<select name="tanggal" id="tanggal-kembali" class="form-control">
														<option value="">---</option>
														<?php
														for ($i = 1; $i <= 31; $i++) {
														?>
															<option value="<?= sprintf('%02d', $i) ?>"><?= sprintf('%02d', $i) ?>
															</option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="col-sm-3">
													<select name="bulan" id="bulan-kembali" class="form-control" tabindex="6">
														<option value="">..::..</option>
														<?php
														$bulan = [
															1 =>
															'Januari',
															'Februari',
															'Maret',
															'April',
															'Mei',
															'Juni',
															'Juli',
															'Agustus',
															'September',
															'Oktober',
															'November',
															'Desember'
														];
														for ($p = 1; $p <= 12; $p++) {
														?>
															<option value="<?= sprintf('%02d', $p) ?>">
																<?= $bulan[$p] ?>
															</option>
														<?php } ?>
													</select>
												</div>

												<div class="col-sm-3">
													<select name="tahun" id="tahun-kembali" class="form-control" tabindex="7">
														<option value="">..::..</option>
														<?php
														$sekarang = date('Y');
														for ($b = 2022; $b <= $sekarang; $b++) {
														?>
															<option value="<?= $b; ?>"><?= $b; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-2">
													<input type="text" class="form-control" data-inputmask="'mask' : '99:99'" data-mask="" id="waktu" name="waktu">
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="text-right text-xs text-danger">
												Jika tanggal tidak dipilih, maka sistem berasumsi waktu saat ini
											</div>
										</div>
									</div>

								</div>
							</div>
						</form>
					</div>
					<div class="col-12">
						<div class="row" id="datasantri-kembali"></div>
					</div>
				</div>
			</div>
			<div class="modal-footer py-1">
				<button type="button" id="tombolbatal-kembali" class="btn btn-danger btn-sm">Batal</button>
				<button type="button" class="btn btn-primary btn-sm" id="tombolCek-kembali">Lakukan Pengecekan</button>
				<button style="display: none;" class="btn btn-primary btn-sm" id="tombolSimpan-kembali">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>