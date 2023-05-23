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
                                Upload Foto Santri
                            </h4>
                            <button type="button" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-lg">
                                <i class="fa fa-upload"></i>
                                Upload
                            </button>
                            <button type="button" id="refresh" class="btn btn-sm btn-default float-right mr-2">
                                <i class="fas fa-sync-alt"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="load"></div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>


<div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title">Form Upload Foto Santri</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group row">
                            <label for="idsantri" class="col-sm-4 col-form-label">ID P2K</label>
                            <div class="col-sm-8">
                                <input autocomplete="off" data-inputmask="'mask' : '99999999'" data-mask="" type="text" class="form-control" id="idsantri">
                                <small class="text-danger">Tekan ENTER</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-8" id="tampilupload" style="display: none">
                        <div class="row">
                            <div class="col-6">
                                <form id="formupload" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="id" value="0">
                                    <input type="hidden" name="foto" id="foto" value="0">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="filepond" id="customFile">
                                            <label class="custom-file-label" for="customFile" id="labelFoto">Pilih Foto Santri</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <form id="formuploadttd" enctype="multipart/form-data">
                                    <input type="hidden" name="idttd" id="idttd" value="0">
                                    <input type="hidden" name="ttd" id="ttd" value="0">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="fotottd" id="fotottd">
                                            <label class="custom-file-label" for="fotottd" id="labelttd">Pilih Foto TTD</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="tampildata" style="display: none">
                    <div class="col-6">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>NAMA</th>
                                    <th>:</th>
                                    <th id="nama"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Domisili</td>
                                    <td>:</td>
                                    <td id="domisili"></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><span id="desa"></span> <br> <span id="kabupaten"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>WALI</th>
                                    <th>:</th>
                                    <th id="wali"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>:</td>
                                    <td id="nomor"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                <button id="tombolsimpan" type="button" class="btn btn-primary btn-sm" disabled>Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>