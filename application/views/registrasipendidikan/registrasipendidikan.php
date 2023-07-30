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
                                Registrasi Pendidikan Santri
                            </h4>
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-tambah-f">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Formal
                            </button>
                            <button type="button" class="btn btn-sm btn-primary float-right mr-2" data-toggle="modal" data-target="#modal-tambah">
                                <i class="fa fa-plus-circle"></i>
                                Tambah Diniyah
                            </button>
                            <input type="hidden" id="resultplatform" value="">
                            <select id="changePlatform" class="form-control form-control-sm d-inline-block float-right mr-2" style="width: 150px;">
                                <option value="0">Rekapitulasi</option>
                                <option value="1">Diniyah</option>
                                <option value="2">Formal</option>
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


<!-- Modal tambah data  -->
<div class="modal fade" id="modal-tambah" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="formtitle">Form Tambah Diniyah</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" autocomplete="off" id="formtambah">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="idd" class="col-sm-5 col-form-label">ID Santri</label>
                                <div class="col-sm-7">
                                    <input data-inputmask="'mask' : '99999999'" data-mask="" type="text" name="idd" class="form-control" tabindex="1" id="idd">
                                    <small class="text-danger messages" id="erroridd"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="kelasd" class="col-sm-5 col-form-label">Rencana Diniyah</label>
                                <div class="col-sm-3">
                                    <select name="kelasd" id="kelasd" class="form-control" tabindex="6">
                                        <option value="">..::..</option>
                                        <option value="TPQ">TPQ</option>
                                        <option value="RA">RA</option>
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
                                <div class="col-sm-4">
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


<!-- Modal tambah data formal-->
<div class="modal fade" id="modal-tambah-f" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-default">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="formtitle">Form Tambah Formal</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" autocomplete="off" id="formtambahf">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="idf" class="col-sm-5 col-form-label">ID Santri</label>
                                <div class="col-sm-7">
                                    <input data-inputmask="'mask' : '99999999'" data-mask="" type="text" name="idf" class="form-control" tabindex="1" id="idf">
                                    <small class="text-danger messages" id="erroridf"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="kelasf" class="col-sm-5 col-form-label">Rencana Formal</label>
                                <div class="col-sm-3">
                                    <select name="kelasf" id="kelasf" class="form-control" tabindex="6">
                                        <option value="">..::..</option>
                                        <option value="0">0</option>
                                        <option value="1">1 </option>
                                        <option value="2">2 </option>
                                        <option value="3">3 </option>
                                        <option value="4">4 </option>
                                        <option value="5">5 </option>
                                        <option value="6">6 </option>
                                    </select>
                                    <small class="text-danger messages" id="errorkelasf"></small>
                                </div>
                                <div class="col-sm-4">
                                    <select name="tingkatf" id="tingkatf" class="form-control" tabindex="7">
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
                    </div>
                </form>
            </div>
            <div class="modal-footer py-2">
                <button type="button" id="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="simpanf" class="btn btn-primary" tabindex="15">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>