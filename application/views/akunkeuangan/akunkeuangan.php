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
                            <h3 class="card-title"> <i class="fa fa-cogs"></i> Jenis Akun Keuangan</h3>

                            <div class="card-tools mr-0">
                                <div class="input-group input-group-sm">
                                    <button type="submit" class="btn btn-info btn-sm tomboltambah" data-toggle="modal"
                                        data-target="#modal-default" data-tipe="1" id="tombolmodaltambahranting">
                                        <i class="fas fa-hand-holding-usd"></i> Pendapatan
                                    </button>
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 tomboltambah"
                                        data-toggle="modal" data-target="#modal-default" id="tombolmodaltambahranting"
                                        data-tipe="2">
                                        <i class="fas fa-money-bill-alt"></i> Belanja
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row" id="divtampilakun">

                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
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












<!-- Modal tambah nama pembayaran -->
<div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formtambahakun" autocomplete="off">
                    <input type="hidden" name="tipeakun" id="tipeakun">
                    <input type="hidden" name="tipeaksi" id="tipeaksi">
                    <input type="hidden" name="idedit" id="idedit">
                    <div class="form-group">
                        <label for="namaakun">Nama Akun</label>
                        <input type="text" class="form-control" name="namaakun" id="namaakun" required autofocus>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="tombolsimpan">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>