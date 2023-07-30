<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header pt-1">
    </div>
    <!-- /.content-header -->
    <input type="hidden" id="flashdata" value="<?= $this->session->flashdata('hasilaturperiode'); ?>">
    <input type="hidden" id="pesankalender" value="<?= $this->session->flashdata('pesanaturkalender'); ?>">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-cog"></i> Atur Periode</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formaturperiode" method="POST" autocomplete="off" action="<?= base_url() ?>pengaturan/aturperiode">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tahunperiode">Tahun Periode</label>
                                    <input data-inputmask="'mask': '9999-9999'" data-mask="" type="text" class="form-control" name="tahunperiode" id="tahunperiode" autofocus>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="tombolaturperiode" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-cog"></i> Atur Kalender</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formaturkalender" method="POST" autocomplete="off" action="<?= base_url() ?>pengaturan/aturkalender" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fileURL">Upload File xls/xlsx</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fileURL" name="fileURL">
                                            <label class="custom-file-label">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <i class="fa fa-cog"></i> Atur Peserta</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="formaturkalender" method="POST" autocomplete="off" action="<?= base_url() ?>peserta/import" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="filepeserta">Upload File xls/xlsx</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="filepeserta" name="filepeserta">
                                            <label class="custom-file-label">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <! -- /.content -->
</div>
<!-- /.content-wrapper -->

</div>