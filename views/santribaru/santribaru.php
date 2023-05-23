<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <input type="hidden" id="urldataprovinsi" value="<?= base_url() ?>santribaru/GetProvinsi">
    <input type="hidden" id="urldatakab" value="<?= base_url() ?>santribaru/GetKab">
    <input type="hidden" id="urldatakec" value="<?= base_url() ?>santribaru/GetKec">
    <input type="hidden" id="urldatadesa" value="<?= base_url() ?>santribaru/GetDesa">
    <!-- /.content-header -->
    <div id="pesangagal" data-id="<?= $this->session->flashdata('gagal') ?>"></div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 80.5vh;">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-user-plus"></i> Tambah Santri Baru</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-3" style="overflow-y: auto;" id="cardScroll">
                            <form action="" method="POST" autocomplete="off" id="formtambahsantri">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row text-center" style="background-color: #b3b3b3;">
                                            <label class="col-sm-12 col-form-label">BIODATA CALON SANTRI/MURID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="niksantri" class="col-sm-4 col-form-label">No.
                                                (KTP/NIK)/KK</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatasantri" id="niksantri" name="niksantri" autofocus data-inputmask="'mask' : '9999999999999999'" data-mask="" tabindex="1" value="<?= set_value('niksantri'); ?>">
                                                <?= form_error('niksantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatasantri" id="kksantri" name="kksantri" data-inputmask="'mask' : '9999999999999999'" data-mask="" tabindex="2" value="<?= set_value('kksantri'); ?>">
                                                <?= form_error('kksantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="tempatlahirsantri" class="col-sm-4 col-form-label">Tempat
                                                Lahir</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="tempatlahirsantri" name="tempatlahirsantri" tabindex="4" value="<?= set_value('tempatlahirsantri'); ?>">
                                                <?= form_error('tempatlahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group row">
                                            <label for="namasantri" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="namasantri" name="namasantri" tabindex="3" value="<?= set_value('namasantri'); ?>">
                                                <?= form_error('namasantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tanggallahirsantri" class="col-sm-4 col-form-label">Tanggal
                                                Lahir</label>
                                            <div class="col-sm-2">
                                                <select name="tanggallahirsantri" id="tanggallahirsantri" class="form-control inputdatasantri" tabindex="5">
                                                    <option value="">..::..</option>
                                                    <?php
                                                    $l = 1;
                                                    for ($i = 1; $i <= 31; $i++) {
                                                    ?>
                                                        <option value="<?= sprintf('%02d', $i); ?>" <?= set_select('tanggallahirsantri', sprintf('%02d', $l++)) ?>>
                                                            <?= sprintf('%02d', $i); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('tanggallahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="bulanlahirsantri" id="bulanlahirsantri" class="form-control inputdatasantri" tabindex="6">
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
                                                        <option value="<?= sprintf('%02d', $p); ?>" <?= set_select('bulanlahirsantri', sprintf('%02d', $k++)) ?>>
                                                            <?= $bulan[$p]; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('bulanlahirsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <select name="tahunlahirsantri" id="tahunlahirsantri" class="form-control inputdatasantri" tabindex="7">
                                                    <option value="">..::..</option>
                                                    <?php
                                                    $sekarang = date('Y');
                                                    for ($b = 1985; $b <= $sekarang; $b++) {
                                                    ?>
                                                        <option value="<?= $b; ?>" <?= set_select('tahunlahirsantri', $b) ?>>
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
                                                <input type="text" class="form-control inputdatasantri" id="provinsisantri" name="provinsisantri" tabindex="8" value="<?= set_value('provinsisantri') ?>">
                                                <?= form_error('provinsisantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" id="idProvinsiSantri" value="">
                                        <input type="hidden" id="idKabSantri" value="">
                                        <input type="hidden" id="idKecSantri" value="">
                                        <div class="form-group row">
                                            <label for="kecamatansantri" class="col-sm-4 col-form-label">Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" readonly id="kecamatansantri" name="kecamatansantri" tabindex="10" value="<?= set_value('kecamatansantri') ?>">
                                                <?= form_error('kecamatansantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dusunsantri" class="col-sm-4 col-form-label">Dusun</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="dusunsantri" name="dusunsantri" tabindex="12" readonly value="<?= set_value('dusunsantri') ?>">
                                                <?= form_error('dusunsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="kabupatensantri" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" readonly id="kabupatensantri" name="kabupatensantri" tabindex="9" value="<?= set_value('kabupatensantri') ?>">
                                                <?= form_error('kabupatensantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="desasantri" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="desasantri" name="desasantri" tabindex="11" readonly value="<?= set_value('desasantri') ?>">
                                                <?= form_error('desasantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="rtsantri" class="col-sm-4 col-form-label">RT/RW/Kode
                                                Pos</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatasantri" id="rtsantri" data-inputmask="'mask' : '999'" data-mask="" name="rtsantri" tabindex="13" value="<?= set_value('rtsantri') ?>">
                                                <?= form_error('rtsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatasantri" id="rwsantri" data-inputmask="'mask' : '999'" data-mask="" name="rwsantri" tabindex="14" value="<?= set_value('rwsantri') ?>">
                                                <?= form_error('rwsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control inputdatasantri" id="kodepossantri" name="kodepossantri" value="<?= set_value('kodepossantri'); ?>" readonly>
                                                <?= form_error('kodepossantri', '<small class="text-danger">', '</small>'); ?>
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
                                            <label for="pendidikansantri" class="col-sm-4 col-form-label">Pendidikan
                                                Akhir</label>
                                            <div class="col-sm-8">
                                                <select name="pendidikansantri" id="pendidikansantri" class="form-control inputdatasantri" tabindex="15">
                                                    <option value="">..::Pilih::..</option>
                                                    <option value="Tidak Tamat SD/Sederajat" <?= set_select('pendidikansantri', 'Tidak Tamat SD/Sederajat') ?>>
                                                        Tidak Tamat SD/Sederajat
                                                    </option>
                                                    <option value="Tamat SD/Sederajat" <?= set_select('pendidikansantri', 'Tamat SD/Sederajat') ?>>
                                                        Tamat SD/Sederajat</option>
                                                    <option value="Tamat SMP/Sederajat" <?= set_select('pendidikansantri', 'Tamat SMP/Sederajat') ?>>
                                                        Tamat SMP/Sederajat</option>
                                                    <option value="Tamat SMA/Sederajat" <?= set_select('pendidikansantri', 'Tamat SMA/Sederajat') ?>>
                                                        Tamat SMA/Sederajat</option>
                                                    <option value="Sarjana/Diploma" <?= set_select('pendidikansantri', 'Sarjana/Diploma') ?>>
                                                        Sarjana/Diploma</option>
                                                    <option value="Pasca Sarjana" <?= set_select('pendidikansantri', 'Pasca Sarjana') ?>>Pasca
                                                        Sarjana</option>
                                                    <option value="Pondok Pesantren" <?= set_select('pendidikansantri', 'Pondok Pesantren') ?>>Pondok
                                                        Pesantren</option>
                                                    <option value="Lainnya" <?= set_select('pendidikansantri', 'Lainnya') ?>>Lainnya
                                                    </option>
                                                </select>
                                                <?= form_error('pendidikansantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="statusdomisilisantri" class="col-sm-4 col-form-label">Rencana
                                                Domisili</label>
                                            <div class="col-sm-8 pt-2">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" name="rencanadomisili" id="radioPrimary1" value="P2K" tabindex="16" <?= set_value('rencanadomisili') == 'P2K' ? 'checked' : ''; ?>>
                                                    <label for="radioPrimary1" style="font-weight: 500;">P2K
                                                        (Asrama)</label>
                                                </div>
                                                <div class="icheck-primary d-inline ml-4">
                                                    <input type="radio" name="rencanadomisili" id="radioPrimary2" value="LP2K" <?= set_value('rencanadomisili') == 'LP2K' ? 'checked' : ''; ?>>
                                                    <label for="radioPrimary2" style="font-weight: 500;">LP2K
                                                        (Non-Asrama)</label>
                                                </div>
                                                <br>
                                                <?= form_error('rencanadomisili', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kelasdiniyahsantri" class="col-sm-4 col-form-label">Rencana
                                                Diniyah</label>
                                            <div class="col-sm-3">
                                                <select name="kelasdiniyahsantri" id="kelasdiniyahsantri" class="form-control inputdatasantri" tabindex="19">
                                                    <option value="">..::..</option>
                                                    <option value="0" <?= set_select('kelasdiniyahsantri', '0'); ?>>0
                                                    </option>
                                                    <option value="TPQ" <?= set_select('kelasdiniyahsantri', 'TPQ'); ?>>TPQ
                                                    </option>
                                                    <option value="RA" <?= set_select('kelasdiniyahsantri', 'RA'); ?>>RA
                                                    </option>
                                                    <option value="Jilid" <?= set_select('kelasdiniyahsantri', 'Jilid'); ?>>Jilid</option>
                                                    <option value="Takhossus" <?= set_select('kelasdiniyahsantri', 'Takhossus'); ?>>Takhossus
                                                    </option>
                                                    <?php
                                                    $kaa = 1;
                                                    for ($ke = 1; $ke <= 6; $ke++) {
                                                    ?>
                                                        <option value="<?= $ke; ?>" <?= set_select('kelasdiniyahsantri', $kaa++); ?>><?= $ke; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?= form_error('kelasdiniyahsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-5">
                                                <select name="tingkatdiniyahsantri" id="tingkatdiniyahsantri" class="form-control inputdatasantri" tabindex="20">
                                                    <option value="">..::Pilih::..</option>
                                                    <?php
                                                    if ($datapendidikanDiniyah) {
                                                        foreach ($datapendidikanDiniyah as $dpd) {
                                                    ?>
                                                            <option value="<?= $dpd->nama_datapendidikan ?>" <?= set_select('tingkatdiniyahsantri', $dpd->nama_datapendidikan) ?>>
                                                                <?= $dpd->nama_datapendidikan ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                                <?= form_error('tingkatdiniyahsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ayahsantri" class="col-sm-4 col-form-label">Nama
                                                Ayah</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="ayahsantri" name="ayahsantri" tabindex="23" value="<?= set_value('ayahsantri'); ?>">
                                                <?= form_error('ayahsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="nomorkamarsantri" class="col-sm-4 col-form-label">Rencana
                                                Kamar</label>
                                            <div class="col-sm-2">
                                                <select name="nomorkamarsantri" id="nomorkamarsantri" class="form-control inputdatasantri" tabindex="17">
                                                    <option value="">..::..</option>
                                                    <?php
                                                    $kkk = 1;
                                                    for ($k = 1; $k <= 10; $k++) {
                                                    ?>
                                                        <option value="<?= $k; ?>"><?= $k; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-6">
                                                <select name="daerahsantri" id="daerahsantri" class="form-control inputdatasantri" tabindex="18">
                                                    <option value="">..::Pilih::..</option>
                                                    <?php
                                                    if ($datakamar) {
                                                        foreach ($datakamar as $datakamar) {
                                                    ?>
                                                            <option value="<?= $datakamar->nama_kamar; ?>">
                                                                <?= $datakamar->nama_kamar; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kelasformalsantri" class="col-sm-4 col-form-label">Rencana
                                                Formal</label>
                                            <div class="col-sm-2">
                                                <select name="kelasformalsantri" id="kelasformalsantri" class="form-control inputdatasantri" tabindex="21">
                                                    <option value="">..::..</option>
                                                    <?php
                                                    $llll = 1;
                                                    for ($ke = 1; $ke <= 6; $ke++) {
                                                    ?>
                                                        <option value="<?= $ke; ?>" <?= set_select('kelasformalsantri', $llll++) ?>><?= $ke; ?>
                                                        </option>
                                                    <?php } ?>
                                                    <option value="Lulus">Lulus</option>
                                                </select>
                                                <?= form_error('kelasformalsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <select name="tingkatformalsantri" id="tingkatformalsantri" class="form-control inputdatasantri" tabindex="22">
                                                    <option value="">..::Pilih::..</option>
                                                    <?php
                                                    if ($datapendidikanFormal) {
                                                        foreach ($datapendidikanFormal as $dpf) {
                                                    ?>
                                                            <option value="<?= $dpf->nama_datapendidikan ?>" <?= set_select('tingkatformalsantri', $dpf->nama_datapendidikan) ?>>
                                                                <?= $dpf->nama_datapendidikan ?>
                                                            </option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?= form_error('tingkatformalsantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="ibusantri" class="col-sm-4 col-form-label">Nama Ibu</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="ibusantri" name="ibusantri" tabindex="24" value="<?= set_value('ibusantri') ?>">
                                                <?= form_error('ibusantri', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row text-center" style="background-color: #b3b3b3;">
                                            <label class="col-sm-12 col-form-label">BIODATA CALON WALI
                                                SANTRI/MURID</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <input type="hidden" name="tipewali" id="tipewali" value="baru">
                                            <label for="nikwali" class="col-sm-4 col-form-label">Nomor KTP</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="nikwali" name="nikwali" autofocus data-inputmask="'mask' : '9999999999999999'" data-mask="" tabindex="25" value="<?= set_value('nikwali') ?>">
                                                <?= form_error('nikwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="namawali" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="namawali" name="namawali" tabindex="26" value="<?= set_value('namawali') ?>">
                                                <input type="checkbox" id="relateFather" class="mt-2">
                                                <label for="relateFather" class="mt-1 text-info mb-0">
                                                    <small>Pilih jika nama wali sama dengan nama ayah</small>
                                                </label>
                                                <br>
                                                <?= form_error('namawali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="nomorhpwali" class="col-sm-4 col-form-label">Nomor
                                                HP</label>
                                            <div class="col-sm-8">
                                                <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control inputdatasantri" id="nomorhpwali" name="nomorhpwali" tabindex="27" value="<?= set_value('nomorhpwali') ?>">
                                                <?= form_error('nomorhpwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="nomorwawali" class="col-sm-4 col-form-label">Nomor
                                                WA</label>
                                            <div class="col-sm-8">
                                                <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control inputdatasantri" id="nomorwawali" name="nomorwawali" tabindex="27" value="<?= set_value('nomorhpwali') ?>">
                                                <?= form_error('nomorwawali', '<small class="text-danger">', '</small>'); ?>
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
                                    <div class="col-12">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary1">
                                                <label for="checkboxPrimary1" class="text-primary"> Centang jika
                                                    alamat wali sama dengan alamat santri
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="idProWali" value="">
                                        <input type="hidden" id="idKabWali" value="">
                                        <input type="hidden" id="idKecWali" value="">
                                        <div class="form-group row">
                                            <label for="provinsiwali" class="col-sm-4 col-form-label">Provinsi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="provinsiwali" name="provinsiwali" tabindex="28" value="<?= set_value('provinsiwali') ?>">
                                                <?= form_error('provinsiwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kecamatanwali" class="col-sm-4 col-form-label">Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" readonly id="kecamatanwali" name="kecamatanwali" tabindex="30" value="<?= set_value('kecamatanwali') ?>">
                                                <?= form_error('kecamatanwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dusunwali" class="col-sm-4 col-form-label">Dusun</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="dusunwali" name="dusunwali" tabindex="32" readonly value="<?= set_value('dusunwali') ?>">
                                                <?= form_error('dusunwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="kabupatenwali" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" readonly id="kabupatenwali" name="kabupatenwali" tabindex="29" value="<?= set_value('kabupatenwali') ?>">
                                                <?= form_error('kabupatenwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="desawali" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control inputdatasantri" id="desawali" readonly name="desawali" tabindex="31" value="<?= set_value('desawali') ?>">
                                                <?= form_error('desawali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="rtwali" class="col-sm-4 col-form-label">RT/RW/Kode
                                                Pos</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatasantri" id="rtwali" data-inputmask="'mask' : '999'" data-mask="" name="rtwali" tabindex="33" value="<?= set_value('rtwali') ?>">
                                                <?= form_error('rtwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control inputdatasantri" id="rwwali" data-inputmask="'mask' : '999'" data-mask="" name="rwwali" tabindex="34" value="<?= set_value('rwwali') ?>">
                                                <?= form_error('rwwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" readonly class="form-control inputdatasantri" id="kodeposwali" name="kodeposwali" value="<?= set_value('kodeposwali') ?>">
                                                <?= form_error('kodeposwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-0">
                                    </div>
                                </div>
                                <div class="row pb-4">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="pendidikanwali" class="col-sm-4 col-form-label">Pend.
                                                Akhir</label>
                                            <div class="col-sm-8">
                                                <select name="pendidikanwali" id="pendidikanwali" class="form-control inputdatasantri" tabindex="35">
                                                    <option value="">..::..</option>
                                                    <option value="Tidak Tamat SD/Sederajat" <?= set_select('pendidikanwali', 'Tidak Tamat SD/Sederajat') ?>>
                                                        Tidak Tamat
                                                        SD/Sederajat
                                                    </option>
                                                    <option value="Tamat SD/Sederajat" <?= set_select('pendidikanwali', 'Tamat SD/Sederajat') ?>>Tamat
                                                        SD/Sederajat</option>
                                                    <option value="Tamat SMP/Sederajat" <?= set_select('pendidikanwali', 'Tamat SMP/Sederajat') ?>>Tamat
                                                        SMP/Sederajat</option>
                                                    <option value="Tamat SMA/Sederajat" <?= set_select('pendidikanwali', 'Tamat SMA/Sederajat') ?>>Tamat
                                                        SMA/Sederajat</option>
                                                    <option value="Sarjana/Diploma" <?= set_select('pendidikanwali', 'Sarjana/Diploma') ?>>
                                                        Sarjana/Diploma</option>
                                                    <option value="Pasca Sarjana" <?= set_select('pendidikanwali', 'Pasca Sarjana') ?>>Pasca
                                                        Sarjana</option>
                                                    <option value="Pondok Pesantren" <?= set_select('pendidikanwali', 'Pondok Pesantren') ?>>Pondok
                                                        Pesantren</option>
                                                    <option value="Lainnya" <?= set_select('pendidikanwali', 'Lainnya') ?>>Lainnya</option>
                                                </select>
                                                <?= form_error('pendidikanwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="pekerjaanwali" class="col-sm-4 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <select name="pekerjaanwali" id="pekerjaanwali" class="form-control inputdatasantri" tabindex="36">
                                                    <option value="">..::..</option>
                                                    <option value="BELUM/TIDAK BEKERJA" <?= set_select('pekerjaanwali', 'BELUM/TIDAK BEKERJA') ?>>
                                                        BELUM/TIDAK BEKERJA</option>
                                                    <option value="USTADZ/MUBALIGH" <?= set_select('pekerjaanwali', 'USTADZ/MUBALIGH') ?>>
                                                        USTADZ/MUBALIGH</option>
                                                    <option value="WIRASWASTA" <?= set_select('pekerjaanwali', 'WIRASWASTA') ?>>WIRASWASTA
                                                    </option>
                                                    <option value="NELAYAN/PERIKANAN" <?= set_select('pekerjaanwali', 'NELAYAN/PERIKANAN') ?>>
                                                        NELAYAN/PERIKANAN</option>
                                                    <option value="PETANI/PEKEBUN" <?= set_select('pekerjaanwali', 'PETANI/PEKEBUN') ?>>
                                                        PETANI/PEKEBUN</option>
                                                    <option value="PELAJAR/MAHASISWA" <?= set_select('pekerjaanwali', 'PELAJAR/MAHASISWA') ?>>
                                                        PELAJAR/MAHASISWA</option>
                                                    <option value="KARYAWAN SWASTA" <?= set_select('pekerjaanwali', 'KARYAWAN SWASTA') ?>>KARYAWAN
                                                        SWASTA</option>
                                                    <option value="KARYAWAN HONORER" <?= set_select('pekerjaanwali', 'KARYAWAN HONORER') ?>>KARYAWAN
                                                        HONORER</option>
                                                    <option value="PEGAWAI NEGERI SIPIL" <?= set_select('pekerjaanwali', 'PEGAWAI NEGERI SIPIL') ?>>PEGAWAI NEGERI SIPIL</option>
                                                    <option value="LAINNYA" <?= set_select('pekerjaanwali', 'LAINNYA') ?>>LAINNYA</option>
                                                </select>
                                                <?= form_error('pekerjaanwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="hubunganwali" class="col-sm-4 col-form-label">Hub.
                                                Perwalian</label>
                                            <div class="col-sm-8">
                                                <select name="hubunganwali" id="hubunganwali" class="form-control inputdatasantri" tabindex="37">
                                                    <option value="">..::..</option>
                                                    <option value="Orang Tua Kandung" <?= set_select('hubunganwali', 'Orang Tua Kandung') ?>>Orang Tua
                                                        Kandung</option>
                                                    <option value="Kakek/Nenek" <?= set_select('hubunganwali', 'Kakek/Nenek') ?>>Kakek/Nenek
                                                    </option>
                                                    <option value="Paman/Bibi" <?= set_select('hubunganwali', 'Paman/Bibi') ?>>Paman/Bibi
                                                    </option>
                                                    <option value="Saudara Kandung" <?= set_select('hubunganwali', 'Saudara Kandung') ?>>Saudara
                                                        Kandung</option>
                                                    <option value="Orang Tua Tiri" <?= set_select('hubunganwali', 'Orang Tua Tiri') ?>>Orang Tua
                                                        Tiri</option>
                                                    <option value="Lainnya" <?= set_select('hubunganwali', 'Lainnya') ?>>Lainnya</option>
                                                </select>
                                                <?= form_error('hubunganwali', '<small class="text-danger">', '</small>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row float-right">
                                <span style="display: none;" id="pesantombol" class="mr-3 text-danger">Anda tidak bisa menambah data baru</span>
                                <button id="tombolsimpansantri" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i>
                                    Tambahkan</button>
                            </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">

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