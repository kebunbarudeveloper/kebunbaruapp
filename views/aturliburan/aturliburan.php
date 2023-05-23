<?php
$kata = ['Belum Diatur', 'Liburan Maulid', 'Liburan Ramadhan']
?>
<form action="<?= base_url() ?>aturliburan/print" method="post" target="_blank" id="formPrint">
    <input type="hidden" id="filterDaerah" name="filterDaerah" value="">
</form>
<form action="<?= base_url() ?>aturliburan/printlagi" method="post" target="_blank" id="formPrintLagi">
    <input type="hidden" id="filterDaerahLagi" name="filterDaerahLagi" value="">
</form>
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

            <!-- <hr> -->
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Atur Liburan</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- <form class="form-horizontal" autocomplete="off"> -->
                        <div class="card-body row">
                            <div class="col-md-6">
                                <button <?= ($data == 1) ? 'disabled' : '' ?> data-id="1" type="button" class="btn btn-info btn-block btn-sm jenis">
                                    <i class="fa fa-bell"></i> Libur Maulid
                                </button>
                            </div>

                            <div class="col-md-6">
                                <button <?= ($data == 2) ? 'disabled' : '' ?> data-id="2" type="button" class="btn btn-success btn-block btn-sm jenis">
                                    <i class="fa fa-bell"></i> Libur Ramadhan
                                </button>
                            </div>
                            <div class="col-md-12 mt-3">
                                <h6>Pengaturan Liburan Saat Ini: <b class="text-danger"><?= $kata[$data] ?></b> </h6>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <!-- <button type="button" id="simpanSuratIjin" class="btn btn-success btn-sm float-right">Simpan</button> -->
                        </div>
                        <!-- /.card-footer -->
                        <!-- </form> -->
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Atur Domisili</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-5 col-form-label">Pilih Domisili</label>
                                <div class="col-sm-7">
                                    <select id="jadwal" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <?php
                                        if ($domisili) {
                                            foreach ($domisili as $dd) {

                                        ?>
                                                <option value="<?= $dd->nama_kamar ?>" <?= ($jadwal == $dd->nama_kamar) ? 'disabled' : '' ?>><?= $dd->nama_kamar ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <h6 class="mb-0">Pengaturan Domisili Saat Ini:
                                <b class="text-danger"><?= $jadwal ?></b>
                            </h6>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Print Out</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-7">
                                    <select id="filterdomisili" class="form-control">
                                        <option value="">--Semua Daerah--</option>
                                        <?php
                                        if ($domisili) {
                                            foreach ($domisili as $dd) {

                                        ?>
                                                <option value="<?= $dd->nama_kamar ?>"><?= $dd->nama_kamar ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <button type="button" id="tombolprint" class="btn btn-info btn-block">Print</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tanggal Kembali</h5>
                        </div>
                        <form id="formTangal" action="<?= base_url() ?>aturliburan/tanggal" method="post" autocomplete="off">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-2 col-form-label">Tgl.</label>
                                    <div class="col-sm-3">
                                        <select name="tanggal" id="tanggal" class="form-control">
                                            <option value="">---</option>
                                            <?php
                                            for ($i = 1; $i < 32; $i++) {
                                            ?>
                                                <option value="<?= sprintf('%02d', $i) ?>"><?= sprintf('%02d', $i) ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="bulan" id="bulan" class="form-control inputdatasantri" tabindex="6">
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
                                        <select name="tahun" id="tahun" class="form-control inputdatasantri" tabindex="7">
                                            <option value="">..::..</option>
                                            <?php
                                            $sekarang = date('Y');
                                            for ($b = 2020; $b <= $sekarang; $b++) {
                                            ?>
                                                <option value="<?= $b; ?>"><?= $b; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jam" class="col-sm-2 col-form-label">Jam</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" data-inputmask="'mask' : '99:99'" data-mask="" name="jam">
                                    </div>
                                </div>
                                <?php
                                if ($tanggal != 0) {
                                    $str = strtotime($tanggal);
                                    $tgl = date('Y-m-d', $str);
                                    $jam = date('H:i:s', $str);
                                ?>
                                    Saat ini: <span class="text-success text-bold"><?= tanggalIndo($tgl) . ' | ' . $jam; ?></span>
                                <?php
                                } else {
                                    echo 'Saat ini: <span class="text-danger">Belum diatur</span>';
                                }
                                ?>
                            </div>
                        </form>
                        <div class="card-footer">
                            <button type="button" id="simpanTanggal" class="btn btn-success btn-sm float-right">Simpan</button>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Atur Zona
                            </h5>
                        </div>
                        <div class="card-body row">
                            <div class="col-6">
                                <button class="btn btn-block btn-success tombolZona" data-id="1" <?= ($zone == 1) ? 'disabled' : '' ?>>
                                    Zona Atas
                                </button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-block btn-success tombolZona" data-id="2" <?= ($zone == 2) ? 'disabled' : '' ?>>
                                    Zona Bawah
                                </button>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>

                <div class="col-4">
					<?php if ($this->session->userdata('tipe_user') == 1) { ?>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Print Out Indisipliner</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-7">
                                    <select id="pilihdomisili" class="form-control">
                                        <option value="">--Semua Daerah--</option>
                                        <?php
                                        if ($domisili) {
                                            foreach ($domisili as $dd) {

                                        ?>
                                                <option value="<?= $dd->nama_kamar ?>"><?= $dd->nama_kamar ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <button type="button" id="print" class="btn btn-info btn-block">Print</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
					<?php }else{ ?>
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Print Out Indisipliner Banat</h5>
							</div>
							<div class="card-body">
								<div class="form-group row">
									<div class="col-sm-7">
										<form target="_blank" method="post" action="<?= base_url() ?>aturliburan/printbanat" id="form-print-banat">
											<select id="pilihdomisili-banat" name="domisili" class="form-control">
												<option value="">--Semua Daerah--</option>
												<?php
												if ($domisili) {
													foreach ($domisili as $dd) {

														?>
														<option value="<?= $dd->nama_kamar ?>"><?= $dd->nama_kamar ?></option>
														<?php
													}
												}
												?>
											</select>
										</form>
									</div>
									<div class="col-sm-5">
										<button type="button" id="print-banat" class="btn btn-info btn-block">Print</button>
									</div>
								</div>
							</div>
							<div class="card-footer">

							</div>
						</div>
					<?php } ?>
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
