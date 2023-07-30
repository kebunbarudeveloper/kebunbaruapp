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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="col-12 card-tools mr-0">
                                <div class="input-group input-group-sm" style="width: 100%;">

                                    <input autofocus type="text" id="namafilter" class="form-control" placeholder="Tekan F2 - Nama/ID P2K" onkeyup="dataSantriFilter()" autocomplete="off">
                                    <select onchange="dataSantriFilter()" id="pilihtingkat" class="form-control">
                                        <option value="">..:Pendidikan:..</option>
                                        <option value="RA">RA</option>
                                        <option value="I'dadiyah">I'dadiyah</option>
                                        <option value="Ibtidaiyah">Ibtidaiyah</option>
                                        <option value="Tsanawiyah">Tsanawiyah</option>
                                        <option value="Aliyah">Aliyah</option>

                                    </select>
                                    <!-- <select onchange="dataSantriFilter()" id="pilihumur" class="form-control">
                                        <option value="">..:Umur:..</option>
                                        <option value="16">17 ke Atas</option>
                                        <option value="17">17 ke Bawah</option>
                                    </select> -->

                                    <?php
                                    if ($tipe == 3) {
                                    ?>

                                        <select onchange="dataSantriFilter()" id="pilihtipe" class="form-control">
                                            <option value="">..:Tipe:..</option>
                                            <option value="1">Putra</option>
                                            <option value="2">Putri</option>
                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <select name="pilihperiode" id="pilihperiode" class="form-control" onchange="dataSantriFilter()" <?= ($jabatan == 46 || $jabatan == 47) ? 'disabled' : '' ?>>
                                            <option value="">..:Periode:..</option>
                                            <option value="1443-1444">1443-1444</option>
                                            <option value="1442-1443">1442-1443</option>
                                            <option value="1441-1442">1441-1442</option>
                                            <option value="1440-1441">1440-1441</option>
                                            <option value="1439-1440">1439-1440</option>
                                            <option value="1438-1439">1438-1439</option>
                                            <option value="1437-1438">1437-1438</option>
                                            <option value="1436-1437">1436-1437</option>
                                            <option value="1435-1436">1435-1436</option>
                                            <option value="1434-1435">1434-1435</option>
                                            <option value="1433-1434">1433-1434</option>
                                            <option value="1432-1433">1432-1433</option>
                                            <option value="1431-1432">1431-1432</option>
                                            <option value="1431-1432">1430-1431</option>
                                            <option value="1429-1430">1429-1430</option>
                                            <option value="1428-1429">1428-1429</option>
                                        </select>
                                    <?php
                                    }
                                    ?>
                                    <select onchange="dataSantriFilter()" id="pilihdaerah" class="form-control">
                                        <option value="131">..:Domisili:</option>
                                        <?php
                                        if ($domisili) {
                                            foreach ($domisili as $dd) {
                                                $dr = $dd->domisili_santri;
                                                if ($dr == '') {
                                                    $katadr = 'Belum Diatur';
                                                } else {
                                                    $katadr = $dr;
                                                }
                                        ?>
                                                <option value="<?= $dd->domisili_santri ?>"><?= $katadr ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select onchange="dataSantriFilter()" id="pilihkamar" class="form-control" style="display: none;">
                                        <option value="121">.:Kamar:.</option>
                                        <?php
                                        $no = 0;
                                        for ($i = 0; $i < 11; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <select onchange="dataSantriFilter()" id="pilihkabupaten" class="form-control">
                                        <option value="">..:Kabupaten:</option>
                                        <?php
                                        if ($kabupaten) {
                                            foreach ($kabupaten as $dk) {
                                                $kabb = str_replace(['Kabupaten', 'Kota'], '', $dk->kabupaten_santri);
                                        ?>
                                                <option value="<?= $dk->kabupaten_santri ?>"><?= $kabb ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <select onchange="dataSantriFilter()" id="pilihstatus" class="form-control" <?= ($jabatan == 46 || $jabatan == 47) ? 'disabled' : '' ?>>
                                        <option value="">..:Status:..</option>
                                        <option value="1">Aktif</option>
                                        <option value="2">Tugas</option>
                                    </select>
                                    <div class="input-group-append">
                                        <a href="<?= base_url() ?>exportexcel" class="btn btn-primary">
                                            <i class="fas fa-file-excel"></i> Export Data
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <div class="row">
                <div class="col-12" id="tampildata">

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
<input type="hidden" id="idsantriedit">
<input type="hidden" id="idwaliedit">


<div class="modal fade" id="modal-detail" data-backdrop="static" data-keyboard="false">
    <!-- <div class="modal fade" id="modal-detail"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header p-1" style="border-bottom: 0px;">
            </div>
            <div class="modal-body" style="max-height: 82vh; overflow: auto;" id="tampildetaildata">

            </div>
            <div class="modal-footer p-1" style="border-top: 0px;">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Modal edit data santri -->
<div class="modal fade" id="modal-editsantri" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header p-1">
            </div>
            <div class="modal-body ui-front">
                <form autocomplete="off" id="formeditsantri">
                    <input type="hidden" id="id_santri" name="id_santri">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="niksantri" class="col-sm-4 col-form-label">No.
                                    (KTP/NIK)/KK</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatasantri" id="niksantri" name="niksantri" autofocus data-inputmask="'mask' : '9999999999999999'" data-mask="" tabindex="1" value="">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatasantri" id="kksantri" name="kksantri" autofocus data-inputmask="'mask' : '9999999999999999'" data-mask="" tabindex="2" value="">
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="tempatlahirsantri" class="col-sm-4 col-form-label">Tempat
                                    Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="tempatlahirsantri" name="tempatlahirsantri" tabindex="4" value="">
                                </div>
                            </div>


                        </div>
                        <div class="col-md-6">

                            <div class="form-group row">
                                <label for="namasantri" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="namasantri" name="namasantri" tabindex="3" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggallahirsantri" class="col-sm-4 col-form-label">Tanggal
                                    Lahir</label>
                                <div class="col-sm-2">
                                    <select name="tanggallahirsantri" id="tanggallahirsantri" class="form-control inputdatasantri" tabindex="5">
                                        <option value="">..::..</option>
                                        <?php
                                        $le = 1;
                                        for ($i = 1; $i <= 31; $i++) {
                                        ?>
                                            <option value="<?= sprintf('%02d', $i); ?>">
                                                <?= sprintf('%02d', $i); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
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
                                        $ke = 1;
                                        for ($p = 1; $p <= 12; $p++) {
                                        ?>
                                            <option value="<?= sprintf('%02d', $p); ?>">
                                                <?= $bulan[$p]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="tahunlahirsantri" id="tahunlahirsantri" class="form-control inputdatasantri" tabindex="7">
                                        <option value="">..::..</option>
                                        <?php
                                        $sekarang = date('Y');
                                        for ($b = 1985; $b <= $sekarang; $b++) {
                                        ?>
                                            <option value="<?= $b; ?>">
                                                <?= $b; ?></option>
                                        <?php } ?>
                                    </select>
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
                                    <input type="text" class="form-control inputdatasantri" id="provinsisantri" name="provinsisantri" tabindex="8" value="">
                                </div>
                            </div>
                            <input type="hidden" id="idProvinsiSantri" value="">
                            <input type="hidden" id="idKabSantri" value="">
                            <input type="hidden" id="idKecSantri" value="">
                            <div class="form-group row">
                                <label for="kecamatansantri" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kecamatansantri" name="kecamatansantri" tabindex="10" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dusunsantri" class="col-sm-4 col-form-label">Dusun</label>
                                <div class="col-sm-8">
                                    <!-- <input type="text" class="form-control inputdatasantri" id="dusunsantri" name="dusunsantri" readonly tabindex="12"> -->
                                    <input type="text" class="form-control inputdatasantri" id="dusunsantri" name="dusunsantri" tabindex="12">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="kabupatensantri" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kabupatensantri" name="kabupatensantri" readonly tabindex="9">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desasantri" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="desasantri" name="desasantri" readonly tabindex="11">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtsantri" class="col-sm-4 col-form-label">RT/RW/Kode
                                    Pos</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rtsantri" data-inputmask="'mask' : '999'" data-mask="" name="rtsantri" tabindex="13">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rwsantri" data-inputmask="'mask' : '999'" data-mask="" name="rwsantri" tabindex="14">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control inputdatasantri" id="kodepossantri" name="kodepossantri" readonly>
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
                                        <option value="Tidak Tamat SD/Sederajat">
                                            Tidak Tamat SD/Sederajat
                                        </option>
                                        <option value="Tamat SD/Sederajat">
                                            Tamat SD/Sederajat</option>
                                        <option value="Tamat SMP/Sederajat">
                                            Tamat SMP/Sederajat</option>
                                        <option value="Tamat SMA/Sederajat">
                                            Tamat SMA/Sederajat</option>
                                        <option value="Sarjana/Diploma">
                                            Sarjana/Diploma</option>
                                        <option value="Pasca Sarjana">
                                            Pasca Sarjana</option>
                                        <option value="Pondok Pesantren">
                                            Pondok Pesantren</option>
                                        <option value="Lainnya">
                                            Lainnya
                                        </option>
                                    </select>
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
                                        <input type="radio" name="rencanadomisili" id="radioPrimary1" value="P2K" tabindex="16">
                                        <label for="radioPrimary1" style="font-weight: 500;">P2K (Asrama)</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-4">
                                        <input type="radio" name="rencanadomisili" id="radioPrimary2" value="LP2K">
                                        <label for="radioPrimary2" style="font-weight: 500;">LP2K (Non-Asrama)</label>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kelasdiniyahsantri" class="col-sm-4 col-form-label">Rencana
                                    Diniyah</label>
                                <div class="col-sm-3">
                                    <select name="kelasdiniyahsantri" id="kelasdiniyahsantri" class="form-control inputdatasantri" tabindex="19">
                                        <option value="">..::..</option>
                                        <option value="0">0</option>
                                        <option value="TPQ">TPQ</option>
                                        <option value="RA">RA</option>
                                        <option value="Jilid">Jilid</option>
                                        <option value="Praktik">Praktik</option>
                                        <option value="Takhossus">Takhossus</option>
                                        <?php
                                        $kaa = 1;
                                        for ($ke = 1; $ke <= 6; $ke++) {
                                        ?>
                                            <option value="<?= $ke; ?>">
                                                <?= $ke; ?>
                                            </option>
                                        <?php } ?>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <select name="tingkatdiniyahsantri" id="tingkatdiniyahsantri" class="form-control inputdatasantri" tabindex="20">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                        if ($datapendidikanDiniyah) {
                                            foreach ($datapendidikanDiniyah as $dpd) {


                                        ?>
                                                <option value="<?= $dpd->nama_datapendidikan ?>">
                                                    <?= $dpd->nama_datapendidikan ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ayahsantri" class="col-sm-4 col-form-label">Nama
                                    Ayah</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="ayahsantri" name="ayahsantri" tabindex="23">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomorkamarsantri" class="col-sm-4 col-form-label">Rencana
                                    Kamar</label>
                                <div class="col-sm-2">
                                    <select name="nomorkamarsantri" id="nomorkamarsantri" class="form-control fiturdisable inputdatasantri" tabindex="17">
                                        <option value="">..::..</option>
                                        <?php
                                        $kkk = 1;
                                        for ($k = 1; $k <= 10; $k++) {
                                        ?>
                                            <option value="<?= $k; ?>">
                                                <?= $k; ?>
                                            </option>

                                        <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="col-sm-6">
                                    <select name="daerahsantri" id="daerahsantri" class="form-control fiturdisable inputdatasantri" tabindex="18">
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
                                            <option value="<?= $ke; ?>">
                                                <?= $ke; ?>
                                            </option>
                                        <?php } ?>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="tingkatformalsantri" id="tingkatformalsantri" class="form-control inputdatasantri" tabindex="22">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                        if ($datapendidikanFormal) {
                                            foreach ($datapendidikanFormal as $dpf) {
                                        ?>
                                                <option value="<?= $dpf->nama_datapendidikan ?>">
                                                    <?= $dpf->nama_datapendidikan ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ibusantri" class="col-sm-4 col-form-label">Nama Ibu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="ibusantri" name="ibusantri" tabindex="24">
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolsimpaneditsantri">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal fade" id="modal-editwali" aria-hidden="true" style="display: none;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header p-1">
            </div>
            <div class="modal-body ui-front">
                <form id="formeditwali" autocomplete="off">
                    <input type="hidden" id="idsantri" name="idsantri">
                    <input type="hidden" name="idwali" id="idwali">
                    <input type="hidden" name="nikwaliedit" id="nikwaliedit">
                    <input type="hidden" name="tipeupdate" id="tipeupdate" value="0">
                    <input type="hidden" name="totalnik" id="totalnik" value="0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nikwali" class="col-sm-4 col-form-label">Nomor KTP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="nikwali" name="nikwali" autofocus data-inputmask="'mask' : '9999999999999999'" data-mask="" tabindex="25">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="namawali" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri bukadisable" id="namawali" name="namawali" tabindex="26">
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
                                    <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control inputdatasantri bukadisable" id="nomorhpwali" name="nomorhpwali" tabindex="27">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomorwawali" class="col-sm-4 col-form-label">Nomor
                                    WA</label>
                                <div class="col-sm-8">
                                    <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control inputdatasantri bukadisable" id="nomorwawali" name="nomorwawali" tabindex="28">
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
                            <input type="hidden" id="idProWali" value="">
                            <input type="hidden" id="idKabWali" value="">
                            <input type="hidden" id="idKecWali" value="">
                            <div class="form-group row">
                                <label for="provinsiwali" class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri bukadisable" id="provinsiwali" name="provinsiwali" tabindex="29">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kecamatanwali" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kecamatanwali" name="kecamatanwali" tabindex="31" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dusunwali" class="col-sm-4 col-form-label">Dusun</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="dusunwali" name="dusunwali" tabindex="33">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="kabupatenwali" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="kabupatenwali" name="kabupatenwali" tabindex="30" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desawali" class="col-sm-4 col-form-label">Desa/Kelurahan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control inputdatasantri" id="desawali" name="desawali" tabindex="32" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtwali" class="col-sm-4 col-form-label">RT/RW/Kode
                                    Pos</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rtwali" data-inputmask="'mask' : '999'" data-mask="" name="rtwali" tabindex="34">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control inputdatasantri" id="rwwali" data-inputmask="'mask' : '999'" data-mask="" name="rwwali" tabindex="35">
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" readonly class="form-control inputdatasantri" id="kodeposwali" name="kodeposwali">
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
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="pendidikanwali" class="col-sm-4 col-form-label">Pend.
                                    Akhir</label>
                                <div class="col-sm-8">
                                    <select name="pendidikanwali" id="pendidikanwali" class="form-control inputdatasantri" tabindex="36">
                                        <option value="">..::..</option>
                                        <option value="Tidak Tamat SD/Sederajat">
                                            Tidak Tamat SD/Sederajat</option>
                                        <option value="Tamat SD/Sederajat">
                                            Tamat SD/Sederajat</option>
                                        <option value="Tamat SMP/Sederajat">
                                            Tamat SMP/Sederajat</option>
                                        <option value="Tamat SMA/Sederajat">
                                            Tamat SMA/Sederajat</option>
                                        <option value="Sarjana/Diploma">
                                            Sarjana/Diploma</option>
                                        <option value="Pasca Sarjana">
                                            Pasca Sarjana</option>
                                        <option value="Pondok Pesantren">
                                            Pondok Pesantren</option>
                                        <option value="Lainnya">
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="pekerjaanwali" class="col-sm-4 col-form-label">Pekerjaan</label>
                                <div class="col-sm-8">
                                    <select name="pekerjaanwali" id="pekerjaanwali" class="form-control inputdatasantri" tabindex="37">
                                        <option value="">..::..</option>
                                        <option value="BELUM/TIDAK BEKERJA">
                                            BELUM/TIDAK BEKERJA</option>
                                        <option value="USTADZ/MUBALIGH">
                                            USTADZ/MUBALIGH</option>
                                        <option value="WIRASWASTA">
                                            WIRASWASTA
                                        </option>
                                        <option value="NELAYAN/PERIKANAN">
                                            NELAYAN/PERIKANAN</option>
                                        <option value="PETANI/PEKEBUN">
                                            PETANI/PEKEBUN</option>
                                        <option value="PELAJAR/MAHASISWA">
                                            PELAJAR/MAHASISWA</option>
                                        <option value="KARYAWAN SWASTA">
                                            KARYAWAN SWASTA</option>
                                        <option value="KARYAWAN HONORER">
                                            KARYAWAN HONORER</option>
                                        <option value="PEGAWAI NEGERI SIPIL">
                                            PEGAWAI NEGERI SIPIL</option>
                                        <option value="LAINNYA">
                                            LAINNYA
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="hubunganwali" class="col-sm-4 col-form-label">Hub.


                                    Perwalian</label>
                                <div class="col-sm-8">
                                    <select name="hubunganwali" id="hubunganwali" class="form-control inputdatasantri" tabindex="38">
                                        <option value="">..::..</option>
                                        <option value="Orang Tua Kandung">
                                            Orang Tua
                                            Kandung</option>
                                        <option value="Kakek/Nenek">
                                            Kakek/Nenek
                                        </option>
                                        <option value="Paman/Bibi">
                                            Paman/Bibi
                                        </option>
                                        <option value="Saudara Kandung">
                                            Saudara Kandung</option>
                                        <option value="Orang Tua Tiri">
                                            Orang Tua
                                            Tiri</option>
                                        <option value="Lainnya">
                                            Lainnya
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer p-1">
                <input type="hidden" id="nikWaliDetail">
                <button type="button" class="btn btn-danger btn-sm" id="tombolTutupDetail" style="display: none;">
                    <i class="fa fa-eye-slash"></i> Tutup
                </button>
                <button type="button" class="btn btn-success btn-sm" id="tombolBukaDetail" style="display: none;">
                    <i class="fa fa-eye"></i> Detail
                </button>
                <div class="card card-primary card-outline position-absolute" id="showdetailsantriwalis" style="left: 0; bottom: 8%; z-index: 1000; width: 40%; max-height: 70%; display: none; overflow: auto;">
                    <div class="card-body pt-0" id="tampildetailwalis">
                    </div>
                    <div class="card-footer p-0"></div>
                </div>
                <div class="custom-control custom-checkbox" id="matenika" style="display: none;">
                    <input class="custom-control-input" type="checkbox" id="customCheckbox2">
                    <label style="font-weight: normal; cursor: pointer;" for="customCheckbox2" class="custom-control-label text-primary">Tercatat ada <b id="katotal"></b> santri yang terhubung dengan wali ini. Pilih jika ingin update data santri yang terhubung dengan wali ini</label>
                </div>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" id="tombolsimpateditwali" class="btn btn-primary btn-sm">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-detail-wali" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-1">
            </div>
            <div class="modal-body pt-0" id="listNikWali" style="height: 78vh; overflow: auto;">

            </div>
            <div class="modal-footer p-1">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>