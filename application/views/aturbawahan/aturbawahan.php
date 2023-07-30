<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <input type="hidden" id="kategorilogin" value="<?= $kategori; ?>">
    <input type="hidden" id="tipelogin" value="<?= $tipe; ?>">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header py-2">
                            <h3 class="card-title mt-1"> <i class="fa fa-users"></i> Data Sahabat Khidmat
                                <span id="juduldata"><?= getNamaKategori($kategori) ?></span>
                            </h3>

                            <div class="card-tools">
                                <button data-toggle="modal" data-target="#modal-lagi" id="tombolaturjabatan"
                                    class="btn btn-xs btn-warning">
                                    <i class="fas fa-cog"></i> Atur Jabatan
                                </button>
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
                    <div class="card" style="height: 71.5vh;">
                        <div class="card-body box-profile">
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
                                        <td>Masuk</td>
                                        <td> : </td>
                                        <td id="masukdetail"></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer">
                            <input type="hidden" id="indukdetailjabatan">
                            <input type="hidden" id="iddetailjabatan">
                            <input type="hidden" id="idjabatan">
                            <input type="hidden" id="idbagian">
                            <input type="hidden" id="idinstansi">
                            <input type="hidden" id="isiaksi">
                            <button class="btn btn-sm" id="tombolaksi" style="width: 100%;"></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


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


<div class="modal fade" id="modal-lagi" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atur Jabatan Sahabat Khidmat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <form autocomplete="off" id="formaturjabatan">
                    <input type="hidden" name="kategoriatur" id="kategoriatur" value="<?= $kategori; ?>">
                    <input type="hidden" name="tipeatur" id="tipeatur" value="<?= $tipe; ?>">

                    <div class="form-group row divbagianketua2" style="display: none;">
                        <label for="bagianjabatan" class="col-sm-4 col-form-label">Bagian</label>
                        <div class="col-sm-8">
                            <select name="bagianjabatan" id="bagianjabatan" class="form-control">
                                <option value="">..:Pilih Bagian:..</option>
                                <option value="1-1">Diniyah Putra</option>
                                <option value="1-2">Diniyah Putri</option>
                                <option value="2-1">Formal Putra</option>
                                <option value="2-2">Formal Putri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row divbagianketua2" style="display: none;">
                        <label for="instansijabatan" class="col-sm-4 col-form-label">Instansi</label>
                        <div class="col-sm-8">
                            <select name="instansijabatan" id="instansijabatan" class="form-control">
                                <option value="">..:Pilih Instansi:..</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="divjabatanatur">
                        <label for="jabatanatur" class="col-sm-4 col-form-label">Jabatan</label>
                        <div class="col-sm-8">
                            <select name="jabatanatur" id="jabatanatur" class="form-control">
                                <option value="">..:Pilih Jabatan:..</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pengurusjabatan" class="col-sm-4 col-form-label">Nama Pengurus</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pengurusjabatan" id="pengurusjabatan">
                        </div>
                    </div>
                    <input type="hidden" name="indukpengurus" id="indukpengurus">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="tombolsimpanatur" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>