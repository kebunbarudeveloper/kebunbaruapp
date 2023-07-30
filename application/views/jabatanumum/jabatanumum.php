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
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-user-cog"></i> Atur Jabatan Umum
                                <span id="judultampilan"></span>
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 270px;">
                                    <select name="pilihkategori" id="pilihkategori" class="form-control float-right">
                                        <option value="">..:Pilih Kategori:..</option>
                                        <?php
                                        if ($datakategori) {
                                            foreach ($datakategori as $datak) {
                                        ?>
                                        <option value="<?= $datak->id_kategori ?>"><?= $datak->nama_kategori ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <div class="input-group-append" id="divtomboltambahmenu" style="display: none;">
                                        <button data-toggle="modal" data-target="#modal-default"
                                            id="tomboltambahjabatan" class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i> Tambah Jabatan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-9" id="tampildatajabatan"></div>


                <div class="col-md-3 tampildetailpengurus" style="display: none;">

                    <!-- Profile Image -->
                    <div class="card" style="height: 71vh;">
                        <div class="card-body box-profile" style="height: 100%; padding-top: 10px;">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid" id="gambardetail"
                                    style="height: 100px; width: 80px;"
                                    src="<?= base_url('assets/fotopengurus/coba.png') ?>" alt="User profile picture">
                            </div>
                            <p class="text-muted text-center mt-2 mb-0">Status : <span class="text-success"
                                    id="statusdetail"> </span>
                            </p>
                            <hr class="mt-2 mb-2">
                            <table style="width: 100%;">
                                <thead>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <th>Nama</th>
                                        <th>:</th>
                                        <th id="namadetail"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tetala</td>
                                        <td>:</td>
                                        <td id="tempatdetail"></td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td></td>
                                        <td></td>
                                        <td id="ttldetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td id="dusundetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="rtdetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="desadetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="kecamatandetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="kabupatendetail"></td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td></td>
                                        <td></td>
                                        <td id="prodetail"></td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td>No. HP</td>
                                        <td>:</td>
                                        <td id="hpdetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Tgl. SK</td>
                                        <td> : </td>
                                        <td id="skdetail"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <input type="hidden" id="idjabatandetail">
                        <div class="card-footer">
                            <button class="btn btn-sm btn-danger" id="tombolaksi"
                                style="width: 100%;">Non-Aktifkan</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>




<!-- Modal tambah jabatan -->
<div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan Umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <form id="formtambahjabatan" autocomplete="off">
                    <input type="hidden" name="idkategori" id="idkategori">

                    <div class="form-group row" id="divakses" style="display: none;">
                        <label for="tipejabatan" class="col-sm-3 col-form-label">Akses Jabatan</label>
                        <div class="col-sm-9">
                            <select name="tipejabatan" id="tipejabatan" class="form-control">
                                <option value="">..:Pilih Akses:..</option>
                                <option value="1">Putra</option>
                                <option value="2">Putri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="divjabatan">
                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <select name="jabatan" id="jabatan" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namapengurus" class="col-sm-3 col-form-label">Nama Pengurus</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="namapengurus" id="namapengurus">
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="indukpengurus" id="indukpengurus">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="tombolsimpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>