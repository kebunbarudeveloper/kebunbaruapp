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
                            <div class="col-12 card-tools mr-0">
                                <div class="input-group input-group-sm" style="width: 30%;">
                                    <input autofocus type="text" id="namafilter" class="form-control" placeholder="Nama Pesantren/ID" onkeyup="search(this)" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>


            <div class="row">
                <div class="col-12" id="tampildata">

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
<div class="modal fade" id="modal-coba" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-1 px-3"">
                <h6 class=" modal-title">Tambah Nomor WA</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="" method="post">
                            <div class="form-group row mb-0">
                                <label for="wa" class="col-sm-4 col-form-label">Nomor
                                    WA</label>
                                <div class="col-sm-8">
                                    <input type="text" data-inputmask="'mask' : '9999-9999-9999'" data-mask="" class="form-control inputdatasantri" id="wa" name="wa" tabindex="27" value="" inputmode="text">
                                </div>
                            </div>
                            <input type="hidden" name="idbm" id="idbm">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btn-sm" id="tombolSimpanNomor">Simpan Perubahan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>