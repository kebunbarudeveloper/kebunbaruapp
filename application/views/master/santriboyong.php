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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Santri Berhenti (Boyong)</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 200px;">

                                    <button type="submit" class="btn btn-primary form-control float-right">
                                        <i class="fas fa-file-download"></i> Eksport Data
                                    </button>

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success" data-toggle="modal"
                                            data-target="#modal-default">
                                            <i class="fas fa-plus-circle"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-9" id="tampildataboyong">

                    <!-- /.card -->
                </div>

                <div class="col-md-3 tampildetailsantri">

                    <!-- Profile Image -->
                    <div class="card">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid" id="gambardetail"
                                    style="height: 100px; width: 80px;" src="" alt="User profile picture">
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
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td>Wali</td>
                                        <td>:</td>
                                        <td id="walidetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Tetala</td>
                                        <td>:</td>
                                        <td id="tempatdetail">Pamekasan</td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td></td>
                                        <td></td>
                                        <td id="ttldetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td id="desadetail"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td id="kecamatandetail"></td>
                                    </tr>
                                    <tr style="border-bottom: 1px #d4d2d2 dashed;">
                                        <td></td>
                                        <td></td>
                                        <td id="kabupatendetail"></td>
                                    </tr>
                                    <tr>
                                        <td>Masuk</td>
                                        <td> : </td>
                                        <td id="masukdetail"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr class="mt-2 mb-3">
                            <div class="btn-group" style="width: 100%;">
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <span>Pilih Aksi</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
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




<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Angket Boyong</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group row">
                        <label for="idsantri" class="col-sm-4 col-form-label">ID P2K</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="idsantri" autofocus>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>