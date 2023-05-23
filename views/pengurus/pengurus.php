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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fas fa-server mr-1"></i> Data Pengurus</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 450px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Cari Nama..." autofocus>
                                    <select id="pilihstatus" class="form-control">
                                        <option value="">..::Status::..</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button data-toggle="modal" data-target="#modal-xl" class="btn btn-primary" id="tomboltambah">
                                            <i class="fas fa-plus-circle"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="showresult" style="display: none;">

            </div>

            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>




<div class="modal fade" id="modal-xl" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Tambah Data Pengurus</h6>
            </div>
            <div class="modal-body ui-front">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">ID P2K</label>
                            <div class="col-sm-8">
                                <input id="idsantri" data-inputmask="'mask' : '99999999'" data-mask="" type="text" name="" class="form-control form-control-sm">
                                <small>Tekan <b class="text-danger">ENTER</b> untuk cek data</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-7" id="showjabatan" style="display: none;">
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-5 col-form-label">Jabatan</label>
                            <div class="col-sm-7">
                                <select name="jabatan" id="jabatan" class="form-control form-control-sm">
                                    <option value="">..:Pilih:..</option>
                                    <option value="Kabid Ma'hadiyah">Kabid Ma'hadiyah</option>
                                    <option value="Bagian Sekretaris">Bagian Sekretaris</option>
                                    <option value="Bagian Bendahara">Bagian Bendahara</option>
                                    <option value="Bagian Kamtib">Bagian Kamtib</option>
                                    <option value="Bagian Ta'limiyah">Bagian Ta'limiyah</option>
                                    <option value="Bagian Ubudiyah">Bagian Ubudiyah</option>
                                    <option value="Bagian Kesehatan">Bagian Kesehatan</option>
                                    <option value="Bagian Sihli">Bagian Sihli</option>
                                    <option value="Bagian Perlengkapan">Bagian Perlengkapan</option>
                                    <option value="Bagian Perairan">Bagian Perairan</option>
                                    <option value="Bagian Pembangunan">Bagian Pembangunan</option>
                                    <option value="Kepala Kamar">Kepala Kamar</option>
                                    <option value="Khusus Pengabdian">Khusus Pengabdian</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row">

                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolsimpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<input type="hidden" id="idPro">
<input type="hidden" id="idKab">
<input type="hidden" id="idKec">