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
                <div class="col-9">
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="card-title">Daftar Tarif</h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header py-2">
                            <h4 class="card-title">Pilihan Tindakan</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-9" id="tampildaftar"> -->
                <div class="col-9" id="tampilindex">

                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body" style="min-height: 35.5vh;">
                            <button <?= ($pengaturan > 0) ? 'disabled' : '' ?> id="tutup" type="button" class="btn btn-sm btn-<?= ($pengaturan > 0) ? 'danger' : 'primary' ?> btn-block mb-3">
                                <i class="fa fa-lock"></i> <?= ($pengaturan > 0) ? 'Pengaturan Sudah Ditutup' : 'Tutup Pengaturan' ?>
                            </button>
                            <button <?= ($tipe == 2 || $pengaturan > 0) ? 'disabled' : '' ?> type="button" class="btn btn-sm btn-default btn-block mb-3" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fa fa-money-bill"></i> Set Tarif Umum
                            </button>
                            <button <?= ($pengaturan > 0) ? 'disabled' : '' ?> type="button" class="btn btn-sm btn-default btn-block" data-toggle="modal" data-target="#modal-madrasah">
                                <i class="fa fa-store-alt"></i> Set Tarif Madrasiah
                            </button>
                            <hr>
                            <h6 class="text-center">Filter Daftar Tarif</h6>
                            <hr>
                            <select id="filterumum" class="form-control form-control-sm">
                                <option value="">.:Pilih:.</option>
                                <option value="1">Tarif Pendaftaran</option>
                                <option value="2">Tarif Infaq</option>
                                <option value="3">Tarif Pesantren</option>
                                <option value="4">Tarif Madrasiah</option>
                            </select>
                            <select id="filtertingkat" class="form-control form-control-sm mt-3" style="display: none;">
                                <option value="">.:Pilih Tingkat:.</option>
                                <option value="RA">RA</option>
                                <option value="I'dadiyah">I'dadiyah</option>
                                <option value="Ibtidaiyah">Ibtidaiyah</option>
                                <option value="Tsanawiyah">Tsanawiyah</option>
                                <option value="Aliyah">Aliyah</option>
                            </select>
                            <select id="filterkelas" class="form-control form-control-sm mt-3" style="display: none;">
                                <option value="">.:Pilih Kelas:.</option>
                                <option value="TPQ">TPQ</option>
                                <option value="RA">RA</option>
                                <option value="Jilid">Jilid</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            <input type="hidden" id="resulttingkat" value="">
                            <input type="hidden" id="resultkelas" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>

<!-- Modal tambah tarif -->
<div class="modal fade" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title" id="title">Pilih Jenis</h6>
            </div>
            <div class="modal-body" style="min-height: 30.5vh;">
                <div class="form-group row">
                    <label for="jenis" class="col-sm-4 col-form-label">Pilih Jenis</label>
                    <div class="col-8">
                        <select name="" id="changeJenis" class="form-control">
                            <option value="">.::.</option>
                            <option value="1">Pendaftaran</option>
                            <option value="2">Infaq</option>
                            <option value="3">Pesantren</option>
                        </select>
                    </div>
                </div>
                <!-- Div Pendaftaran -->
                <div id="divPendaftaran" class="divTampil" style="display: none;">
                    <hr>
                    <form id="formPendaftaran" autocomplete="off">
                        <div class="form-group row">
                            <label for="nominalp2k" class="col-sm-6 col-form-label">Pendaftaran Santri</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P01">
                                <input type="hidden" name="tipe[]" value="P2K">
                                <input tabindex="1" type="text" id="nominalp2k" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nominallp2k" class="col-sm-6 col-form-label">Pendaftaran Murid</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P07">
                                <input type="hidden" name="tipe[]" value="LP2K">
                                <input tabindex="2" type="text" id="nominallp2k" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Div Pendaftaran -->

                <!-- Div Infaq -->
                <div id="divInfaq" class="divTampil" style="display: none;">
                    <hr>
                    <form id="formInfaq" autocomplete="off">
                        <div class="form-group row">
                            <label for="pembangunanSantri" class="col-sm-6 col-form-label">Pemabangunan Santri</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P02">
                                <input type="hidden" name="tipe[]" value="P2K">
                                <input tabindex="1" type="text" id="pembangunanSantri" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pembangunanMurid" class="col-sm-6 col-form-label">Pembangunan Murid</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P02">
                                <input type="hidden" name="tipe[]" value="LP2K">
                                <input tabindex="2" type="text" id="pembangunanMurid" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="infaqWali" class="col-sm-6 col-form-label">Infaq Wali</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P03">
                                <input type="hidden" name="tipe[]" value="UMUM">
                                <input tabindex="3" type="text" id="infaqWali" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="syahriah" class="col-sm-6 col-form-label">Iuran Syahriah</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P08">
                                <input type="hidden" name="tipe[]" value="UMUM">
                                <input tabindex="4" type="text" id="syahriah" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="milad" class="col-sm-6 col-form-label">Iuran Akhirus Sanah/Milad</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P11">
                                <input type="hidden" name="tipe[]" value="UMUM">
                                <input tabindex="5" type="text" id="milad" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="muammar" class="col-sm-6 col-form-label">Iuran Muammar</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P19">
                                <input type="hidden" name="tipe[]" value="UMUM">
                                <input tabindex="6" type="text" id="muammar" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Div Infaq -->

                <!-- Div Pesantren -->
                <div id="divPesantren" class="divTampil" style="display: none;">
                    <hr>
                    <form id="formPesantren" autocomplete="off">
                        <div class="form-group row">
                            <label for="listrik" class="col-sm-6 col-form-label">Listrik dan Air Bersih</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P04">
                                <input tabindex="1" type="text" id="listrik" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kesehatan" class="col-sm-6 col-form-label">Iuran Kesehatan</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P05">
                                <input tabindex="2" type="text" id="kesehatan" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="operasional" class="col-sm-6 col-form-label">Operasional Pesantren</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P06">
                                <input tabindex="3" type="text" id="operasional" class="form-control rupiahFormat" name="nominal[]">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Div Pesantren -->
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm tombolSimpan" style="display: none;" id="tombolPendaftaran">Simpan Tarif Pendaftaran</button>
                <button type="button" class="btn btn-primary btn-sm tombolSimpan" style="display: none;" id="tombolInfaq">Simpan Tarif Infaq</button>
                <button type="button" class="btn btn-primary btn-sm tombolSimpan" style="display: none;" id="tombolPesantren">Simpan Tarif Pesantren</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal tarif Madrasiah -->
