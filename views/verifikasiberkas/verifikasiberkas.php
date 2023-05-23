<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="card-title mt-1">
                                Verifikasi Berkas Calon Santri
                            </h4>
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Data
                            </button>
                            <button type="button" class="btn btn-sm btn-primary float-right mr-2" data-toggle="modal" data-target="#modal-online">
                                <i class="fa fa-globe"></i>
                                Verifikasi Online
                            </button>
                            <input type="hidden" id="resultplatform" value="">
                            <select id="changePlatform" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 100px;">
                                <option value="">Semua</option>
                                <option value="1">Offline</option>
                                <option value="2">Online</option>
                            </select>
                            <button type="button" id="refresh" class="btn btn-sm btn-default float-right mr-2">
                                <i class="fas fa-sync-alt"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="tampil">

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>


<!-- Modal tambah data -->
<div class="modal fade" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="formtitle">Form Tambah Data</h5>
            </div>
            <div class="modal-body" style="height: 68.5vh; overflow-y: auto;">
                <form class="form-horizontal" autocomplete="off" id="formtambah">
                    <input type="hidden" name="id" id="id" value="0">
                    <input type="hidden" name="niklama" id="niklama" value="">
                    <input type="hidden" name="niklamaw" id="niklamaw" value="">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row text-center text-white" style="background-color: #343a40;">
                                <label class="col-sm-12 col-form-label">BIODATA CALON SANTRI/MURID</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="nik" class="col-sm-4 col-form-label">NIK Santri</label>
                                <div class="col-sm-8">
                                    <input data-inputmask="'mask' : '9999999999999999'" data-mask="" type="text" name="nik" class="form-control" tabindex="1" id="nik">
                                    <small class="text-danger messages" id="errornik"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Santri</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control form-control-border" id="nama" tabindex="2">
                                    <small class="text-danger messages" id="errornama"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Rencana Domisili</label>
                                <div class="col-sm-8 pt-2">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" name="domisili" id="p2k" value="P2K" tabindex="3">
                                        <label for="p2k" style="font-weight: 500;">P2K (Asrama)</label>
                                    </div>
                                    <div class="icheck-primary d-inline ml-4">
                                        <input type="radio" name="domisili" id="lp2k" value="LP2K">
                                        <label for="lp2k" style="font-weight: 500;">LP2K (Non-Asrama)</label>
                                    </div>
                                    <br>
                                    <small class="text-danger messages" id="errordomisili"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="kamar" class="col-sm-4 col-form-label">Rencana
                                    Kamar</label>
                                <div class="col-sm-2">
                                    <select name="kamar" id="kamar" class="form-control" tabindex="4">
                                        <option value="">..::..</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="daerah" id="daerah" class="form-control" tabindex="5">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                        if ($datakamar) {
                                            foreach ($datakamar as $datakamar) {
                                        ?>
                                                <option value="<?= $datakamar->nama_kamar; ?>">
                                                    <?= $datakamar->nama_kamar; ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="kelasd" class="col-sm-4 col-form-label">Rencana Diniyah</label>
                                <div class="col-sm-3">
                                    <select name="kelasd" id="kelasd" class="form-control" tabindex="6">
                                        <option value="">..::..</option>
                                        <option value="0">0
                                        </option>
                                        <option value="Jilid">Jilid</option>
                                        <option value="Takhossus">Takhossus
                                        </option>
                                        <option value="1">1 </option>
                                        <option value="2">2 </option>
                                        <option value="3">3 </option>
                                        <option value="4">4 </option>
                                        <option value="5">5 </option>
                                        <option value="6">6 </option>
                                    </select>
                                    <small class="text-danger messages" id="errorkelasd"></small>
                                </div>
                                <div class="col-sm-5">
                                    <select name="tingkatd" id="tingkatd" class="form-control" tabindex="7">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                        if ($datad) {
                                            foreach ($datad as $dpd) {
                                        ?>
                                                <option value="<?= $dpd->nama_datapendidikan ?>">
                                                    <?= $dpd->nama_datapendidikan ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                    <small class="text-danger messages" id="errortingkatd"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="kelasf" class="col-sm-4 col-form-label">Rencana
                                    Formal</label>
                                <div class="col-sm-2">
                                    <select name="kelasf" id="kelasf" class="form-control" tabindex="8">
                                        <option value="">..::..</option>
                                        <option value="1">1 </option>
                                        <option value="2">2 </option>
                                        <option value="3">3 </option>
                                        <option value="4">4 </option>
                                        <option value="5">5 </option>
                                        <option value="6">6 </option>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                    <small class="text-danger messages" id="errorkelasf"></small>
                                </div>
                                <div class="col-sm-6">
                                    <select name="tingkatf" id="tingkatf" class="form-control" tabindex="9">
                                        <option value="">..::Pilih::..</option>
                                        <?php
                                        if ($dataf) {
                                            foreach ($dataf as $dpf) {
                                        ?>
                                                <option value="<?= $dpf->nama_datapendidikan ?>">
                                                    <?= $dpf->nama_datapendidikan ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <small class="text-danger messages" id="errortingkatf"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-group row text-center text-white" style="background-color: #343a40;">
                                <label class="col-sm-12 col-form-label">BIODATA CALON WALI SANTRI/MURID</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="nikw" class="col-sm-4 col-form-label">NIK Wali</label>
                                <div class="col-sm-8">
                                    <input data-inputmask="'mask' : '9999999999999999'" data-mask="" type="text" name="nikw" class="form-control" tabindex="10" id="nikw">
                                    <small class="text-danger messages" id="errornikw"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="namaw" class="col-sm-4 col-form-label">Nama Wali</label>
                                <div class="col-sm-8">
                                    <input type="text" name="namaw" class="form-control" id="namaw" tabindex="11">
                                    <small class="text-danger messages" id="errornamaw"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="hp" class="col-sm-4 col-form-label">No. HP Wali</label>
                                <div class="col-sm-8">
                                    <input tabindex="12" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" type="text" name="hp" class="form-control" id="hp">
                                    <small class="text-danger messages" id="errorhp"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="wa" class="col-sm-4 col-form-label">No. WA Wali</label>
                                <div class="col-sm-8">
                                    <input tabindex="13" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" type="text" name="wa" class="form-control" id="wa">
                                    <small class="text-danger messages" id="errorwa"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="pendidikan" class="col-sm-4 col-form-label">Pend.
                                    Akhir</label>
                                <div class="col-sm-8">
                                    <select name="pendidikan" id="pendidikan" class="form-control" tabindex="14">
                                        <option value="">..:Pilih:..</option>
                                        <option value="Tidak Tamat SD/Sederajat">
                                            Tidak Tamat
                                            SD/Sederajat
                                        </option>
                                        <option value="Tamat SD/Sederajat">Tamat
                                            SD/Sederajat</option>
                                        <option value="Tamat SMP/Sederajat">Tamat
                                            SMP/Sederajat</option>
                                        <option value="Tamat SMA/Sederajat">Tamat
                                            SMA/Sederajat</option>
                                        <option value="Sarjana/Diploma">
                                            Sarjana/Diploma</option>
                                        <option value="Pasca Sarjana">Pasca
                                            Sarjana</option>
                                        <option value="Pondok Pesantren">Pondok
                                            Pesantren</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <small class="text-danger messages" id="errorpendidikan"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="hubungan" class="col-sm-4 col-form-label">Hub.
                                    Perwalian</label>
                                <div class="col-sm-8">
                                    <select name="hubungan" id="hubungan" class="form-control" tabindex="15">
                                        <option value="">..:Pilih:..</option>
                                        <option value="Orang Tua Kandung">Orang Tua
                                            Kandung</option>
                                        <option value="Kakek/Nenek">Kakek/Nenek
                                        </option>
                                        <option value="Paman/Bibi">Paman/Bibi
                                        </option>
                                        <option value="Saudara Kandung">Saudara
                                            Kandung</option>
                                        <option value="Orang Tua Tiri">Orang Tua
                                            Tiri</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <small class="text-danger messages" id="errorhubungan"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" id="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="simpan" class="btn btn-primary" tabindex="15">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal verifikasi online -->
<div class="modal fade" id="modal-online" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Form Verifikasi Online</h5>
            </div>
            <div class="modal-body" style="height: 50.5vh; overflow-y: auto;">
                <form class="form-horizontal" autocomplete="off" id="formonline">
                    <input type="hidden" name="noreg" id="resultnoreg" value="">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row mb-0">
                                <label for="" class="col-sm-4 col-form-label">No. Registrasi</label>
                                <div class="col-sm-8">
                                    <input id="noreg" data-inputmask="'mask' : '99999999'" data-mask="" type="text" name="" class="form-control">
                                    <small>Tekan <b class="text-danger"> ENTER </b>untuk cek data</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="alert py-2" id="alert" style="display: none;"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="tampilreg">

                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanreg" disabled>Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>