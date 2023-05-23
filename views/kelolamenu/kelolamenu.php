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
                    <div class="card mb-2">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-laptop-house"></i> Data Menu
                                <span id="judultampilan"></span>
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 270px;">
                                    <select name="pilihkategori" id="pilihkategori" class="form-control float-right">
                                        <option value="">..:Pilih Kategori:..</option>
                                        <?php
                                        if ($datakategorijabatan) {
                                            foreach ($datakategorijabatan as $dk) {
                                        ?>
                                        <option value="<?= $dk->id_kategori ?>">
                                            <?= $dk->nama_kategori ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                    <div class="input-group-append" id="divtomboltambahmenu" style="display: none;">
                                        <button data-toggle="modal" data-target="#modal-default" id="tomboltambahmenu"
                                            class="btn btn-primary">
                                            <i class="fas fa-plus-circle"></i> Tambah Menu
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
            <div class="row" id="divtampildatamenu" style="height: 100%;">


            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>




<!-- Modal tambah jabatan -->
<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Menu Kategori <span class="text-info" id="judulform"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form autocomplete="off" id="formtambahmenu">
                    <input type="hidden" name="idkategori" id="idkategori">
                    <div class="form-group row">
                        <label for="namajabatan" class="col-sm-4 col-form-label">Nama Jabatan</label>
                        <div class="col-sm-8">
                            <select name="namajabatan" id="namajabatan" class="form-control"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namamenu" class="col-sm-4 col-form-label">Nama Menu</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="namamenu" id="namamenu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iconmenu" class="col-sm-4 col-form-label">Icon Menu</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="iconmenu" id="iconmenu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="urutmenu" class="col-sm-4 col-form-label">No. Urut Menu</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="urutmenu" id="urutmenu">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" id="tombolsimpanmenu" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>