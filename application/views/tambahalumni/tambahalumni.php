<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <input type="hidden" id="urldataprovinsi" value="<?= base_url() ?>tambahalumni/GetProvinsi">
    <input type="hidden" id="urldatakab" value="<?= base_url() ?>tambahalumni/GetKab">
    <input type="hidden" id="urldatakec" value="<?= base_url() ?>tambahalumni/GetKec">
    <input type="hidden" id="urldatadesa" value="<?= base_url() ?>tambahalumni/GetDesa">
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 80.5vh;">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-user-plus"></i> Tambah Data Alumni</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-3" style="overflow-y: auto;" id="cardScroll">
                            <form action="" method="POST" autocomplete="off" id="formtambahsantri">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row text-center" style="background-color: #b3b3b3;">
                                            <label class="col-sm-12 col-form-label">BIODATA ALUMNI</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="niksantri" class="col-sm-4 col-form-label">No.
                                                (KTP/NIK)/KK</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatasantri" id="niksantri"
                                                    name="niksantri" autofocus
                                                    data-inputmask="'mask' : '9999999999999999'" data-mask=""
                                                    tabindex="1" value="<?= set_value('niksantri'); ?>">
                                                <?= form_error('niksantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatasantri" id="kksantri"
                                                    name="kksantri" data-inputmask="'mask' : '9999999999999999'"
                                                    data-mask="" tabindex="2" value="<?= set_value('kksantri'); ?>">
                                                <?= form_error('kksantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="tempatlahirsantri" class="col-sm-4 col-form-label">Tempat
                                                Lahir</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri"
                                                    id="tempatlahirsantri" name="tempatlahirsantri" tabindex="4"
                                                    value="<?= set_value('tempatlahirsantri'); ?>">
                                                <?= form_error('tempatlahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group row">
                                            <label for="namasantri" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="namasantri"
                                                    name="namasantri" tabindex="3"
                                                    value="<?= set_value('namasantri'); ?>">
                                                <?= form_error('namasantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tanggallahirsantri" class="col-sm-4 col-form-label">Tanggal
                                                Lahir</label>
                                            <div class="col-sm-2">
                                                <select name="tanggallahirsantri" id="tanggallahirsantri"
                                                    class="form-control inputdatasantri" tabindex="5">
                                                    <option value="">..::..</option>
                                                    <?php
													$l = 1;
													for ($i = 1; $i <= 31; $i++) {
													?>
                                                    <option value="<?= sprintf('%02d', $i); ?>"
                                                        <?= set_select('tanggallahirsantri', sprintf('%02d', $l++)) ?>>
                                                        <?= sprintf('%02d', $i); ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tanggallahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="bulanlahirsantri" id="bulanlahirsantri"
                                                    class="form-control inputdatasantri" tabindex="6">
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
                                                    <option value="<?= sprintf('%02d', $p); ?>"
                                                        <?= set_select('bulanlahirsantri', sprintf('%02d', $k++)) ?>>
                                                        <?= $bulan[$p]; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('bulanlahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="tahunlahirsantri" id="tahunlahirsantri"
                                                    class="form-control inputdatasantri" tabindex="7">
                                                    <option value="">..::..</option>
                                                    <?php
													$sekarang = date('Y');
													for ($b = 1985; $b <= $sekarang; $b++) {
													?>
                                                    <option value="<?= $b; ?>"
                                                        <?= set_select('tahunlahirsantri', $b) ?>>
                                                        <?= $b; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tahunlahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-0">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="provinsisantri" class="col-sm-4 col-form-label">Provinsi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri"
                                                    id="provinsisantri" name="provinsisantri" tabindex="8"
                                                    value="<?= set_value('provinsisantri') ?>">
                                                <?= form_error('provinsisantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" id="idProvinsiSantri" value="">
                                        <input type="hidden" id="idKabSantri" value="">
                                        <input type="hidden" id="idKecSantri" value="">
                                        <div class="form-group row">
                                            <label for="kecamatansantri"
                                                class="col-sm-4 col-form-label">Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" readonly
                                                    id="kecamatansantri" name="kecamatansantri" tabindex="10"
                                                    value="<?= set_value('kecamatansantri') ?>">
                                                <?= form_error('kecamatansantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dusunsantri" class="col-sm-4 col-form-label">Dusun</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="dusunsantri"
                                                    name="dusunsantri" tabindex="12" readonly
                                                    value="<?= set_value('dusunsantri') ?>">
                                                <?= form_error('dusunsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tanggalmasukalumni" class="col-sm-4 col-form-label">Tanggal
                                                Masuk</label>
                                            <div class="col-sm-2">
                                                <select name="tanggalmasukalumni" id="tanggalmasukalumni"
                                                    class="form-control inputdatasantri" tabindex="5">
                                                    <option value="">..::..</option>
                                                    <?php
													$l = 1;
													for ($i = 1; $i <= 30; $i++) {
													?>
                                                    <option value="<?= sprintf('%02d', $i); ?>"
                                                        <?= set_select('tanggalmasukalumni', sprintf('%02d', $l++)) ?>>
                                                        <?= sprintf('%02d', $i); ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tanggalmasukalumni', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="bulanmasukalumni" id="bulanmasukalumni"
                                                    class="form-control inputdatasantri" tabindex="6">
                                                    <option value="">..::..</option>
                                                    <?php
													$bulan = [
														1 =>
														'Muharram',
														'Shafar',
														'Rabi\'ul Awal',
														'Rabi\'ul Tsani',
														'Jumadal Ula',
														'Jumadal Tsaniyah',
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
                                                    <option value="<?= sprintf('%02d', $p); ?>"
                                                        <?= set_select('bulanmasukalumni', sprintf('%02d', $k++)) ?>>
                                                        <?= $bulan[$p]; ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('bulanmasukalumni', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="tahunmasukalumni" id="tahunmasukalumni"
                                                    class="form-control inputdatasantri" tabindex="7">
                                                    <option value="">..::..</option>
                                                    <?php
													$sekarang = 1500;
													for ($b = 1200; $b <= $sekarang; $b++) {
													?>
                                                    <option value="<?= $b; ?>"
                                                        <?= set_select('tahunmasukalumni', $b) ?>>
                                                        <?= $b; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tahunmasukalumni', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="kabupatensantri"
                                                class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" readonly
                                                    id="kabupatensantri" name="kabupatensantri" tabindex="9"
                                                    value="<?= set_value('kabupatensantri') ?>">
                                                <?= form_error('kabupatensantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="desasantri"
                                                class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="desasantri"
                                                    name="desasantri" tabindex="11" readonly
                                                    value="<?= set_value('desasantri') ?>">
                                                <?= form_error('desasantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="rtsantri" class="col-sm-4 col-form-label">RT/RW/Kode
                                                Pos</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatasantri" id="rtsantri"
                                                    data-inputmask="'mask' : '999'" data-mask="" name="rtsantri"
                                                    tabindex="13" value="<?= set_value('rtsantri') ?>">
                                                <?= form_error('rtsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatasantri" id="rwsantri"
                                                    data-inputmask="'mask' : '999'" data-mask="" name="rwsantri"
                                                    tabindex="14" value="<?= set_value('rwsantri') ?>">
                                                <?= form_error('rwsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatasantri"
                                                    id="kodepossantri" name="kodepossantri"
                                                    value="<?= set_value('kodepossantri'); ?>" readonly>
                                                <?= form_error('kodepossantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tanggallahirsantri" class="col-sm-4 col-form-label">Tanggal
                                                Berhenti</label>
                                            <div class="col-sm-2">
                                                <select name="tanggalboyongalumni" id="tanggalboyongalumni"
                                                    class="form-control inputdatasantri" tabindex="5">
                                                    <option value="">..::..</option>
                                                    <?php
													$l = 1;
													for ($i = 1; $i <= 30; $i++) {
													?>
                                                    <option value="<?= sprintf('%02d', $i); ?>"
                                                        <?= set_select('tanggalboyongalumni', sprintf('%02d', $l++)) ?>>
                                                        <?= sprintf('%02d', $i); ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tanggalboyongalumni', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="bulanboyongalumni" id="bulanboyongalumni"
                                                    class="form-control inputdatasantri" tabindex="6">
                                                    <option value="">..::..</option>
                                                    <?php
													$bulan = [
														1 =>
														'Muharram',
														'Shafar',
														'Rabi\'ul Awal',
														'Rabi\'ul Tsani',
														'Jumadal Ula',
														'Jumadal Tsaniyah',
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
                                                    <option value="<?= sprintf('%02d', $p); ?>"
                                                        <?= set_select('bulanboyongalumni', sprintf('%02d', $k++)) ?>>
                                                        <?= $bulan[$p]; ?>
                                                    </option>







                                                    <?php } ?>
                                                </select>
                                                <?= form_error('bulanboyongalumni', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="tahunboyongalumni" id="tahunboyongalumni"
                                                    class="form-control inputdatasantri" tabindex="7">
                                                    <option value="">..::..</option>
                                                    <?php
													$sekarang = 1500;
													for ($b = 1200; $b <= $sekarang; $b++) {
													?>
                                                    <option value="<?= $b; ?>"
                                                        <?= set_select('tahunboyongalumni', $b) ?>>
                                                        <?= $b; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tahunboyongalumni', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button id="tombolsimpansantri" class="btn btn-primary float-right">
                                <i class="fa fa-plus-circle"></i>
                                Tambahkan</button>
                        </div>
                    </div>
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