<div class="modal fade" id="modal-madrasah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <div class="row" style="width: 100%;">
                    <div class="col-6">
                        Atur Tarif Madrasiah
                    </div>
                    <div class="col-6">
                        <b id="textkelas" class="text-danger"></b> - <b id="texttingkat" class="text-danger"></b>
                    </div>
                </div>
            </div>
            <div class="modal-body" style="min-height: 50.5vh;">
                <div class="row">
                    <div class="col-4">
                        <select id="pilihtingkat" class="form-control form-control-sm">
                            <option value="">.:Pilih Tingkat:.</option>
                            <option value="RA">RA</option>
                            <option value="I'dadiyah">I'dadiyah</option>
                            <option value="Ibtidaiyah">Ibtidaiyah</option>
                            <option value="Tsanawiyah">Tsanawiyah</option>
                            <option value="Aliyah">Aliyah</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <select id="pilihkelas" class="form-control form-control-sm">
                            <option value="">.:Pilih Kelas:.</option>
                            <option value="TPQ">TPQ</option>
                            <option value="RA">RA</option>
                            <option value="Jilid">Jilid</option>
                            <option value="Takhossus">Takhossus</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button id="resetdata" style="display: none;" class="btn btn-danger btn-sm btn-block">Reset Data</button>
                    </div>
                </div>

                <div id="tampilform" style="display: none;">
                    <hr>
                    <form autocomplete="off" id="formMadrasah">
                        <input type="hidden" name="tingkat" value="0" id="tingkat">
                        <input type="hidden" name="kelas" value="0" id="kelas">
                        <div class="form-group mb-1 row">
                            <label for="imda" class="col-sm-6 col-form-label font-weight-normal">Imtihan Dauri (IMDA)</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P09">
                                <input tabindex="1" type="text" id="imda" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="imni" class="col-sm-6 col-form-label font-weight-normal">Imtihan Nihai (IMNI)</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P10">
                                <input tabindex="2" type="text" id="imni" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="lapramer" class="col-sm-6 col-form-label font-weight-normal">Biaya Lapramer</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P12">
                                <input tabindex="3" type="text" id="lapramer" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="alquran" class="col-sm-6 col-form-label font-weight-normal">Al-Qur'an/Tashhih Mu'allim</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P13">
                                <input tabindex="4" type="text" id="alquran" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="mqs" class="col-sm-6 col-form-label font-weight-normal">Pelatihan MQS</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P14">
                                <input tabindex="5" type="text" id="mqs" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="almiftah" class="col-sm-6 col-form-label font-weight-normal">Al-Miftah Lil Ulum</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P15">
                                <input tabindex="6" type="text" id="almiftah" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="kitab" class="col-sm-6 col-form-label font-weight-normal">Ujian Baca Kitab</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P16">
                                <input tabindex="7" type="text" id="kitab" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="wisuda" class="col-sm-6 col-form-label font-weight-normal">Biaya Wisuda</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P17">
                                <input tabindex="8" type="text" id="wisuda" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                        <div class="form-group mb-1 row">
                            <label for="seragam" class="col-sm-6 col-form-label font-weight-normal">Biaya Seragam GB</label>
                            <div class="col-6">
                                <input type="hidden" name="kode[]" value="P18">
                                <input tabindex="9" type="text" id="seragam" class="form-control form-control-sm rupiahFormat" value="0" name="nominal[]">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="simpanMadrasah">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Edit Umum -->
<div class="modal fade" id="edit-umum" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Edit Item</h6>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label id="labeleditumum" class="col-sm-8 col-form-label"></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control rupiahFormat" id="nominalold" readonly>
                    </div>
                </div>
                <hr>
                <input type="hidden" id="hasilfilterumum">
                <form autocomplete="off" id="formeditumum">
                    <input type="hidden" name="idedit" id="idedit">
                    <input type="hidden" name="urlaksi" id="urlaksi">
                    <div class="form-group row">
                        <label class="col-sm-8 col-form-label">Nominal Baru</label>
                        <div class="col-sm-4">
                            <input id="nominaledit" type="text" class="form-control rupiahFormat" name="nominaledit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" id="simpaneditumum" class="btn btn-primary btn-sm">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>