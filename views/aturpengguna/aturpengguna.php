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
                            <h3 class="card-title"> <i class="fa fa-users"></i> Data Pengguna <span class="text-primary" id="juduldata"></span></h3>
                            <a href="<?= base_url() ?>aturpengguna/resetdata" class="btn btn-success btn-xs ml-2">
                                Reset Data
                            </a>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
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

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row" id="tampildatapengguna">

            </div>
            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>