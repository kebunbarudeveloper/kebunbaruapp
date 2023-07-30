<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <input type="hidden" id="resultprovinsi" value="">
    <input type="hidden" id="resultkabupaten" value="">
    <input type="hidden" id="resultkecamatan" value="">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="card-title mt-1">
                                Data Calon Santri
                            </h4>
                            <button onclick="setdiv()" type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Data
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
                <h5 class="modal-title">Form Entri Data</h5>
            </div>
            <div class="modal-body ui-front" style="height: 75.5vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                            <input type="hidden" id="resultreg" value="0">
                            <label for="" class="col-sm-4 col-form-label">No. Registrasi</label>
                            <div class="col-sm-8">
                                <input id="noreg" data-inputmask="'mask' : '99999999'" data-mask="" type="text" name="" class="form-control">
                                <small>Tekan <b class="text-danger">ENTER</b> untuk cek data</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="alert py-2" style="display: none;" id="alert"></div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row" id="tampilreg">

                </div>
                <div id="tampilform">
                    <hr>
                    <form class="form-horizontal" autocomplete="off" id="formsantri">
                        <input type="hidden" name="noreg" id="noregsantri" value="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="kk" class="col-sm-4 col-form-label">No. KK</label>
                                    <div class="col-sm-8">
                                        <input type="text" data-inputmask="'mask' : '9999999999999999'" data-mask="" class="form-control" id="kk" name="kk" placeholder="No. KK" tabindex="1">
                                        <small class="message text-danger" id="errorkk"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="pendidikan" class="col-sm-4 col-form-label">Pendidikan Akhir</label>
                                    <div class="col-sm-8">
                                        <select name="pendidikan" id="pendidikan" class="form-control" tabindex="2">
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
                                            <option value="Pasca Sarjana">Pasca
                                                Sarjana</option>
                                            <option value="Pondok Pesantren">Pondok
                                                Pesantren</option>
                                            <option value="Lainnya">Lainnya
                                            </option>
                                        </select>
                                        <small class="message text-danger" id="errorpendidikan"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="tempat" class="col-sm-4 col-form-label">Tempat Lhr.</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat Lahir" tabindex="3">
                                        <small class="message text-danger" id="errortempat"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-4 col-form-label">Tgl. Lhr.</label>
                                    <div class="col-sm-2">
                                        <select name="tanggal" id="tanggal" class="form-control" tabindex="4">
                                            <option value="">..::..</option>
                                            <option value="00">00</option>
                                            <?php
                                            $l = 1;
                                            for ($i = 1; $i <= 31; $i++) {
                                            ?>
                                                <option value="<?= sprintf('%02d', $i); ?>">
                                                    <?= sprintf('%02d', $i); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <small class="message text-danger" id="errortanggal"></small>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="bulan" id="bulan" class="form-control" tabindex="5">
                                            <option value="">..::..</option>
                                            <option value="00">00</option>
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
                                        <small class="message text-danger" id="errorbulan"></small>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="tahun" id="tahun" class="form-control inputdatasantri" tabindex="6">
                                            <option value="">..::..</option>
                                            <option value="0000">0000</option>
                                            <?php
                                            $sekarang = date('Y');
                                            for ($b = 1985; $b <= $sekarang; $b++) {
                                            ?>
                                                <option value="<?= $b; ?>">
                                                    <?= $b; ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="message text-danger" id="errortahun"></small>
                                    </div>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="provinsi" class="col-sm-4 col-form-label">Provinsi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Provinsi" tabindex="7">
                                        <small class="message text-danger" id="errorprovinsi"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="kabupaten" class="col-sm-4 col-form-label">Kabupaten</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="kabupaten" name="kabupaten" placeholder="Kabupaten" tabindex="8">
                                        <small class="message text-danger" id="errorkabupaten"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="kecamatan" class="col-sm-4 col-form-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="kecamatan" name="kecamatan" placeholder="Kecamatan" tabindex="9">
                                        <small class="message text-danger" id="errorkecamatan"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="desa" class="col-sm-4 col-form-label">Desa</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="desa" name="desa" placeholder="Desa" tabindex="10">
                                        <small class="message text-danger" id="errordesa"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="dusun" class="col-sm-4 col-form-label">Dusun</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="dusun" name="dusun" placeholder="Dusun" tabindex="11">
                                        <small class="message text-danger" id="errordusun"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="rt" class="col-sm-4 col-form-label">RT/RW/Kode Pos</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="rt" name="rt" data-inputmask="'mask' : '999'" data-mask="" tabindex="12">
                                        <small class="message text-danger" id="errorrt"></small>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="rw" name="rw" data-inputmask="'mask' : '999'" data-mask="" tabindex="13">
                                        <small class="message text-danger" id="errorrw"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="pos" name="pos" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="ayah" class="col-sm-4 col-form-label">Ayah</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ayah" name="ayah" placeholder="Ayah" tabindex="14">
                                        <small class="message text-danger" id="errorayah"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="ibu" class="col-sm-4 col-form-label">Ibu</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ibu" name="ibu" placeholder="Ibu" tabindex="15">
                                        <small class="message text-danger" id="erroribu"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="tampilformwali">
                    <hr>
                    <form class="form-horizontal" autocomplete="off" id="formwali">
                        <input type="hidden" name="noreg" id="noregwali" value="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-8">
                                        <select name="pekerjaan" id="pekerjaan" class="form-control" tabindex="1">
                                            <option value="">..::..</option>
                                            <option value="BELUM/TIDAK BEKERJA">
                                                BELUM/TIDAK BEKERJA</option>
                                            <option value="USTADZ/MUBALIGH">
                                                USTADZ/MUBALIGH</option>
                                            <option value="WIRASWASTA">WIRASWASTA
                                            </option>
                                            <option value="NELAYAN/PERIKANAN">
                                                NELAYAN/PERIKANAN</option>
                                            <option value="PETANI/PEKEBUN">
                                                PETANI/PEKEBUN</option>
                                            <option value="PELAJAR/MAHASISWA">
                                                PELAJAR/MAHASISWA</option>
                                            <option value="KARYAWAN SWASTA">KARYAWAN
                                                SWASTA</option>
                                            <option value="KARYAWAN HONORER">KARYAWAN
                                                HONORER</option>
                                            <option value="PEGAWAI NEGERI SIPIL">PEGAWAI NEGERI SIPIL</option>
                                            <option value="LAINNYA">LAINNYA</option>
                                        </select>
                                        <small class="message text-danger" id="errorpekerjaan"></small>
                                    </div>
                                </div>
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
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="provinsiw" class="col-sm-4 col-form-label">Provinsi</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="provinsiw" name="provinsiw" placeholder="Provinsi" tabindex="2">
                                        <small class="message text-danger" id="errorprovinsiw"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="kabupatenw" class="col-sm-4 col-form-label">Kabupaten</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="kabupatenw" name="kabupatenw" placeholder="Kabupaten" tabindex="3">
                                        <small class="message text-danger" id="errorkabupatenw"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="kecamatanw" class="col-sm-4 col-form-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="kecamatanw" name="kecamatanw" placeholder="Kecamatan" tabindex="4">
                                        <small class="message text-danger" id="errorkecamatanw"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="desaw" class="col-sm-4 col-form-label">Desa</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="desaw" name="desaw" placeholder="Desa" tabindex="5">
                                        <small class="message text-danger" id="errordesaw"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="dusunw" class="col-sm-4 col-form-label">Dusun</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly id="dusunw" name="dusunw" placeholder="Dusun" tabindex="6">
                                        <small class="message text-danger" id="errordusunw"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="rtw" class="col-sm-4 col-form-label">RT/RW/Kode Pos</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="rtw" name="rtw" data-inputmask="'mask' : '999'" data-mask="" tabindex="7">
                                        <small class="message text-danger" id="errorrtw"></small>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="rww" name="rww" data-inputmask="'mask' : '999'" data-mask="" tabindex="8">
                                        <small class="message text-danger" id="errorrww"></small>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="posw" name="posw" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" id="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" style="display: none;" disabled id="simpansantri" class="btn btn-primary">Simpan & Lanjut Entri Data Wali</button>
                <button type="button" style="display: none;" disabled id="simpanwali" class="btn btn-primary">Simpan Semua Data</button>
            </div>

            <form id="formsetprint" action="<?= base_url() ?>entridata/setprint" method="post" target="_blank">
                <input type="hidden" name="idsantri" id="idsantri" value="">
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>